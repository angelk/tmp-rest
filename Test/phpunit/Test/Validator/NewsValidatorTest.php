<?php

namespace Test\Validator;

use PHPUnit\Framework\TestCase;
use SimpleRest\Orm\News\News;
use SimpleRest\Validator\NewsValidator;

/**
 * Description of NewsValidatorTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NewsValidatorTest extends TestCase
{
    private function getValidNews()
    {
        return new News(null, 'title', new \DateTime('2002-02-02'), 'test');
    }
    
    public function testValidNews()
    {
        $news = $this->getValidNews();
        $validator = new NewsValidator();
        $this->assertTrue($validator->validate($news));
    }
    
    public function testEmptyTitle()
    {
        $news = $this->getValidNews();
        $news->setTitle('');
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testTooLongTitle()
    {
        $news = $this->getValidNews();
        $news->setTitle(str_repeat('a2b4qwe890', 26));
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testDateLower()
    {
        $news = $this->getValidNews();
        $news->setDate(new \DateTime('1800-05-05'));
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testDateHigh()
    {
        $news = $this->getValidNews();
        $news->setDate(new \DateTime('2050-05-05'));
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testRequiredText()
    {
        $news = $this->getValidNews();
        $news->setText('');
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testTooLongText()
    {
        $news = $this->getValidNews();
        $news->setText(str_repeat('1234567890', 801));
        $validator = new NewsValidator();
        $this->assertFalse($validator->validate($news));
    }
    
    public function testEmptyMessages()
    {
        $news = $this->getValidNews();
        $news->setText('');
        $news->setTitle('');
        $validator = new NewsValidator();
        $validator->validate($news);
        $errors = $validator->getErrors();
        $this->assertSame('Text should not be empty', $errors['text'][0]);
        $this->assertContains('Title should not be empty', $errors['title'][0]);
    }
}
