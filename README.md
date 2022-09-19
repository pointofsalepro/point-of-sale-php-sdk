![Point of Sale Pro PHP SDK](https://i.imgur.com/tf61jYX.png)
# Point of Sale Pro PHP Software Development Kit

Point of Sale Pro is currently available for wide release. This repository provides examples of PHP files.

## How to use
Edit config.include.php

```php

    ##/ Get API Key and Secret from https://pointofsale.pro
    $key='';
    $secret='';
    
```

Once updated, grab any file available and run. 

For example, the `timestamp` of the server

```php
<?php

    ##/
    include "config.include.php";

    ##/
    $result = $PointOfSale->timestamp();

    ##/
    print_r($result);
?>

```

For example the url for the above is

```
https://api.pointofsale.pro/api/v1/system/timestamp/
```

Output:

```javascript
// 20220919125739
// https://api.pointofsale.pro/api/v1/system/timestamp/

{
  "data": {
    "milliseconds": 1663567059116,
    "unix_timestamp": 1663567059
  },
  "system": {
    "time": {
      "unix": 1663567059,
      "universal": 1663567059064,
      "zone": "UTC",
      "query": 0.053396,
      "render": 1663567059
    },
    "protocol": {
      "version": 1,
      "status": 200
    },
    "constant": {
      "requested": "/api/v1/system/timestamp/",
      "auth": false,
      "using_api": false,
      "id": "dev-pq8ja.api.pointofsale.pro",
      "ip": "<your-ip>"
    },
    "authorization": {
      "success": true
    }
  },
  "errors": [
    
  ]
}
```

