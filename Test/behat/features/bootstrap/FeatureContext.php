<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $session;
    
    /**
     * @var GuzzleHttp\Psr7\Response|null
     */
    private $lastPostResponse;
    
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
    
    protected function getApiBaseUrl()
    {
        return 'http://localhost:8001/';
    }


    /**
     * @When I'm on news index page
     */
    public function imOnNewsIndexPage()
    {
        $this->session->visit($this->getApiBaseUrl());
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
        
        if (!isset($pageData['items'])) {
            throw new \Exception("Index should provide 'items' data");
        }
        
        // db is in know state
        // get 1st news and test if all fields are filled
        $news = $pageData['items'][0];
        $this->assertGivenArrayIsNews($news);
    }
    
    /**
     * @When I post data for news
     */
    public function postDataNews()
    {
        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->post(
            $this->getApiBaseUrl(),
            [
                'body' => json_encode(
                    [
                        'title' => 'test title',
                        "date" => "2018-06-06",
                        "text" => "test text",
                    ]
                ),
            ]
        );
        
        $this->lastPostResponse = $response;
    }
    
    /**
     * @Then I should see that data is saved successful
     */
    public function iShouldSeeThatDataIsSavedSuccessful()
    {
        $response = $this->lastPostResponse;
        // if response code is != 200, then guzzle
        // will throw exception. No checks for response
        $this->assertIsJson($response->getBody());
        $responseArray = json_decode($response->getBody(), true);
        if (!isset($responseArray['status']) | $responseArray['status'] !== 'ok') {
            throw new \Excetpion("expectes status `ok` from post api");
        }
    }
    
    protected function assertIsJson($data)
    {
        \json_decode($data);
        if (json_last_error() !== \JSON_ERROR_NONE) {
            throw new \Exception("Expected json");
        }
    }
    
    protected function assertGivenArrayIsNews($data)
    {
        $expectedNewskeys = ['id', 'title', 'date', 'text'];
        foreach ($expectedNewskeys as $key) {
            if (false === array_key_exists($key, $data)) {
                throw new \Excepion("Expected to find {$key} in news data");
            }
        }
    }


    protected function assertStatusCodeIs2xx(Behat\Mink\Driver\DriverInterface $driver)
    {
        if ($driver->getStatusCode() < 200 || $driver->getStatusCode() >= 300) {
            throw new \Exception("Expected status code 2xx");
        }
    }
}
