<?php

namespace SimpleRest\Orm\News;

/**
 * News
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class News
{
    private $id;
    private $title;
    /**
     * @var \DateTime
     */
    private $date;
    private $text;
    
    public function __construct($id, $title, \DateTime $date, $text)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->text = $text;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'date' => $this->getDate()->format('Y-m-d'),
            'text' => $this->getText(),
        ];
    }
}
