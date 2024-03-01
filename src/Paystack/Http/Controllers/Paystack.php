<?php
namespace IVal\Interpay\Paystack\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IVal\Interpay\Paystack\Helpers\AcceptPayment;

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
}