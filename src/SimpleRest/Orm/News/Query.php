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
    
    private $limit = 10;
    
    private $orders = [];

    private $fields = [
        'id',
        'title',
        'date',
        'text',
    ];
    
    private $orderFields = [
        'id',
        'title',
    ];
    
    private $orderDirections = [
        'asc',
        'desc',
    ];

    const TABLE = 'news';
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * @return \static
     */
    public function createQuery()
    {
        return new static($this->pdo);
    }
    
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }
    
    public function addOrder($field, $direction = 'asc')
    {
        if (!in_array($field, $this->orderFields)) {
            // @TODO throw specific exception
            throw new \Exception("Forbidden order");
        }
        
        if (!in_array($direction, $this->orderDirections)) {
            // @TODO throw specific exception
            throw new \Exception("Forbidden order direction");
        }
        
        
        $this->orders[] = [
            'field' => $field,
            'direction' => $direction,
        ];
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

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
                :limit
        ");
        
        $stm->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        $stm->execute();
        $returnData = [];
        if ($hidrate) {
            throw new \RuntimeException('not implemeted');
        } else {
            $returnData = $stm->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $returnData;
    }

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
        // @TODO throw exception if empty
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    
    public function save(News $news)
    {
        if ($news->getId()) {
            return $this->update($news);
        }
        
        return $this->insert($news);
    }
    
    protected function insert($news)
    {
        $stm = $this->pdo->prepare("
            INSERT INTO
                " . static::TABLE . " (title)
            VALUES (:title)
        ");
        
        $stm->bindValue('title', $news->getTitle());
        $stm->execute();
    }
    
    protected function update($news)
    {
        throw new \RuntimeException('not implemeted');
    }
    
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
