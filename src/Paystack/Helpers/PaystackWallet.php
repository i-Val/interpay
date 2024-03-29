<?
namespace IVal\Interpay\Paystack\Helpers;


class PaystackWallet {
    public static function checkBallance($secret_key) {
        $curl = curl_init();


        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://api.paystack.co/balance",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "GET",

            CURLOPT_HTTPHEADER => array(

            "Authorization: Bearer $secret_key",

            "Cache-Control: no-cache",

            ),

        ));


        $response = curl_exec($curl);

        $err = curl_error($curl);


        curl_close($curl);


        if ($err) {

            return "cURL Error #:" . $err;

        } else {

            return $response;

        }
    }
}