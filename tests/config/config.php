<?php
return [
    'language' => 'en-US',
    'name' => 'name2',
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'db' => [
            'dsn' => 'sqlite:' . __DIR__ . '/../../data/test.db',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];