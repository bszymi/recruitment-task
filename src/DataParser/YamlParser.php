<?php

namespace RecruitmentTask\DataParser;

use RecruitmentTask\Exceptions\FileNotExistException;
use RecruitmentTask\Exceptions\FileNotValidException;
use Symfony\Component\Yaml\Parser;

/**
 * Description of YamlParser
 *
 * @author bszymi
 */
class YamlParser implements DataParserInterface
{
    public function parseFile(string $file): array
    {
        $users = [];

        if (!file_exists($file)) {
            throw new FileNotExistException();
        }
        
        $yaml = new Parser();
        $result = $yaml->parse(file_get_contents($file));
        
        if (!isset($result['users'])) {
            throw new FileNotValidException();
        }
        
        foreach ($result['users'] as $user) {
            $users[] = $user;
        }

        return $users;
    }

}
