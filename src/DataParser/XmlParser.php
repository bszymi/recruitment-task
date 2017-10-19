<?php

namespace RecruitmentTask\DataParser;

use RecruitmentTask\Exceptions\FileNotExistException;
use RecruitmentTask\Exceptions\FileNotValidException;

/**
 * Description of XmlParser
 *
 * @author bszymi
 */
class XmlParser implements DataParserInterface
{

    public function parseFile(string $file): array
    {
        $users = [];

        if (!file_exists($file)) {
            throw new FileNotExistException();
        }

        libxml_use_internal_errors(true);
        $xml = simplexml_load_file($file);
        if (false === $xml) {
            throw new FileNotValidException();
        }

        foreach ($xml->user as $user) {
            $users[] = [
                'name' => (string) $user->name,
                'active' => $user->active == 'true',
                'value' => intval($user->value)
            ];
        }

        return $users;
    }

}
