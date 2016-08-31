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
    
    public function getAction($id)
    {
        $query = $this->get('newsQuery');
        /* @var $query \SimpleRest\Orm\News\Query */
        $newsQuery = $query->createQuery();
        $news = $newsQuery->get($id);
        return $this->createResponseJson($news->toArray());
    }
    
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
        $query->save($news);
        
        return $this->createResponseJson(['status' => 'ok']);
    }
    
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
        $query->save($news);
        
        return $this->createResponseJson(
            [
                'status' => 'ok',
                'news' => $news->toArray(),
            ]
        );
    }
    
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
