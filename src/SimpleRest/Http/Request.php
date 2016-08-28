<?php

namespace SimpleRest\Http;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Request
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Request implements ServerRequestInterface
{
    private $query;
    private $request;
    private $server;
    private $content;
    
    public function __construct(array $query = [], array $request = [], array $server = [], $content = null)
    {
        $this->query = $query;
        $this->request = $request;
        $this->server = $server;
        $this->content = $content;
    }
    
    public static function createFromGlobals()
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            file_get_contents('php://input')
        );
    }

    public function getAttribute($name, $default = null)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getAttributes()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getBody()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getCookieParams()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getHeader($name)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getHeaderLine($name)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getHeaders()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getParsedBody()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getProtocolVersion()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getQueryParams()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getRequestTarget()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getServerParams()
    {
        return $this->server;
    }

    public function getUploadedFiles()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function getUri()
    {
        throw new \RuntimeException('Not implemented');
    }

    public function hasHeader($name)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withAddedHeader($name, $value)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withAttribute($name, $value)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withBody(\Psr\Http\Message\StreamInterface $body)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withCookieParams(array $cookies)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withHeader($name, $value)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withMethod($method)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withParsedBody($data)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withProtocolVersion($version)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withQueryParams(array $query)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withRequestTarget($requestTarget)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withUri(\Psr\Http\Message\UriInterface $uri, $preserveHost = false)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withoutAttribute($name)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function withoutHeader($name)
    {
        throw new \RuntimeException('Not implemented');
    }
}
