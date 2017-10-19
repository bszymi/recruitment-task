<?php

namespace RecruitmentTask\ResultProcessor;

/**
 * Description of ResultProcessorFactory
 *
 * @author bszymi
 */
class ResultProcessorFactory
{
    public static function getProcessor(string $type)
    {
        switch ($type) {
            case 'file' :
                return new File();
            case 'console' :
                return new Console();
            default :
                return new Console();
        }
        
    }

}
