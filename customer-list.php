<?php

    ##/
    include "config.include.php";

    ##/
    $result = $PointOfSale->customerList();
    ##/
    print_r($result);
