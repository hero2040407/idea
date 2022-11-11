<?php

namespace app\lib\seal\tool;

use Elasticsearch\ClientBuilder;

class ElasticClient
{
    const DEFAULT_HOST = '154.221.22.10:9200';
    private $client;

    public function __construct(ClientBuilder $clientBuilder)
    {
        $this->client = $clientBuilder->setHosts([self::DEFAULT_HOST])->build();
    }

    public function getClient()
    {
        return $this->client;
    }


    public function index($params = [])
    {
        return $this->client->index($params);
    }

    public function bulk($params = [])
    {
        return $this->client->bulk($params);
    }

    public function search($params = [])
    {
        return $this->client->search($params);
    }

    public function get($params = [])
    {
        return $this->client->get($params);
    }

    public function create($params = [])
    {
        return $this->client->indices()->create($params);
    }

    public function getSetting($params)
    {
        return $this->client->indices()->getSettings($params);
    }

    public function putSetting($params)
    {
        return $this->client->indices()->putSettings($params);
    }
}