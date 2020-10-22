<?php

namespace App\Http\Traits;
use GuzzleHttp\Client;
use Session;

trait ServiceAPI{
    function requestData($url, $params = [], $method = 'GET'){
        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => Session::has('AUTH_LOGIN') ? 'Bearer ' . Session::get('AUTH_LOGIN')->Token : ''
            ],
            'connect_timeout' => env('CURL_TIMEOUT'),
            'timeout' => env('CURL_TIMEOUT'),
        ];

        // SET TOKEN
        $params['Language'] = Session::has('lang_locale') ? Session::get('lang_locale') : 'en';

        try {
            if ($method == 'GET') {
                $options['query'] = $params;
            } else {
                $options['json'] = $params;
            }

            $res = $client->request($method, env('API_GATEWAY') . '/' . $url, $options);

            if ($res->getStatusCode() == 200) {
                $response = json_decode($res->getBody()->getContents());
                return $response;
            }
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $errorData = json_decode($exception->getResponse()->getBody(true));
            return $errorData;
        }
    }

    function apiUpload($url, $params = []){
        $client = new Client();
        $options = [
            'headers' => [
                'Authorization' => Session::has('AUTH_LOGIN') ? 'Bearer ' . Session::get('AUTH_LOGIN')->Token : ''
            ],
        ];
        $multipart = [];
        foreach( $params as $value ){
            $multipart[] = [
                'name' => $value['name'],
                'contents' => $value['content']
            ];
        }

        $options['multipart'] = $multipart;

        try {
            $res = $client->request('POST', env('API_GATEWAY') . '/' . $url, $options);

            if ($res->getStatusCode() == 200) {
                $response = json_decode($res->getBody()->getContents());
                return $response;
            }
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $errorData = json_decode($exception->getResponse()->getBody(true));
            return $errorData;
        }
    }

    function testJsonData($url, $params = [], $method = 'GET'){
        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => Session::has('AUTH_LOGIN') ? 'Bearer ' . Session::get('AUTH_LOGIN')->Token : ''
            ],
            'connect_timeout' => env('CURL_TIMEOUT'),
            'timeout' => env('CURL_TIMEOUT'),
        ];

        // SET TOKEN
        $params['Language'] = Session::has('lang_locale') ? Session::get('lang_locale') : 'en';

        try {
            if ($method == 'GET') {
                $options['query'] = $params;
            } else {
                $options['json'] = $params;
            }

            $res = $client->request($method, $url, $options);

            if ($res->getStatusCode() == 200) {
                $response = json_decode($res->getBody()->getContents());
                return $response;
            }
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $errorData = json_decode($exception->getResponse()->getBody(true));
            return $errorData;
        }
    }
}
