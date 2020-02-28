<?php

namespace Larabug\NovaLarabugTool\Utilities;

use GuzzleHttp\Client;

class Larabug
{
    private $key;
    private $guzzle;
    private $baseUrl = 'https://www.larabug.com/api';

    public function __construct()
    {
        $this->guzzle = new Client;
        $this->key = config('larabug.login_key');
    }

    public function send($url, $method = 'get', $params = [])
    {
        $response = $this->guzzle->{$method}($url, [
            'json' => $params,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->key,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function recentExceptions($page = 1)
    {
        return $this->send($this->baseUrl . '/projects/' . config('larabug.project_key') . '/exceptions?page=' . $page);
    }

    public function getException($id)
    {
        return $this->send($this->baseUrl . '/projects/' . config('larabug.project_key') . '/exceptions/' . $id);
    }
}
