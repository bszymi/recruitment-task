<?php

declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Description of CalculateResultTest
 *
 * @author bszym
 */
final class CalculateResultTest extends TestCase
{
    public function testResultCalculation(): void
    {
        $this->assertEquals(900, 
            (new \RecruitmentTask\RecruitmentTask())->calculateResult([
                ['name' => 'John', 'active' => true, 'value' => 500],
                ['name' => 'Mark', 'active' => true, 'value' => 250],
                ['name' => 'Paul', 'active' => false, 'value' => 100],
                ['name' => 'Ben', 'active' => true, 'value' => 150],
            ])
        );
    }
    
    public function testEmptyResultCalculation(): void
    {
        $this->assertEquals(0, 
            (new \RecruitmentTask\RecruitmentTask())->calculateResult([])
        );
    }
    
    
}
