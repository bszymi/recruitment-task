<?php

namespace RecruitmentTask\DataParser;

use RecruitmentTask\Exceptions\FileNotExistException;
use RecruitmentTask\Exceptions\FileNotValidException;

/**
 * Description of CsvParser
 *
 * @author bszymi
 */
class CsvParser implements DataParserInterface
{

    public function parseFile(string $file): array
    {
        $users = [];

        if (!file_exists($file)) {
            throw new FileNotExistException();
        }

        if (($handle = fopen($file, "r")) !== FALSE) {

            $processHeader = true; // use to skip header line 
            while (($data = fgetcsv($handle)) !== FALSE) {
                if ($processHeader) {
                    $processHeader = false;
                    continue;
                }

                if (count($data) != 3) {
                    throw new FileNotValidException();
                }

                $users[] = [
                    'name' => (string) $data[0],
                    'active' => $data[1] == 'true',
                    'value' => intval($data[2])
                ];
            }
            fclose($handle);
        }

        return $users;
    }
}
