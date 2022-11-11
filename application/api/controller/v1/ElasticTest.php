<?php

namespace app\api\controller\v1;

use app\lib\seal\tool\ElasticClient;
use think\Controller;

class ElasticTest extends Controller
{
    private $ElasticClient;

    public function __construct(ElasticClient $elasticClient)
    {
        parent::__construct();
        $this->ElasticClient = $elasticClient;
    }

    public function index()
    {
        $params = [
            'index' => 'my_index',
            'id' => '2',
            'body' => ['testField' => '我们还有好地方吗?']
        ];

        $response = $this->ElasticClient->index($params);
        print_r($response);
    }

    public function get()
    {
        $params = [
            'index' => 'my_test',
            'id' => '2'
        ];

        $response = $this->ElasticClient->get($params);
        print_r($response);
    }

    public function search()
    {
        $params = [
            'index' => 'my_test',
            'body' => [
                'query' => [
                    'match' => [
                        'testField' => '分'
                    ]
                ]
            ]
        ];

        $results = $this->ElasticClient->search($params);

        print_r($results);
    }

    public function bulk()
    {
        for ($i = 1; $i < 10; $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'my_test',
                    '_id' => $i
                ]
            ];

            $params['body'][] = [
                'testField' => '我和我的祖国，一刻也不能分割' . $i,
            ];
        }
        $res = $this->ElasticClient->bulk($params);
        print_r($res);
    }

    public function create()
    {
        $params = [
            'index' => 'my_test',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'testField' => [
                            'type' => 'text',
                            'analyzer' => 'ik_smart'
                        ]
                    ]
                ]
            ]
        ];
        $res = $this->ElasticClient->create($params);
        print_r($res);
    }

    public function getSetting()
    {
        $params = ['index' => 'my_test'];
        $response = $this->ElasticClient->getSetting($params);
        print_r($response);
    }

    public function putS()
    {
        $params = [
            'index' => 'my_test',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'ik_max_word'
                        ]
                    ]
                ]
            ]
        ];
        $res = $this->ElasticClient->putSetting($params);
        print_r($res);
    }

    public function delete()
    {
        $params = ['index' => 'my_test'];
        $res = $this->ElasticClient->getClient()->indices()->delete($params);
        print_r($res);
    }
}