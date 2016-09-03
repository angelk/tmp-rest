<?php

namespace SimpleRest\Http\Message;

use Psr\Http\Message\StreamInterface;

/**
 * Stream implementation of PSR7
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Stream implements StreamInterface
{
    /**
     * strem data
     * @var string
     */
    private $data;
    
    /**
     * Stream data
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __toString()
    {
        return $this->data;
    }

    public function close()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function detach()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function eof()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function getContents()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function getMetadata($key = null)
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function getSize()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function isReadable()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function isSeekable()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function isWritable()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function read($length)
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function rewind()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function tell()
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }

    public function write($string)
    {
        throw new \SimpleRest\Exception\Exception('not implemented');
    }
}
