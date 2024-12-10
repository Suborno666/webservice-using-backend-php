<?php


interface PaymentInterface{
    static function paymentProcess():string;
    static function setAmount($amount):void;
}

class PaypalPayment implements PaymentInterface{
    private static $amount;
    static function setAmount($userAmount):void
    {
        self::$amount = $userAmount;
    }
    static function paymentProcess(): string
    {
        return "Payment processed through PayPal with amount " . self::$amount;
    }
}

class CreditCardPayment implements PaymentInterface{
    private static $amount;
    static function setAmount($userAmount):void
    {
        static::$amount = $userAmount;
    }
    static function paymentProcess(): string
    {
        return "Payment processed through CreditCard with amount " . self::$amount;
    }
}


class PaymentProcessor{
    private PaymentInterface $paymentMethod;

    function __construct(PaymentInterface $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    function process(float $amount):void
    {
        $this->paymentMethod->setAmount($amount);
        echo $this->paymentMethod->paymentProcess();
    }
}

$paypal = new CreditCardPayment();
$paypalProcess = new PaymentProcessor($paypal);
$paypalProcess->process(25000);
