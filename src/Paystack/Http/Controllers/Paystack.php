<?php
namespace IVal\Interpay\Paystack\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IVal\Interpay\Paystack\Helpers\AcceptPayment;

class Paystack  {
    public function acceptPayment($email,$amount) {
        return AcceptPayment::initialize($email, $amount);
    }

    public function verifyPayment($reference){
        return AcceptPayment::verify($reference);
    }
    public static function refund($transaction_id, $amount){
        AcceptPayment::refund($transaction_id, $amount);
    }
}