<?php

namespace RecruitmentTask\ResultProcessor;

/**
 * Description of Console
 *
 * @author bszymi
 */
class Console implements ResultProcessorInterface
{
    public function process(string $data, ?string $resource = null) : void {
        echo $data;
    }
}
