<?php


namespace MingYuanYun\AppStore\Api;

use MingYuanYun\AppStore\Client;

abstract class AbstractApi implements ApiInterface
{
    protected $client;

    private $page;

    protected $perPage;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = (null === $page ? $page : (int) $page);

        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = (null === $perPage ? $perPage : (int) $perPage);

        return $this;
    }

    protected function get($path, array $parameters = [], array $requestHeaders = [])
    {
        if (null !== $this->page && !isset($parameters['page'])) {
            $parameters['page'] = $this->page;
        }
        if (null !== $this->perPage && !isset($parameters['limit'])) {
            $parameters['limit'] = $this->perPage;
        }
        if (array_key_exists('ref', $parameters) && null === $parameters['ref']) {
            unset($parameters['ref']);
        }

        $url = $this->client->buildBaseUrl() . $path;
        $this->mergeHeaders($requestHeaders);

        return $this->client->get($url, $parameters, $this->client->getHeaders());
    }

    protected function postJson($path, array $parameters = [], array $requestHeaders = [])
    {
        $url = $this->client->buildBaseUrl() . $path;
        $this->mergeHeaders($requestHeaders);
        return $this->client->postJson($url, $parameters, $this->client->getHeaders());
    }

    protected function delete($path, array $parameters = [], array $requestHeaders = [])
    {
        $url = $this->client->buildBaseUrl() . $path;
        $this->mergeHeaders($requestHeaders);
        return $this->client->delete($url, $parameters, $this->client->getHeaders());
    }

    private function mergeHeaders(array $headers = [])
    {
        if ($headers) {
            $this->client->setHeaders($headers);
        }
        $this->client->checkAuthHeader();
    }
}