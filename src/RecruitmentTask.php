<?php

namespace RecruitmentTask;

use RecruitmentTask\Exceptions\FileNotValidException;

class RecruitmentTask
{

    private $inputFile;
    private $outputFile;
    private $extension;

    public function start($argv)
    {
        try {
            // read params from command line
            $this->parseInputArgs($argv);

            // get data processor using factory
            $dataParser = \RecruitmentTask\DataParser\ParserFactory::getParser($this->extension);
            $users = $dataParser->parseFile($this->inputFile);

            // filter active data and calculate sum
            $data = $this->calculateResult($users);

            // select result processor 
            $type = empty($this->outputFile) ? 'console' : 'file';
            $resultProcessor = \RecruitmentTask\ResultProcessor\ResultProcessorFactory::getProcessor($type);
            $resultProcessor->process($data, $this->outputFile);
        } catch (\Exception $e) {
            echo 'Exception : ' . get_class($e);
        }
    }

    public function calculateResult(array $data): int
    {
        $filtredData = array_filter($data, function($value, $key) {
            return $value['active'];
        }, ARRAY_FILTER_USE_BOTH);

        return array_reduce($filtredData, function($carry, $item) {
            return $carry += $item['value'];
        }, 0);
    }

    private function parseInputArgs($args)
    {

        if (count($args) == 3) {
            for ($i = 1; $i < 3; $i++) {
                $tmp = explode('=', $args[$i]);
                if ($tmp[0] == '--input') {
                    $this->inputFile = trim($tmp[1], '"');
                } else if ($tmp[0] == '--output') {
                    $this->outputFile = trim($tmp[1], '"');
                }
            }
        } else if (count($args) == 2) {
            $tmp = explode('=', $args[1]);
            if (count($tmp) == 2 && $tmp[0] == '--input') {
                $this->inputFile = trim($tmp[1], '"');
            } else {
                $this->inputFile = $args[1];
            }
        } else {
            // throw exception
        }
        
        $tmp = explode('.', $this->inputFile);
        if (!isset($tmp[1])) {
            throw new FileNotValidException();
        }
        $this->extension = $tmp[1];
    }

}
