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
        $this->serverRequest = new ServerRequest('GET', new Psr7\Uri(), [], null, '1.1', $_SERVER);
    }

    public function testSameInstanceWhenSameCookieParams()
    {
        $cookieParams = ['testK' => 'testV'];
        $serverRequest1 = $this->serverRequest->withCookieParams($cookieParams);
        $serverRequest2 = $serverRequest1->withCookieParams($cookieParams);
        $this->assertSame($serverRequest1, $serverRequest2);
    }

    public function testNewInstanceWhenNewCookieParams()
    {
        $cookieParams = ['testK' => 'testV'];
        $serverRequest = $this->serverRequest->withCookieParams($cookieParams);
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals($cookieParams, $serverRequest->getCookieParams());
    }

    public function testSameInstanceWhenSameQueryParams()
    {
        $queryParams = ['testK' => 'testV'];
        $serverRequest1 = $this->serverRequest->withQueryParams($queryParams);
        $serverRequest2 = $serverRequest1->withQueryParams($queryParams);
        $this->assertSame($serverRequest1, $serverRequest2);
    }

    public function testNewInstanceWhenNewQueryParams()
    {
        $queryParams = ['testK' => 'testV'];
        $serverRequest = $this->serverRequest->withQueryParams($queryParams);
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertEquals($queryParams, $serverRequest->getQueryParams());
    }

    public function testSameInstanceWhenSameParsedBody()
    {
        $parsedBody = ['testK' => 'testV'];
        $serverRequest1 = $this->serverRequest->withParsedBody($parsedBody);
        $serverRequest2 = $serverRequest1->withParsedBody($parsedBody);
        $this->assertSame($serverRequest1, $serverRequest2);
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
    }

    public function testSameInstanceWhenRemoveNonexistentAttribute()
    {
        $serverRequest = $this->serverRequest->withoutAttribute('testNonexistent');
        $this->assertSame($this->serverRequest, $serverRequest);
    }

    public function testNewInstanceWhenRemoveAttribute()
    {
        $serverRequest = $this->serverRequest->withAttribute('testK', 'testV');
        $serverRequest = $serverRequest->withoutAttribute('testK');
        $this->assertNotSame($this->serverRequest, $serverRequest);
        $this->assertNull($serverRequest->getAttribute('testK'));
    }
}
