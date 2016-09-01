<?php

namespace SimpleRest\Validator;

/**
 * All validatirs should implement this interface
 * @author po_taka
 */
interface ValidatorInterface
{
    public function validate($item);
    public function getErrors();
}
