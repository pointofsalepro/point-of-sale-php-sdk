<?php

    ##/
    include "config.include.php";

    ##/ Transactions Today
    $result = $PointOfSale->transactionsList(array('date_from'=>1));

    ##/ Transactions This Week
    #$result = $PointOfSale->transactionsList(array('date_from'=>2));

    ##/ Transactions Last Week
    #$result = $PointOfSale->transactionsList(array('date_from'=>3));

    ##/ Transactions This Month
    #$result = $PointOfSale->transactionsList(array('date_from'=>4));

    ##/ Transactions All
    #$result = $PointOfSale->transactionsList(array('date_from'=>6));

    ##/
    print_r($result);


/*

```javascript

function titleTrans(id,title)
{
	switch(parseInt(id))
	{
		case 1: return 'Transactions Today';
		case 2: return 'Transactions This Week';
		case 3: return 'Transactions Last Week';
		case 4: return 'Transactions This Month';
		case 6: return 'All Transactions';
	}

	return '';

}

```

*/