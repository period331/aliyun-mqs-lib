<?php

namespace Mqs\Requests;
use Httpful\Response;
use LSS\Array2XML;
use Mqs\Account;
use Httpful\Request;
use Mqs\Exceptions\RequestException;
use Mqs\Mqs;
use Mqs\Responses\BaseResponse;

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
        'x-mqs-version' => '2014-07-08'
    ];

    /**
     * query string params
     *
     * @var array
     */
    protected $urlParams = [];

    /**
     * @var string
     */
    protected $queueName;

    /**
     * @var int
     */
    protected $expectedStatus = 200;

    /**
     * @param Account $account
     * @return $this
     */
    public function initAccount(Account $account)
    {
        $this->account = $account;

        return $this;
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
     * @return array
     */
    public function getExpectedStatus()
    {
        return (array) $this->expectedStatus;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @return BaseResponse
     */
    public function send()
    {
        !$this->account and $this->account = Account::instance();
        $calledClass = get_called_class();

        $validator = 'Mqs\\Validators\\'.class_basename($calledClass).'Validator';
        $validator::validate($this);

        $interRes = $this->sendRequest();

        $this->catchError($interRes);

        $resClass = str_replace('Requests', 'Responses', $calledClass);

        return new $resClass($interRes, $this);
    }

    /**
     * 处理请求异常
     *
     * @param Response $response
     * @throws RequestException
     */
    protected function catchError(Response $response)
    {
        if ($xml = simplexml_load_string($response->body)) {
            if ($xml->getName() == 'Error') {
                throw new RequestException($xml->Code->__toString(), class_basename(get_called_class()).': '.$xml->Message->__toString().
                    '; RequestPayload:'.json_encode($this->payload).'; UrlParams:'.json_encode($this->urlParams)
                );
            }
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
     * 执行http发送请求
     *
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    protected function sendRequest()
    {
        !$this->httpful and $this->httpful = Request::init($this->method);

        $payload = '';
        if (in_array($this->httpful->method, ['POST', 'PUT'])) {
            $payload = $this->makePayload();
        }

        $uri = $this->account->getSchemeHost().$this->requestResource;
        $this->urlParams and $uri .= '?'.http_build_query($this->urlParams)
        and $this->requestResource .= '?'.http_build_query($this->urlParams);

        $this->httpful->uri($uri);

        $this->httpful->addHeader('Content-Length', strlen($payload));
        $this->httpful->addHeader('Content-MD5', base64_encode(md5($payload)));
        $this->httpful->addHeader('Content-Type', 'text/xml;utf-8');
        $this->httpful->addHeader('Date', date('D, d M Y H:i:s', time()) . ' GMT');
        $this->httpful->addHeader('Host', $this->account->getHost());

        $this->makeSpecificHeaders();

        $this->httpful->body($payload);

        $this->httpful->addHeader('Authorization', $this->makeSignature());

        try {
            return $this->httpful->send();
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