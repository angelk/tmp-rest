<?php

namespace SimpleRest\Error;

use SimpleRest\Exception\Exception;

/**
 * ErrorHandler
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ErrorHandler
{
    /**
     * Handle error
     * @param int $erorNo
     * @param str $errorStr
     * @param str $errFile
     * @throws Exception
     */
    public function handlerError($erorNo, $errorStr, $errFile)
    {
        throw new Exception("{$errorStr} #{$erorNo}" . PHP_EOL . $errFile);
    }

    /**
     * Register error handler
     */
    public function register()
    {
        \set_error_handler([$this, 'handlerError']);
    }
}
