<?php

namespace RecruitmentTask\ResultProcessor;

/**
 * Description of ResultProcessorInterface
 *
 * @author bszymi
 */
interface ResultProcessorInterface
{
    /*
     * string $data - string send to result processor
     * mixed $resource (optional) - used to pass file name or any other connection reference
     *      not used for printing in console
     */
    public function process(string $data, ?string $resource = null) : void;
}
