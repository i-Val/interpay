<?php
namespace IVal\Interpay\Paystack\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IVal\Interpay\Paystack\Helpers\AcceptPayment;
use IVal\Interpay\Paystack\Helpers\Transfer;

class Paystack  {
    public $secret_key;
    
    public function __construct()
    {
        $this->secret_key = config('config.paystack_secret_key');
    }

    public function acceptPayment($email,$amount) {
        return AcceptPayment::initialize($email, $amount, $this->secret_key);
    }

    public function verifyPayment($reference){
        return AcceptPayment::verify($reference, $this->secret_key);
    }
    public function refund($transaction_id, $amount){
        AcceptPayment::refund($transaction_id, $amount, $this->secret_key);
    }

    public function createRecipient(Array $data) {
        $type = $data['type'];
        $name = $data['name'];
        $account_number = $data['account_number'];
        $bank_code = $data['bank_$bank_code'];
        $currency = $data['currency'];
        Transfer::create_recepient($type, $name, $account_number, $bank_code, $currency, $this->secret_key);
    }

    public function initiateTransfer($amount, $reference, $reason = 'payment') {
        return Transfer::initiateTransfer($amount, $reference, $reason, $this->secret_key);
    }

    public function initiateBulkTransfer($recepients) {        
        return Transfer::initiateBulkTransfer([$recepients], $this->secret_key);
    }

    public function fetchTransfer($code) {
        return Transfer::fetchTransfer($code, $this->secret_key);
    }

    public function verifyTransfer($reference) {
        return Transfer::verifyTransfer($reference, $this->secret_key);
    }

    public function finalizeTransfer($transfer_code, $otp) {
        return Transfer::finalizTransfer($transfer_code, $otp, $this->secret_key);
    }
}