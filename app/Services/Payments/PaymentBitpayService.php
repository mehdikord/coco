<?php
namespace App\Services\Payments;

use App\Models\Gateway;
use http\Url;

class PaymentBitpayService {

    public $api;
    public $url;
    public $redirect;
    public $sandbox;
    public $verify;

    public function __construct()
    {
        if (env('APP_ENV') == 'production'){
            $this->sandbox=false;
            $this->url = "https://bitpay.ir/payment-test/gateway-send";
            $this->redirect="";
            $this->verify="https://bitpay.ir/payment-test/gateway-result-second";

        }else{
            $this->sandbox=true;
            $this->url = "https://bitpay.ir/payment-test/gateway-send";
            $this->redirect="";
            $this->verify="https://bitpay.ir/payment-test/gateway-result-second";
        }
        $gateway = Gateway::where('key','bitpay')->where('sandbox',$this->sandbox)->first();
        if ($gateway){
            $this->api = $gateway->api;
        }

    }

    public function start()
    {




    }









   public function send($url,$api,$amount,$redirect,$factorId,$name,$email,$description){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&amount=$amount&redirect=$redirect&factorId=$factorId&name=$name&email=$email&description=$description");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
    public function get($url,$api,$trans_id,$id_get){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&id_get=$id_get&trans_id=$trans_id&json=1");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }




}
