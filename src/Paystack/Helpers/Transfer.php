<?php
namespace IVal\Interpay\Paystack\Helpers;

class Transfer {
    public static function create_recepient($type, $name, $account_number, $bank_code, $currency){
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
          "Authorization: Bearer sk_test_a1d642a8379db2d7ba99b1756e3174e12f72285c",
          "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        return response()->json($result);
    }
      
    public static function list_recepient() {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transferrecipient/71855877",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_a1d642a8379db2d7ba99b1756e3174e12f72285c",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
      
    public static function initiateTransfer($amount, $reference, $reason = "confidential") {
        $url = "https://api.paystack.co/transfer";

        $fields = [
        'source' => "balance",     
        'amount' => $amount,    
        // "reference" => "RCP_960r0bm3knoah8exxx",      
        "reference" => $reference,      
        'recipient' => "RCP_960r0bm3knoah8e",      
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
        "Authorization: Bearer sk_test_a1d642a8379db2d7ba99b1756e3174e12f72285c",   
        "Cache-Control: no-cache",    
        ));
    
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
    
        //execute post    
        $result = curl_exec($ch);    
        echo $result;
    }

    public static function initiateBulkTransfer($fields) {
        $url = "https://api.paystack.co/transfer/bulk";

        $fields = [
            'currency' => "NGN",
            'source' => "balance",
            'transfers' => [[
            "amount" => 20000,
            "reference" => "588YtfftReF355894J",
            "reason" => "Why not?",
            "recipient" => "RCP_2tn9clt23s7qr28"
            ],
            [
            "amount" => 30000,
            "reference" => "YunoTReF35e0r4J",
            "reason" => "Because I can",
            "recipient" => "RCP_1a25w1h3n0xctjg"
            ],
            [
            "amount" => 40000,
            "reason" => "Coming right up",
            "recipient" => "RCP_aps2aibr69caua7"
            ]]
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();
        

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer SECRET_KEY",
            "Cache-Control: no-cache",
        ));
        

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        

        //execute post
        $result = curl_exec($ch);
        echo $result;
    }
      
    public static function verifyTransfer($reference) {

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
            "Authorization: Bearer SECRET_KEY",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
            }
        }
    public static function fetchTransfer() {

        $curl = curl_init();


        curl_setopt_array($curl, array(     
        CURLOPT_URL => "https://api.paystack.co/transfer/:id_or_code",    
        CURLOPT_RETURNTRANSFER => true,    
        CURLOPT_ENCODING => "",     
        CURLOPT_MAXREDIRS => 10,     
        CURLOPT_TIMEOUT => 30,    
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,     
        CURLOPT_CUSTOMREQUEST => "GET",     
        CURLOPT_HTTPHEADER => array(     
            "Authorization: Bearer SECRET_KEY",     
            "Cache-Control: no-cache", 
        ),  
        ));
    
            
        $response = curl_exec($curl);
    
        $err = curl_error($curl);
        
        curl_close($curl);
    
        
        if ($err) {     
        echo "cURL Error #:" . $err;     
        } else {     
        echo $response;
        }
    }
      
    public static function finalizTransfer($transfer_code, $otp) {

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
            "Authorization: Bearer SECRET_KEY",
            "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        echo $result;

    }
}