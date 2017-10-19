<?php

declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Description of FileResultProcessorTest
 *
 * @author bszymi
 */
final class FileResultProcessorTest extends TestCase
{
    public function testCreateFile(): void
    {
        $this->assertFileExists('test.txt', 
            (new \RecruitmentTask\ResultProcessor\File)->process('test', 'test.txt')
        );
    }
    
    public function testCreateFolder(): void
    {
        $this->assertDirectoryExists('result', 
            (new \RecruitmentTask\ResultProcessor\File)->process('test', 'result/test.txt')
        );
    }
    
}
