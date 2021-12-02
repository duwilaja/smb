
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

    public function get_all()
    {

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.solo.indicar.id/users/publik/list",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",    
            "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NiwibmFtYSI6InVzZXIyIiwiZW1haWwiOiJ1c2VyMkBnbWFpbC5jb20iLCJub2hwIjoiIiwicm9sZSI6IiIsInZhbGlkYXRlIjoiIiwiaWF0IjoxNjIwMzU1OTgzLCJleHAiOjE2MjA0NDIzODN9.6MHgRkeJR_Ih78OQ7L0D4Lb5wO9WTWY-TSfov299CRc"
            ),
            ));

            $response = curl_exec($curl);
            $data = json_decode($response, true);
            // return $data;
            // echo $data;
            echo json_encode($data);
    }

    public function get_by()
    {

            $curl = curl_init();
            $get_by = json_encode(array(
                // "nopols"  => "7001"
                // "pengaduanid"  => "27",
                // "userid" => "20"
            ));
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.solo.indicar.id/users/publik/list",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",    
            "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NiwibmFtYSI6InVzZXIyIiwiZW1haWwiOiJ1c2VyMkBnbWFpbC5jb20iLCJub2hwIjoiIiwicm9sZSI6IiIsInZhbGlkYXRlIjoiIiwiaWF0IjoxNjIwMzU1OTgzLCJleHAiOjE2MjA0NDIzODN9.6MHgRkeJR_Ih78OQ7L0D4Lb5wO9WTWY-TSfov299CRc"
            ),
            CURLOPT_POSTFIELDS => $get_by,
            ));

            $response = curl_exec($curl);
            $data = json_decode($response, true);
            return $data;
            // echo $data;
            // echo json_encode($data);
    }

    function hahaha(){
        echo json_encode($this->get_by());
    }

}

