<?php

namespace SimpleRest\Orm\News;

/**
 * News
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class News
{
    /**
     * null when news is not persisted to the db
     * @var int|null
     */
    private $id;
    
    /**
     * @var string
     */
    private $title;
    /**
     * @var \DateTime
     */
    private $date;
    
    /**
     * @var string
     */
    private $text;
    
    /**
     * @param int|null $id
     * @params tring $title
     * @param \DateTime $date
     * @param string $text
     */
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
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Export news to array
     * @return array
     */
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
