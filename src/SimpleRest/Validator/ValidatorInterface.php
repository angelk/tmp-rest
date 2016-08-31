<?php

namespace SimpleRest\Validator;

/**
 *
 * @author potaka
 */
interface ValidatorInterface
{
    public function validate($item);
    public function getErrors();
}
