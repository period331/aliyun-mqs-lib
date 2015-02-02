<?php

namespace Mqs\Requests;
use Httpful\Response;
use LSS\Array2XML;
use Mqs\Account;
use Httpful\Request;
use Mqs\Mqs;

/**
 * Class BaseRequest
 * @package Mqs\Requests
 */
abstract class BaseRequest
{
    /**
     * @var Request
     */
    protected $httpful;

    /**
     * @var Account
     */
    protected $account;

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * @var string
     */
    protected $requestResource = '/';

    /**
     * @var array
     */
    protected $payload = [];

    /**
     * @var array
     */
    protected $specificHeaders = [
        'x-mqs-version' => Mqs::VERSION
    ];

    /**
     * @var string
     */
    protected $queueName;

    /**
     * @param Account $account
     */
    public function initAccount(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @param array $attributes
     */
    public function params(array $attributes = [])
    {
        foreach ($attributes as $key => $attribute) {
            $setter = 'set'.studly_case($key);

            if (method_exists($this, $setter)) {
                $this->$setter($attribute);
            } elseif (array_key_exists($key, $this->payload)) {
                $this->payload[$key] = $attribute;
            }
        }
    }

    /**
     * 发送http请求
     *
     * @return Response|string
     */
    public function send()
    {
        !$this->httpful and $this->httpful = Request::init($this->method);

        $payload = '';
        $uri = $this->account->getSchemeHost().$this->requestResource;

        if (in_array($this->httpful->method, ['POST', 'PUT'])) {
            $payload = $this->makePayload();
        } else {
            $uri .= '?'.http_build_query($this->payload);
        }

        $this->httpful->uri($uri);

        $this->httpful->addHeader('Content-Length', strlen($payload));
        $this->httpful->addHeader('Content-MD5', base64_encode(md5($payload)));
        $this->httpful->addHeader('Content-Type', 'text/xml;utf-8');
        $this->httpful->addHeader('Date', date('D, d M Y H:i:s', time()) . ' GMT');
        $this->httpful->addHeader('Host', $this->account->getHost());

        $this->makeSpecificHeaders();

        $this->httpful->body($payload);

        $this->httpful->expectsXml();

        try {
            return $this->sendRequest();
        } catch (\Exception $e) {
            return new Response(
            sprintf(<<<EOF
<?xml version="1.0"?>
<Error xmlns="http://mqs.aliyuncs.com/doc/v1">
  <Code>%s</Code>
  <Message>%s</Message>
  <RequestId>0</RequestId>
  <HostId>%s</HostId>
</Error>

EOF
            , $e->getCode(), $e->getMessage().'; FILE: '.$e->getFile().'; LINE: '.$e->getLine(), $this->account->getSchemeHost())
            ,"HTTP/1.1 400 OK\r\nServer: MOCK-SERVER\r\nContent-Type: text/xml;charset=utf-8\r\nx-mqs-request-id: 0",
                $this->httpful
            );
        }
    }

    /**
     * 添加特有的 request headers
     */
    protected function makeSpecificHeaders()
    {
        foreach ($this->specificHeaders as $header => $value){
            $header and $this->httpful->addHeader($header, $value);
        }
    }

    /**
     * 创建payload字符串
     */
    protected function makePayload()
    {
        $this->payload['@attributes'] = [
            'xmlns' => 'http://mqs.aliyuncs.com/doc/v1/'
        ];

        $class = class_basename(get_called_class());

        return Array2XML::createXML(strpos($class, 'Queue') !== false ? 'Queue' : 'Message', $this->payload)
            ->saveXML();
    }

    /**
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    protected function sendRequest()
    {
        $this->httpful->addHeader('Authorization', $this->makeSignature());

        return $this->httpful->send();
    }

    /**
     * 创建访问令牌
     *
     * @return string
     */
    protected function makeSignature()
    {
        $mqsHeaders = [];
        foreach ($this->httpful->headers as $key => $value) {
            if (strpos($key, 'x-mqs-') === 0) {
                $mqsHeaders[$key] = $value;
            }
        }

        $orderKeys = array_keys($mqsHeaders);
        sort($orderKeys);

        $sortedMQSHeaders = '';
        foreach ($orderKeys as $key) {
            $sortedMQSHeaders .= join(":", [strtolower($key), $mqsHeaders[$key] . "\n" ]);
        }

        $sign = sprintf(
            "%s\n%s\n%s\n%s\n%s%s",
            $this->httpful->method,
            $this->httpful->headers['Content-MD5'],
            $this->httpful->headers['Content-Type'],
            $this->httpful->headers['Date'],
            $sortedMQSHeaders,
            $this->requestResource
        );

        $sig = base64_encode(hash_hmac('sha1', $sign, $this->account->getAccessSecret(), true));
        return "MQS " . $this->account->getAccessKey() . ":" . $sig;
    }
}