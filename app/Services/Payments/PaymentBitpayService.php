<?php
namespace App\Services\Payments;

use App\Models\Gateway;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use function Symfony\Component\String\u;

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
            $this->redirect=route('front.system.payments.callback.bitpay');
            $this->verify="https://bitpay.ir/payment-test/gateway-result-second";

        }else{
            $this->sandbox=true;
            $this->url = "https://bitpay.ir/payment-test/gateway-send";
            $this->redirect=route('front.system.payments.callback.bitpay');
            $this->verify="https://bitpay.ir/payment-test/gateway-result-second";
        }
        $gateway = Gateway::where('key','bitpay')->where('sandbox',$this->sandbox)->first();
        if ($gateway){
            $this->api = $gateway->api;
        }

    }

    public function start($invoice)
    {
        return $this->send($invoice->price,$invoice->id);
    }

   public function send($amount,$factorId,$name=null,$email=null,$description=null){
        $data = [
            'api' => $this->api,
            'amount' => $amount,
            'redirect' => $this->redirect,
            'factorId'=> $factorId,
            'name' => $name,
            'email' => $email,
            'description' => $description
        ];
        $client = new Client();
        $send = $client->post($this->url,[
            'form_params' => $data
        ]);
        return $send->getBody();
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

    public function make_url($code): string
    {

        if (env('APP_ENV') == 'production'){
            $url = "https://bitpay.ir/payment/gateway-$code-get";
        }else{
            $url = "https://bitpay.ir/payment-test/gateway-$code-get";
        }
        return $url;
    }


}
