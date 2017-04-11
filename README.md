# TradeTracker API client

[![Latest Stable Version](https://img.shields.io/packagist/v/whitelabeled/tradetracker-api-client.svg)](https://packagist.org/packages/whitelabeled/tradetracker-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/whitelabeled/tradetracker-api-client.svg)](https://packagist.org/packages/whitelabeled/tradetracker-api-client)
[![License](https://img.shields.io/packagist/l/whitelabeled/tradetracker-api-client.svg)](https://packagist.org/packages/whitelabeled/tradetracker-api-client)

Library to retrieve sales from the TradeTracker API.
This API is intended for publishers who would like to automatically import transaction data.

Usage:

```php
<?php
require 'vendor/autoload.php';

$client = new \whitelabeled\TradeTrackerApi\TradeTrackerClient('1234567', 'abcdef1234567890abcdef1234567890');

$transactions = $client->getTransactions(new DateTime('2017-03-01'), new DateTime('2017-03-10'));

print_r($transactions);
/*
 * Returns:
Array
(
    [0] => whitelabeled\TradeTrackerApi\Transaction Object
        (
            [id] => 3234595375
            [transactionDate] => DateTime Object
                (
                    [date] => 2017-03-02 13:36:23.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2017-03-02 13:25:52.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [assessmentDate] => DateTime Object
                (
                    [date] => 2017-03-20 18:10:52.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [program] => NSInternational.nl
            [programId] => 943
            [status] => accepted
            [rejectionReason] => 
            [reference] => tickets
            [commission] => 0.861
            [orderValue] => 28.7
            [orderDescription] => BEBCE|2|1|2017-03-03
            [mediaId] => 123456
            [mediaName] => Your website name
            [paidOut] => 1
            [transactionType] => sale
        )

    [1] => whitelabeled\TradeTrackerApi\Transaction Object
        (
            [id] => 3898934503
            [transactionDate] => DateTime Object
                (
                    [date] => 2017-03-02 22:08:46.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2017-03-02 21:39:46.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [assessmentDate] => DateTime Object
                (
                    [date] => 2017-03-20 18:10:52.000000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [program] => NSInternational.nl
            [programId] => 943
            [status] => accepted
            [rejectionReason] => 
            [reference] => i-tickets
            [commission] => 0.792
            [orderValue] => 26.4
            [orderDescription] => BEABC|2|2|2017-03-03
            [mediaId] => 123456
            [mediaName] => Your website name
            [paidOut] => 1
            [transactionType] => sale
        )
)
*/
```

## License

© Goldlabeled BV

MIT license, see [LICENSE.txt](LICENSE.txt) for details.