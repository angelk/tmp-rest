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
        return $this->getResponseJson(['method' => ['index']]);
    }
    
    public function postAction()
    {
        return $this->getResponseJson(['method' => ['post']]);
    }
    
    public function deleteAction($id)
    {
        return $this->getResponseJson(['method' => ['delete', $id]]);
    }
    
    protected function getResponseJson(array $data)
    {
        $response = new Response();
        $dataJson = json_encode($data);
        $response->setBody($dataJson);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}
