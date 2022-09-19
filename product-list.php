<?php

    ##/
    include "config.include.php";

    ##/
    $result = $PointOfSale->productList();
    ##/
    print_r($result);
