<?php

namespace GuzzleHttp\Psr7;

use Psr\Http\Message\ServerRequestInterface;

class ServerRequest extends Request implements ServerRequestInterface
{
    /** @var  array */
    private $attributes;

    /** @var array */
    private $cookieParams = [];

    /** @var  null|array|object */
    private $parsedBody;

    /** @var array */
    private $queryParams = [];

    /** @var  array */
    private $serverParams = [];

    /** @var array */
    private $uploadedFiles = [];

    public function __construct(
        $method,
        $uri,
        array $headers = [],
        $body = null,
        $protocolVersion = '1.1',
        array $serverParams = []
    ) {
        parent::__construct($method, $uri, $headers, $body, $protocolVersion);

        $this->serverParams = $serverParams;
    }

    public function getServerParams()
    {
        return $this->serverParams;
    }

    public function getCookieParams()
    {
        return $this->cookieParams;
    }

    public function withCookieParams(array $cookies)
    {
        if ($this->cookieParams === $cookies) {
            return $this;
        }

        $new = clone $this;
        $new->cookieParams = $cookies;
        return $new;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function withQueryParams(array $query)
    {
        if ($this->queryParams === $query) {
            return $this;
        }

        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }

    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        $new = clone $this;
        $new->uploadedFiles = $uploadedFiles;
        return $new;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function withParsedBody($data)
    {
        if (!is_null($data) && !is_array($data) && !is_object($data)) {
            throw new \InvalidArgumentException('This method ONLY accepts arrays or objects or a null value');
        }

        if ($this->parsedBody === $data) {
            return $this;
        }

        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($name, $default = null)
    {
        if (!isset($this->attributes[$name])) {
            return $default;
        }

        return $this->attributes[$name];
    }

    public function withAttribute($name, $value)
    {
        $new = clone $this;
        $new->attributes[$name] = $value;
        return $new;
    }

    public function withoutAttribute($name)
    {
        if (!isset($this->attributes[$name])) {
            return $this;
        }

        $new = clone $this;
        unset($new->attributes[$name]);
        return $new;
    }
}
