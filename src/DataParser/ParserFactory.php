<?php

namespace RecruitmentTask\DataParser;

use RecruitmentTask\Exceptions\TypeNotSupportedException;

/**
 * Description of ParserFactory
 *
 * @author bszym
 */
class ParserFactory
{

    public static function getParser(string $type)
    {
        switch ($type) {
            case 'csv' :
                return new CsvParser();
            case 'xml' :
                return new XmlParser();
            case 'yml' :
                return new YamlParser();
            default :
                throw new TypeNotSupportedException();
        }
    }

}
