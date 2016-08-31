<?php

namespace Test\Orm\News;

use SimpleRest\Orm\News\News;

/**
 * NewsTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NewsTest extends \PHPUnit\Framework\TestCase
{
    public function testToArray()
    {
        $news = new News(5, 'testTitle', new \DateTime('2016-05-05'), 'textTest');
        $newsArray = $news->toArray();
        $expected = [
            'id' => 5,
            'title' => 'testTitle',
            'date' => (new \DateTime('2016-05-05'))->format('Y-m-d'),
            'text' => 'textTest',
        ];
        
        foreach ($expected as $field => $value) {
            $this->assertSame($value, $newsArray[$field]);
        }
    }
}
