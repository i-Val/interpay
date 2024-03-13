<?php
namespace IVal\Interpay\Paystack\Helpers;


class Transfer {
    public static function create_recipient($type = 'nuban', String $name, $account_number, $bank_code, $currency, $secret_key){
        $url = "https://api.paystack.co/transferrecipient";
      
        $fields = [
          "type" => $type/*nuban*/,
          "name" => $name,
          "account_number" => $account_number,
          "bank_code" => $bank_code,
          "currency" => $currency
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
        $result = curl_exec($ch);
        return response()->json($result);
    }
      
    public static function list_recipients($secret_key) {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transferrecipient/",
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
      
    public static function initiateTransfer($amount, $recipient_code, $reference, $reason = "confidential", $secret_key) {
        $url = "https://api.paystack.co/transfer";

        $fields = [
        'source' => "balance",     
        'amount' => $amount,          
        "reference" => $reference,      
        'recipient' => $recipient_code,      
        'reason' => $reason      
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
        $result = curl_exec($ch);    
        return $result;
    }

    public static function initiateBulkTransfer($currency = "NGN", $source = "balance", $recipients, $secret_key) {
        $url = "https://api.paystack.co/transfer/bulk";

        $fields = [
            'currency' => $currency,
            'source' => $source,
            'transfers' => $recipients
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
        $result = curl_exec($ch);
        return $result;
    }
      
    public static function verifyTransfer($reference, $secret_key) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transfer/verify/$reference",
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
    public static function fetchTransfer($code, $secret_key) {

        $curl = curl_init();


        curl_setopt_array($curl, array(     
        CURLOPT_URL => "https://api.paystack.co/transfer/$code",    
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
      
    public static function finalizeTransfer($transfer_code, $otp, $secret_key) {

        $url = "https://api.paystack.co/transfer/finalize_transfer";

        $fields = [
            "transfer_code" => $transfer_code, 
            "otp" => $otp
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $secret_key ",
            "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        return $result;

    }
}