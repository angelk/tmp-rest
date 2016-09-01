<?php

namespace SimpleRest\Controller;

use SimpleRest\Http\Response;

use SimpleRest\DependencyInjection\ContainerAwareInterface;
use SimpleRest\DependencyInjection\ContainerAwareTrait;

/**
 * NewsController
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NewsController implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    
    /**
     * Handle news listing
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction()
    {
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        $request = $this->get('request');
        /* @var $request \Psr\Http\Message\ServerRequestInterface */
        $limit = 10;
        $newsQuery = $query->createQuery();
        $newsQuery->setLimit($limit);
        $newsQuery->setOffset($request->getAttribute('offset', 0));
        $newsFound = $newsQuery->find(false);
        return $this->createResponseJson(
            [
                'items' => $newsFound,
                'meta' => [
                    'perPage' => $limit,
                ],
            ]
        );
    }
    
    /**
     * Handle `get` action for news
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction($id)
    {
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        $newsQuery = $query->createQuery();
        $news = $newsQuery->get($id);
        return $this->createResponseJson($news->toArray());
    }
    
    /**
     * Handle `put action for news
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putAction($id)
    {
        $request = $this->get('request');
        /* @var $request \Psr\Http\Message\ServerRequestInterface */
        $parsedRequestBody = $request->getParsedBody();
        $news = new \SimpleRest\Orm\News\News(
            $id,
            $parsedRequestBody['title'],
            new \DateTime($parsedRequestBody['date']),
            $parsedRequestBody['text']
        );
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        try {
            $query->save($news, $this->get('newsValidator'));
        } catch (\SimpleRest\Validator\ValidationException $e) {
            $response = $this->createResponseJson(
                [
                    'status' => 'fail',
                    'errors' => $e->getErrors(),
                ]
            );
            
            $response->setStatusCode(422);
            return $response;
        }
        
        return $this->createResponseJson(['status' => 'ok']);
    }
    
    /**
     * Handle `post` action
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postAction()
    {
        $request = $this->get('request');
        /* @var $request \Psr\Http\Message\ServerRequestInterface */
        $parsedRequestBody = $request->getParsedBody();
        $news = new \SimpleRest\Orm\News\News(
            null,
            $parsedRequestBody['title'],
            new \DateTime($parsedRequestBody['date']),
            $parsedRequestBody['text']
        );
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        try {
            $query->save($news, $this->get('newsValidator'));
        } catch (\SimpleRest\Validator\ValidationException $e) {
            $response = $this->createResponseJson(
                [
                    'status' => 'fail',
                    'errors' => $e->getErrors(),
                ]
            );
            
            $response->setStatusCode(422);
            return $response;
        }
        
        return $this->createResponseJson(
            [
                'status' => 'ok',
                'news' => $news->toArray(),
            ]
        );
    }
    
    /**
     * Handle `delete` action
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteAction($id)
    {
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        $query->delete($id);
        return $this->createResponseJson(['status' => 'ok']);
    }
    
    /**
     * Create \Psr\Http\Message\ResponseInterface for json from array
     * @param array $data
     * @return Response
     */
    protected function createResponseJson(array $data)
    {
        $response = new Response();
        $dataJson = json_encode($data);
        $response->setBody($dataJson);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}
