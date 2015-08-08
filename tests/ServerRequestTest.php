<?php

namespace GuzzleHttp\Tests\Psr7;


use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7;

class ServerRequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ServerRequest
     */
    protected $serverRequest;

    public function setUp() {
        $this->serverRequest = new ServerRequest($_SERVER, 'GET', new Psr7\Uri());
    }

    public function testNewInstanceWhenNewCookieParams()
    {
        $cookieParams = ['testK' => 'testV'];
        $serverRequest = $this->serverRequest->withCookieParams($cookieParams);
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals($cookieParams, $serverRequest->getCookieParams());
    }

    public function testNewInstanceWhenNewQueryParams()
    {
        $queryParams = ['testK' => 'testV'];
        $serverRequest = $this->serverRequest->withQueryParams($queryParams);
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals($queryParams, $serverRequest->getQueryParams());
    }

    public function testNewInstanceWhenNewParsedBody()
    {
        $parsedBody = ['testK' => 'testV'];
        $serverRequest = $this->serverRequest->withParsedBody($parsedBody);
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals($parsedBody, $serverRequest->getParsedBody());
    }

    public function testNewInstanceWhenNewAttribute()
    {
        $serverRequest = $this->serverRequest->withAttribute('testK', 'testV');
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals('testV', $serverRequest->getAttribute('testK'));
        return $serverRequest;
    }

    public function testNewInstanceWhenRemoveAttribute()
    {
        $serverRequest = $this->serverRequest->withoutAttribute('testK');
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertNull($serverRequest->getAttribute('testK'));
    }
}
