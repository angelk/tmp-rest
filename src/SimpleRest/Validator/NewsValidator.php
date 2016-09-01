<?php

namespace SimpleRest\Validator;

use SimpleRest\Orm\News\News;

/**
 * Validator
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NewsValidator implements ValidatorInterface
{
    /**
     * [field] => errors[]
     * @var array
     */
    private $errors = [];
    
    /**
     * Validate given data
     * @param mixed $object
     * @return boolean
     */
    public function validate($object)
    {
        if (!$object instanceof News) {
            throw new \RuntimeException("Object type not supported");
        }
        
        if (empty($object->getTitle())) {
            $this->errors['title'][] = 'Title should not be empty';
        }
        
        if (mb_strlen($object->getTitle()) > 255) {
            $this->errors['title'][] = 'Title should not exceed 255 characters';
        }

        if (empty($object->getText())) {
            $this->errors['text'][] = 'Text should not be empty';
        }
        
        if (mb_strlen($object->getText()) > 8000) {
            $this->errors['text'][] = 'Text should not exceed 8000 characters';
        }
        
        if ($object->getDate()->getTimestamp() < strtotime('1990-01-01') || $object->getDate()->getTimestamp() > strtotime('2030-01-01')) {
            $this->errors['date'][] = 'Date should be between 1990-01-01 and 2030-01-01';
        }
        
        if (empty($this->errors)) {
            return true;
        }
        
        return false;
    }
    
    /**
s     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
