<?php

namespace RecruitmentTask\ResultProcessor;

/**
 * Description of File
 *
 * @author bszymi
 */
class File implements ResultProcessorInterface
{
    public function process(string $data, ?string $resource = null) : void {
        $tmp = explode('/', $resource);
        if (count($tmp) > 1) {
            unset($tmp[count($tmp) -1]);
            $path = implode('/', $tmp);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        } 
        
        file_put_contents($resource, $data);
    }

}
