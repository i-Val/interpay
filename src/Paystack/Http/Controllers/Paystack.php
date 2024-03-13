<?php
namespace IVal\Interpay\Paystack\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IVal\Interpay\Paystack\Helpers\AcceptPayment;
use IVal\Interpay\Paystack\Helpers\PaystackWallet;
use IVal\Interpay\Paystack\Helpers\Transfer;

class Paystack  {
    public $secret_key;
    
    public function __construct()
    {
        $this->secret_key = config('interpay.paystack_secret_key');
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
        $bank_code = $data['bank_code'];
        $currency = $data['currency'];

        return Transfer::create_recipient($type, $name, $account_number, $bank_code, $currency, $this->secret_key);
    }

    public function initiateTransfer($data) {
        $amount = $data['amount'];
        $recipient_code = $data['recipient_code'];
        $reference = $data['reference'];
        $reason = $data['reason'];

        return Transfer::initiateTransfer($amount, $recipient_code, $reference, $reason, $this->secret_key);
    }

    public function initiateBulkTransfer($currency, $source, $recipients) {   
        //recipients is an array of objects     
        return Transfer::initiateBulkTransfer($currency, $source, $recipients, $this->secret_key);
    }

    public function fetchTransfer($code) {
        return Transfer::fetchTransfer($code, $this->secret_key);
    }
    public function listRecipients() {
        return Transfer::list_recipients($this->secret_key);
    }

    public function verifyTransfer($reference) {
        return Transfer::verifyTransfer($reference, $this->secret_key);
    }

    public function finalizeTransfer($transfer_code, $otp) {
        return Transfer::finalizeTransfer($transfer_code, $otp, $this->secret_key);
    }

    public function checkBallance() {
        return PaystackWallet::checkBallance($this->secret_key);
    }
}