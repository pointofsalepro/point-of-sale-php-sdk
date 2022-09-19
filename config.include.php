<?php

    ##/ Enable Error Handling
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    ##/ Include Class
    include "src/PointOfSaleClass.php";

    ##/ Get API Key and Secret from https://pointofsale.pro
    $key='';
    $secret='';

    ##/ Init
    $PointOfSale = new PointOfSalePro($key,$secret);
