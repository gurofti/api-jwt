<?php

// include vendor
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

// include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../config/database.php");
include_once("../classes/Users.php");

// objects
$db             =   new Database();
$connection     =   $db->connect();
$user_obj       =   new Users($connection);


if ($_SERVER["REQUEST_METHOD"] === "POST"){

    //$data       =   json_decode(file_get_contents("php://input"));

    $all_headers            =   getallheaders();

    $data_jwt              =   $all_headers['Authorization'];

    if (!empty($data_jwt)){

        try {

            $secret_key     =   "owt125";

            $decoded_data   =   JWT::decode($data_jwt, $secret_key, array('HS512'));

            $user_id        =   $decoded_data->data->id;

            http_response_code(200);
            echo json_encode(array(
                "status"    =>  1,
                "message"   =>  "We got JWT Token",
                "user_data" =>  $decoded_data,
                "user_id"   =>  $user_id,
            ));

        } catch (Exception $ex) {

            http_response_code(500);    // server error
            echo json_encode(array(
                "status"    =>  0,
                "message"   =>  $ex->getMessage()
            ));

        }

    }else {

        http_response_code(404);    // data not found
        echo json_encode(array(
            "status"    =>  0,
            "message"   =>  "Data not found #2"
        ));

    }

}