<?php
require './vendor/autoload.php';

use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\CustomersCorporate\Company;

$client = SimpleClientFactory::createClient('https://superposuda.retailcrm.ru/', 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');
$order = new Order();
$offer = new Offer();
$request = new OrdersCreateRequest();
$item = new OrderProduct();
$company = new Company();

$offer->article = 'AZ105R';

$company->brand = 'Azalita';

$item->offer = $offer;
$item->productName = 'Маникюрный набор AZ105R Azalita';

$order->number = '17072001';
$order->status = 'trouble';
$order->orderType = 'fizik';
$order->orderMethod = 'test';
$order->lastName = 'Kovach';
$order->firstName = 'Ivan';
$order->patronymic = 'Victorovich';
$order->customFields = ['prim' => 'тестовое задание'];
$order->customerComment = 'https://github.com/Houseisbck/TestKolosov';
$order->items = [$item];
$order->company = $company;

$request->order = $order;
$request->site = 'test';

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
