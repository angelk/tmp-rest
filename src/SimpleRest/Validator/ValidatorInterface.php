<?php

namespace SimpleRest\Validator;

/**
 * All validatirs should implement this interface
 * @author po_taka
 */
interface ValidatorInterface
{
    /**
     * This method
     * could throw exception or return bool.
     * Please read specific validator implementation
     * @param bool
     */
    public function validate($item);

    /**
     * @return array Validation errors
     */
    public function getErrors();
}
