<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'pt-BR',
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'America/Sao_Paulo',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat'=>'php:d/m/Y H:i',
            'timeFormat'=>'php:H:i',
            'currencyCode' => 'R$',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'nullDisplay' => '',
        ],
    ],
    'timeZone' => 'America/Sao_Paulo',
    'language' => 'pt-BR',
];
