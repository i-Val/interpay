<?php
namespace IVal\Interpay\Paystack\Helpers;

class AcceptPayment {
    public static function initialize($email, $amount, $secret_key) {
        $url = "https://api.paystack.co/transaction/initialize";

        $fields = [
          'email' => $email,
          'amount' => $amount,
          'callback_url' => "http://localhost:8000/verify",
          'metadata' => ["cancel_action" => "https://www.google.com"]
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer $secret_key",
          "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

        //execute post
         $result = json_decode(curl_exec($ch));

        if ($result->status) {

          $access_code = $result->data->access_code;
          $reference = $result->data->reference;
          $authorization_url = $result->data->authorization_url;

          return redirect($authorization_url);

        }else{
          return 'an error occured';
        }
        return 'no error';

        //return $result->data;
    }

    public static function verify($reference, $secret_key){
        $curl = curl_init();
      
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            // "Authorization: Bearer sk_test_a1d642a8379db2d7ba99b1756e3174e12f72285c",
            "Authorization: Bearer $secret_key",
            "Cache-Control: no-cache",
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
      
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return response()->json($response, 200);
        }
    }

    public static function refund($transaction_id, $amount, $secret_key) {
        $url = "https://api.paystack.co/refund";

        $fields = [
            'transaction' => $transaction_id,
            'amount' => $amount ,
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $secret_key",
            "Cache-Control: no-cache",
        ));

        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        // curl_setopt($ch,CURLOPT_RETURNREFUND, true); 


        //execute post
        $result = json_decode(curl_exec($ch));

        return $result;
    }
    
}