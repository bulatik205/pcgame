<?php
$shopButtons = [
    'inline_keyboard' => [
        [
            ['text' => '🕹 Процессоры', 'callback_data' => 'cpu_main'],
            ['text' => '🕹 Видеокарты', 'callback_data' => 'gpu_main']
        ],
        [
            ['text' => '🕹 Оперативная память', 'callback_data' => 'ram_main']
        ],
        [
            ['text' => '🕹 Мониторы', 'callback_data' => 'monitor_main'],
            ['text' => '🕹 Мышки', 'callback_data' => 'mice_main']
        ],
        [
            ['text' => '🕹 Другие товары', 'callback_data' => 'more']
        ]
    ]
];