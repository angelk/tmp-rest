<?php

namespace Test\Orm\News;

use PHPUnit\Framework\TestCase;
use SimpleRest\Orm\Exception\QueryException;
use PDO;
use PDOStatement;
use SimpleRest\Orm\News\Query;

/**
 * Description of QueryTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class QueryTest extends TestCase
{
    public function testDeleteMethodThrowException()
    {
        $this->expectException(QueryException::class);
        
        $mockBuilderStm = $this->getMockBuilder(PDOStatement::class);
        $mockBuilderStm->disableOriginalConstructor();
        $stm = $mockBuilderStm->getMock();
        $stm->expects($this->once())
                ->method('rowCount')
                ->willReturn(0);
        
        $mockBuilderPdo = $this->getMockBuilder(PDO::class);
        $mockBuilderPdo->disableOriginalConstructor();
        $mockBuilderPdo->setMethods(['prepare']);
        $pdo = $mockBuilderPdo->getMock();
        $pdo->expects($this->once())
                ->method('prepare')
                ->willReturn($stm);
        
        $query = new Query($pdo);
        $query->delete(5);
    }
    
    public function testCreatedQueryIsNotTheSameAsParent()
    {
        $mockBuilderPdo = $this->getMockBuilder(PDO::class);
        $mockBuilderPdo->disableOriginalConstructor();
        $pdo = $mockBuilderPdo->getMock();
        
        $query = new Query($pdo);
        $newQuery = $query->createQuery();
        $this->assertNotSame($query, $newQuery);
    }
}
