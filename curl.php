<?php

function curl_request($url, $method = null, $params = null, $headers = null)
{
    if(!$method){
        $method = 'GET';
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    if(strtoupper($method) != 'GET' && $params){
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
    }
    if($headers){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    $response = curl_exec($curl);
    if($e = curl_error($curl)){
        return [
            'status' => 'error',
            'date' => $e
        ];
    }
    curl_close($curl);
    $response = json_decode($response);
    return [
        'status' => 'success',
        'date' => $response
    ];
    return $response;
    dd($response);
}
