<?php

namespace Larabug\NovaLarabugTool\Utilities;

use GuzzleHttp\Client;

class Larabug
{
    private $key;
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client;
        $this->key = env('LB_KEY');
    }

    public function send($url, $method = 'get', $params = [])
    {
        $r = $this->guzzle->{$method}($url, [
            'json' => $params,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->key,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($r->getBody()->getContents());
    }

    public function recentExceptions($page = 1)
    {
        return $this->send('https://www.larabug.com/api/projects/' . env('LB_PROJECT_KEY') . '/exceptions?page=' . $page);
    }

    public function getException($id)
    {
        return $this->send('https://www.larabug.com/api/projects/' . env('LB_PROJECT_KEY') . '/exceptions/' . $id);
    }
}
