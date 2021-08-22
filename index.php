<?php
require './vendor/autoload.php';

use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Entity\Customers\Customer;
use RetailCrm\Api\Model\Request\Customers\CustomersCreateRequest;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient('https://superposuda.retailcrm.ru/', 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');
$order = new Order();
$request = new OrdersCreateRequest();

$order->lastName      = 'Kovach';
$order->firstName     = 'Ivan';
$order->patronymic = 'Victorovich';
$order->orderType     = 'fizik';
$order->orderMethod = 'test';
$order->number = '17072001';
$order->customFields = ['prim' => 'тестовое задание'];
$order->customerComment = ''

$request->order = $order;
$request->site  = 'test';

try {
    $response = $client->orders->create($request);
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception;
    exit(-1);
}

printf(
    'Created order id = %d with the following data: %s',
    $response->id,
    print_r($response->order, true)
);
