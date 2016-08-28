<?php

namespace SimpleRest\Error;

use SimpleRest\Exception\Exception;

/**
 * Description of ErrorHandler
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ErrorHandler
{

    public function handlerError($erorNo, $errorStr)
    {
        throw new Exception("{$errorStr} #{$erorNo}");
    }

    public function register()
    {
        \set_error_handler([$this, 'handlerError']);
    }
}
