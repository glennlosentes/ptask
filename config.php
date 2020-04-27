<?php

return [
    'base_rate' => 'EU',
    'decimals' => 2,
    'rate' => [
        'EU' => 0.01,
        'NON_EU' => 0.02

    ],

    'EU_COUNTRIES' => [
                'AT','BE','BG','CY','CZ','DE',
                'DK','EE','ES','FI','FR','GR',
                'HR','HU','IE','IT','LT','LU',
                'LV','MT','NL','PO','PT','RO',
                'SE','SI','SK'
    ],


    'BIN_LOOKUP' => [
        "class" => ptask\Repositories\Binlookup\BinList::class,
        "url" =>   'https://lookup.binlist.net/',
        'auth_type' => 'none', /* user, token, none */
        "username" => '',
        "password" => '',
        "token" => '',
        "defaultLocation" => 'EE'
    ],

    'FOREX_LOOKUP' => [
        "class" => ptask\Repositories\Forex\ExchangeRatesApi::class,
        "url" =>   'https://api.exchangeratesapi.io/latest',
        'auth_type' => 'none', /* user, token, none */
        "username" => '',
        "password" => '',
        "token" => '',
        "defaultCurrency" => 'EUR',
        "refreshTimeInHours" => 1
    ]
];