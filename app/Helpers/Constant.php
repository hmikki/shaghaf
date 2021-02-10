<?php


namespace App\Helpers;


class Constant
{
    const NOTIFICATION_TYPE = [
        'General'=>1,
        'Ticket'=>2,
        'Subscription'=>3,
        'Order'=>4,
    ];
    const VERIFICATION_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const VERIFICATION_TYPE_RULES = '1,2';
    const TICKETS_STATUS = [
        'Open'=>1,
        'Closed'=>2
    ];
    const SENDER_TYPE = [
        'User'=>1,
        'Admin'=>2,
    ];
    const PAYMENT_METHOD = [
        'BankTransfer'=>1,
        'Cash'=>2,
    ];
    const PAYMENT_METHOD_RULES = '1,2';
    const TRANSACTION_STATUS = [
        'Pending'=>1,
        'Paid'=>2,
    ];
    const TRANSACTION_TYPES = [
        'Deposit'=>1,
        'Withdraw'=>2,
        'Holding'=>3,
    ];
    const SETTING_TYPE = [
        'Page'=>1,
        'Notification'=>2,
        'Values'=>3,
    ];
    const USER_TYPE=[
        'Customer'=>1,
        'Freelancer'=>2
    ];
    const USER_TYPE_RULES = '1,2';
    const PRODUCT_TYPE=[
        'Service'=>1,
        'Product'=>2
    ];
    const PRODUCT_TYPE_RULES = '1,2';
    const MEDIA_TYPES = [
        'Product'=>1,
    ];
    const ORDER_STATUS = [
        'New' => 1,
        'Awaiting payment' => 5,
        'Payed' => 6,
    ];
    const ORDER_FREELANCER_STATUS = [
        'Accept' => 2,
        'Rejected' => 3,
        'In_progress' => 7,
        'Delivered' => 8,
    ];
    const ORDER_CLIENT_STATUS = [
        'Cancelled' => 4,
        'Recieved' => 9,
    ];
}
