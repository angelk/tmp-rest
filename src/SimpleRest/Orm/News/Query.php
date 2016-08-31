<?php

namespace SimpleRest\Orm\News;

use PDO;

/**
 * Query
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Query
{
    /**
     * @var PDO
     */
    private $pdo;
    
    /**
     * Query limit
     * @var int
     */
    private $limit = 10;

    /**
     * Query offset
     * @var int
     */
    private $offset = 0;
    
    private $fields = [
        'id',
        'title',
        'date',
        'text',
    ];
    
    const TABLE = 'news';
    
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * create new query from this one
     * @return \static
     */
    public function createQuery()
    {
        return new static($this->pdo);
    }
    
    /**
     * Apply limit to the query
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }
    
    /**
     * set query offset
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = (int) $offset;
    }

    /**
     * Get result from query
     * @param type $hidrate
     * @return News[]|Array
     * @throws \RuntimeException
     */
    public function find($hidrate = true)
    {
        $stm = $this->pdo->prepare("
            SELECT
                " . implode(', ', $this->fields) . "
            FROM
                " . static::TABLE . "
            ORDER BY
                id
            LIMIT
                :offset, :limit
        ");
        
        $stm->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        $stm->bindValue(':offset', $this->offset, PDO::PARAM_INT);
        $stm->execute();
        $returnData = [];
        if ($hidrate) {
            throw new \RuntimeException('not implemeted');
        } else {
            $returnData = $stm->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $returnData;
    }

    /**
     * Fin News by id
     * @param int $id
     * @return News
     */
    public function get($id)
    {
        $stm = $this->pdo->prepare("
            SELECT
                *
            FROM
                " . static::TABLE . "
            WHERE
                id = :id
        ");
        
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        if ($stm->rowCount() === 0) {
            throw new \RuntimeException("Can't find news for the given id");
        }
        $newsData = $stm->fetch(PDO::FETCH_ASSOC);
        return new News(
            $newsData['id'],
            $newsData['title'],
            new \DateTime($newsData['date']),
            $newsData['text']
        );
    }
    
    public function save(News $news)
    {
        if ($news->getId()) {
            return $this->update($news);
        }
        
        return $this->insert($news);
    }
    
    /**
     * Insert given news in db
     * @param \SimpleRest\Orm\News\News $news
     * @return boolean
     */
    protected function insert(News $news)
    {
        $stm = $this->pdo->prepare("
            INSERT INTO
                " . static::TABLE . " (" . implode(', ', $this->fields) . ")
            VALUES (null, :title, :date, :text)
        ");
        
        $stm->bindValue('title', $news->getTitle());
        $stm->bindValue('date', $news->getDate()->format('Y-m-d'));
        $stm->bindValue('text', $news->getText());
        $stm->execute();
        $news->setId($this->pdo->lastInsertId());
        return true;
    }
    
    /**
     * Update db record for given news
     * @param \SimpleRest\Orm\News\News $news
     * @return boolean
     */
    protected function update(News $news)
    {
        $stm = $this->pdo->prepare("
            UPDATE
                " . static::TABLE . "
            SET
                title = :title,
                date = :date,
                text = :text
            WHERE
                id = :id
        ");
        
        $stm->bindValue('id', $news->getId(), PDO::PARAM_INT);
        $stm->bindValue('title', $news->getTitle());
        $stm->bindValue('date', $news->getDate()->format('Y-m-d'));
        $stm->bindValue('text', $news->getText());
        $stm->execute();
        return true;
    }
    
    /**
     * Delete news with given id
     * @param int $id
     */
    public function delete($id)
    {
        $stm = $this->pdo->prepare("
            DELETE FROM
                " . static::TABLE . "
            WHERE
                id = :id
        ");
        
        $stm->bindValue('id', $id, \PDO::PARAM_INT);
        $stm->execute();
        if ($stm->rowCount() !== 1) {
            // @TODO throw specific exp
            throw new \SimpleRest\Exception\Exception("Item not found");
        }
    }
}
