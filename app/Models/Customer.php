<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;



    public function get_new_token()
    {
        $url = "https://10.10.0.17/jwt-api-token-auth/";
        $data = array(
            "username" => "admin",
            "password" => "!LegalAct200023",
        );
        $opts = array(
            'http' => array(
                "header" => "Content-type: application/json",
                'method' => 'post',
                'content' => json_encode($data),
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context  = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result);
        return $json;
    }


    public function get_request($token, $url){
        $url = "https://10.10.0.17".$url;
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'header'  => "Authorization: JWT eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJ1c2VybmFtZSI6ImFkbWluIiwiZXhwIjoxNjk4Njc1MTE1LCJlbWFpbCI6ImEub2RpbG92QGxlZ2FsYWN0LnV6Iiwib3JpZ19pYXQiOjE2OTgwNzAzMTV9.GG6PP7TUDjSibkYa07QcQZCFQfRdoxOrbQ3ncJA6LPg",
                'method'  => 'GET'
            ),"ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, true, $context);
        $json = json_decode($result);
        return $json;
    }


}
