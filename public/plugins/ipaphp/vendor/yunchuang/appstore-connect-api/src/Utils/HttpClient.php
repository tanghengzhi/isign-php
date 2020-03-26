<?php

namespace MingYuanYun\AppStore\Utils;


use Curl\Curl;

trait HttpClient
{
    /**
     * @var Curl
     */
    private $curl;

    protected function getCurl()
    {
        $this->curl = new Curl();
        return $this;
    }

    public function get($url, array $params = [], array $headers = [])
    {
        $this->getCurl();
        foreach ($headers as $key => $value) {
            $this->curl->setHeader($key, $value);
        }
        $this->curl->get($url, $params);
        return $this->wrapContent($this->curl->getResponse());
    }

    public function postJson($url, array $body = [], array $headers = [])
    {
        $this->getCurl();
        foreach ($headers as $key => $value) {
            $this->curl->setHeader($key, $value);
        }
        $this->curl->setHeader('Content-Type', 'application/json');
        $this->curl->post($url, $body);
        return $this->wrapContent($this->curl->getResponse());
    }

    public function delete($url, array $params = [], array $headers = [])
    {
        $this->getCurl();
        foreach ($headers as $key => $value) {
            $this->curl->setHeader($key, $value);
        }
        $this->curl->delete($url, $params);
        return $this->wrapContent($this->curl->getResponse());
    }

    protected function wrapContent($content)
    {
        if (is_string($content)) {
            $content = json_decode(implode('', explode(PHP_EOL, $content)));
        }
        return json_decode(json_encode($content), true);
    }
}