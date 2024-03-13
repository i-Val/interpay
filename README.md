# Interpay

Laravel payment integrtation.

## Description

A payment integration package for laravel. It currently has support for Paystack

## Getting Started

### 1. Installation


```
composer require i-val/interpay
```

### 2. Publishing assets

* How to run the program
* Step-by-step bullets
```
php artisan vendor:publish --tag config
```

### 3. Environment Variables
 create the following variables in your .env file...
 ```
 PAYSTACK_SECRET_KEY = key goes her
 PAYSTACK_PUBLIC_KEY = key goes her
 ```

## Accept Payment

First, you need to import the "Paystack" class 
```php
use IVal\Interpay\Paystack\Paystack;
```
To collect payment to your paystact wallet...

```php
    $paystack = new Paystack;
    $paystack->accepPayment($email, $amount);
```
To verify payment...

```php
    $paystack = new Paystack;
    $paystack->accepPayment($reference);
```
.$reference above is the unique transaction reference returned after a successful payment


For refunds, pass in the transaction id generated during payment, alongside the amount

```php
    $paystack = new Paystack;
    $paystack->refund($transaction_id, $amount);
```

## Transfers

### Transfer recipients
To create a transfer recipient, you need to pass in an associative array as follows
```php
    $paystack = new Paystack;

    $data = [
        "type" => "nuban"
        "name" => "recipient_name"
        "account_number" => "recipient_account_number"
        "bank_code" => "recipient bank's 3 digit code"
        "currency" => "NGN"
    ]

    $paystack->createRecipient($data);
```
### Initiate TransferS
You'll need a unique, generated transfer reference and the recipient code returned from the createRecipient() method. 
```php
    $paystack = new Paystack;

    $data = [
        "amount" => "amount"
        "recipient_code" => "recipient_code"
        "reference" => "reference"
        "reason" => "lorem ipsum"
    ];

    $paystack->initiateTransfer($data);
```
### Initiate Bulk TransferS
You'll need to pass in the recipient details above, but this time it will be a multidimensional array
```php
    $paystack = new Paystack;

    $data =[ 
        [
        "amount" => "amount"
        "recipient_code" => "recipient_code"
        "reference" => "reference"
        "reason" => "lorem ipsum"
    ],
        [
        "amount" => "amount"
        "recipient_code" => "recipient_code"
        "reference" => "reference"
        "reason" => "lorem ipsum"
    ],
        [
        "amount" => "amount"
        "recipient_code" => "recipient_code"
        "reference" => "reference"
        "reason" => "lorem ipsum"
    ],
        [
        "amount" => "amount"
        "recipient_code" => "recipient_code"
        "reference" => "reference"
        "reason" => "lorem ipsum"
    ],
    ];

    $paystack->initiateBulkTransfer($data);
```

### Fetch Transfer

To fetch a transfer deatail, pass in the transfer id or code

```php
    $paystack = new Paystack;
    $paystack->fetchTransfer($code);
```

### Verify Transfer

To verify a transfer deatail, pass in the transfer $reference

```php
    $paystack = new Paystack;
    $paystack->verufyTransfer($transaction_id, $amount);
```

### OTP enabled Transactions

For otp enebled transactions, you'll need to call the finalize tranfer method which accepts the $transfer_code and $otp as arguments.

```php
    $paystack = new Paystack;
    $paystack->finalizeTransfer($transfer_code, $otp);
```

### Check Balance
  
  ```php
     $paystack = new Paystack;
     $paystack->checkBallance();
```

## Security Vulnerabilities
If you discover any security vulnerabilities, please reach out to Valentine Iwuchukwu via [valentineiwuchukwu@outlook.com](mailto:valentineiwuchukwu@outlook.com)

## License

This project is an open-source software licensed under the MIT license