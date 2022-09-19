<?php

    ##/
    include "config.include.php";

    ##/
    $result = $PointOfSale->latestClockins();
    ##/
    print_r($result);
