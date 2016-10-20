<?php
return array(
    'route' => [
        'prefix' => 'sent-emails',
        'middleware' => [
            'web',
            'auth',
        ],
    ],
    'exclude_groups' => [],
);