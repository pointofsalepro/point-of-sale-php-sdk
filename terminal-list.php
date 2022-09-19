<?php

    ##/
    include "config.include.php";

    ##/
    $result = $PointOfSale->terminalList();
    ##/
    print_r($result);
