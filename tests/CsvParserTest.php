<?php

declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class CsvParserTest extends TestCase
{

    public function testFileNotFoundException(): void
    {
        $this->expectException(\RecruitmentTask\Exceptions\FileNotExistException::class);
        (new \RecruitmentTask\DataParser\CsvParser())->parseFile('data/file_missing.csv');
    }
    
    public function testParseValidFile(): void
    {
        $this->assertArraySubset([
            ['name' => 'John', 'active' => true, 'value' => 500],
            ['name' => 'Mark', 'active' => true, 'value' => 250],
            ['name' => 'Paul', 'active' => false, 'value' => 100],
            ['name' => 'Ben', 'active' => true, 'value' => 150],
        ], (new \RecruitmentTask\DataParser\XmlParser())->parseFile('data/file.xml'));
    }

    public function testParseInvalidFileException(): void
    {
        $this->expectException(\RecruitmentTask\Exceptions\FileNotValidException::class);
        (new \RecruitmentTask\DataParser\XmlParser())->parseFile('data/file_wrong.csv');                
    }

    
}
