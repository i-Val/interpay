<?php
namespace IVal\Interpay\Paystack\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IVal\Interpay\Paystack\Helpers\AcceptPayment;

class Paystack extends Controller {
    public function acceptPayment($email,$amount) {
        AcceptPayment::initialize($email, $amount);
    }

    public static function verifyPayment($reference){
        AcceptPayment::verify($reference);
    }
    public static function refund($transaction_id, $amount){
        AcceptPayment::refund($transaction_id, $amount);
    }
}