<?php

namespace SimpleRest\Validator;

use SimpleRest\Exception\Exception;

/**
 * ValidationException
 * Could be thrown when validation fail.
 * Validator could throw exception or return bool.
 * Please read specific validator implementation
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ValidationException extends Exception
{
    /**
     * Kepp validation errors
     * @var array
     */
    private $errors = [];
    
    /**
     * Get validation errors
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set validation errors
     * @param array $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
}
