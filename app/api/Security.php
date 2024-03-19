<?php


namespace App\api;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;

class Security
{

    private $key;

    function __construct()
    {
        $this->key = explode(":", config('app.key'))[1];
    }

    public function encrypt()
    {
        $secret_iv = "baraemDongaFund";

        $key = hash('sha256', $this->key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $array = [
            "test" => "hello...",
            "abc" => 1,
            "arrayTest" => [
                "asdasd" => 1,
                "asdasd222" => "student"
            ]
        ];

        $encrypt = openssl_encrypt(json_encode($array), "AES-256-CBC", $key, 0, $iv);

        echo $encrypt . "<br>";

        $dec = $this->Decrypt($encrypt);
        echo $dec;
        
    }



    function decrypt($str)
    {
        $secret_iv = "baraemDongaFund";

        $key = hash('sha256', $this->key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        return openssl_decrypt(
            $str, "AES-256-CBC", $key, 0, $iv
        );
    }


}
