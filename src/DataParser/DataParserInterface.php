<?php

namespace RecruitmentTask\DataParser;

/**
 * Description of DataParserInterface
 *
 * @author bszymi
 */
interface  DataParserInterface
{
    public function parseFile(string $file) : array;
}
