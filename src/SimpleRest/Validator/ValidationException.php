<?php

namespace SimpleRest\Validator;

use SimpleRest\Exception\Exception;

/**
 * Description of ValidationException
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ValidationException extends Exception
{
    private $errors = [];
    
    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
}
