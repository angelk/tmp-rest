<?php

namespace SimpleRest\Validator;

use SimpleRest\Orm\News\News;

/**
 * sValidator
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
