<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $session;
    
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $this->session = new \Behat\Mink\Session($driver);
    }
    
    /**
     * @When I'm on news index page
     */
    public function imOnNewsIndexPage()
    {
        $this->session->visit('http://10.0.3.70:8001/');
    }
    
    /**
     * @Then I should see products in json format
     */
    public function iShouldSeeProductsInJsonFormat()
    {
        $pageContent = $this->session->getPage()->getContent();
        $this->assertStatusCodeIs2xx($this->session->getDriver());
        $this->assertIsJson($pageContent);
        $pageData = \json_decode($pageContent, true);
        if (!isset($pageData['meta'])) {
            throw new \Exception("Index should provide meta data");
        }
        
        if (!isset($pageData['meta']['perPage'])) {
            throw new \Exception("Index should provide information for items per page");
        }
    }
    
    protected function assertIsJson($data)
    {
        \json_decode($data);
        if (json_last_error() !== \JSON_ERROR_NONE) {
            throw new \Exception("Expected json");
        }
    }
    
    protected function assertStatusCodeIs2xx(Behat\Mink\Driver\DriverInterface $driver)
    {
        if ($driver->getStatusCode() < 200 || $driver->getStatusCode() >= 300) {
            throw new \Exception("Expected status code 2xx");
        }
    }
}
