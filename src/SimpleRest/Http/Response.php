<?php

namespace SimpleRest\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Response
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Response implements ResponseInterface
{
    private $body;
    private $statusCode;
    
    /**
     * Set response body
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    
    /**
     * Set response status code
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getBody()
    {
        return new Message\Stream($this->body);
    }

    public function getHeader($name)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function getHeaderLine($name)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function getHeaders()
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function getProtocolVersion()
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function getReasonPhrase()
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function hasHeader($name)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withAddedHeader($name, $value)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withBody(\Psr\Http\Message\StreamInterface $body)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withHeader($name, $value)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withProtocolVersion($version)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }

    public function withoutHeader($name)
    {
        throw new \SimpleRest\Exception\Exception('Not implemented');
    }
}
