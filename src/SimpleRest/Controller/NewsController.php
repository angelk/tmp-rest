<?php

namespace SimpleRest\Controller;

use SimpleRest\Http\Response;

/**
 * NewsController
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NewsController
{
    public function indexAction()
    {
        $response = new Response();
            
        $response->setBody(uniqid());
        
        return $response;
    }
}
