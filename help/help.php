<?php
$startInline = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 Мой сайт', 'url' => 'https://bulatik.website']
        ],
        [
            ['text' => '✏️ Информация', 'callback_data' => 'info'],
            ['text' => '🍀 GitHub', 'callback_data' => 'git']
        ],
        [
            ['text' => '📊 Статистика', 'callback_data' => 'stat'],
            ['text' => '🔗 Ссылки', 'callback_data' => 'links']
        ],
        [
            ['text' => '🪙 Орел/решка', 'callback_data' => 'random']
        ]
    ]
];

$gitLinks = [
    'inline_keyboard' => [
        [
            ['text' => '🍀 GitHub: bulatik205', 'url' => 'https://github.com/bulatik205']
        ],
        [
            ['text' => '🍀 GitHub: Homework', 'url' => 'https://github.com/bulatik205/homework'],
            ['text' => '🍀 GitHub: Spy', 'url' => 'https://github.com/bulatik205/spy']
        ],
        [
            ['text' => '🍀 GitHub: Math Api', 'url' => 'https://github.com/bulatik205/api'],
            ['text' => '🍀 GitHub: Forum', 'url' => 'https://github.com/bulatik205/forum']
        ],
        [
            ['text' => '🍀 GitHub: Linker', 'url' => 'https://github.com/bulatik205/linker']
        ],
        [
            ['text' => '🔙 Назад', 'callback_data' => 'main']
        ]
    ]
];

$back = [
    'inline_keyboard' => [
        [
            ['text' => '🔙 Назад', 'callback_data' => 'main']
        ]
    ]
];

$allLinks = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 Сайт', 'url' => 'https://bulatik.website']
        ],
        [
            ['text' => '🌐 Сайт: linker', 'url' => 'https://bulatik.website/linker'],
            ['text' => '🌐 Сайт: homework', 'url' => 'https://bulatik.website/homework']
        ],
        [
            ['text' => '🌐 Сайт: spy', 'url' => 'https://polygon.bulatik.website/'],
            ['text' => '🌐 Сайт: math api', 'url' => 'https://api.bulatik.website/']
        ],
        [
            ['text' => '❤️ Telegram', 'url' => 'https://t.me/bulatik205']
        ],
        [
            ['text' => '❤️ Telegram: бот', 'url' => 'https://t.me/phpbulatik_bot'],
            ['text' => '❤️ Telegram: канал', 'url' => 'https://t.me/wtfisphp']
        ],
        [
            ['text' => '🍀 GitHub: bulatik205', 'url' => 'https://github.com/bulatik205']
        ],
        [
            ['text' => '🍀 GitHub: Homework', 'url' => 'https://github.com/bulatik205/homework'],
            ['text' => '🍀 GitHub: Spy', 'url' => 'https://github.com/bulatik205/spy']
        ],
        [
            ['text' => '🍀 GitHub: Math Api', 'url' => 'https://github.com/bulatik205/api'],
            ['text' => '🍀 GitHub: Forum', 'url' => 'https://github.com/bulatik205/forum']
        ],
        [
            ['text' => '🍀 GitHub: Linker', 'url' => 'https://github.com/bulatik205/linker']
        ],
        [
            ['text' => '🔙 Назад', 'callback_data' => 'main']
        ]
    ]
];
$token = "8294718201:AAGpYlsPIBHpy2XfD2B4nJ4oaQCLqKDXZSU";
$update = json_decode(file_get_contents('php://input'), true);

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $userText = $update['message']['text'];
    $firstName = $update['message']['chat']['first_name'];
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [];
    $dataSend = false;

    switch ($userText) {
        case '/start':
            $data = [
                'chat_id' => $chat_id,
                'text' => "<b>✋ Привет, $firstName! Я - начинающий веб-разработчик</b> \n\n🎯 Мои проекты: \n<blockquote>📌 Homework - добавляйте домашнее задание. Оно будет видно всем \n📌 Spy - создайте публичное пространство со своей url-биографией \n📌 Math Api - api для работы с математикой</blockquote> \n 🕹 Подробнее: ",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($startInline)
            ];
            $dataSend = true;
            break;
    }


    if ($dataSend) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}

if (isset($update['callback_query'])) {
    $callback = $update['callback_query'];
    $chat_id = $callback['message']['chat']['id'];
    $userButtonType = $callback['data'];
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [];
    $dataSend = false;

    switch ($userButtonType) {
        case 'info':
            $data = [
                'chat_id' => $chat_id,
                'text' => "<b>✨ Информация:\n\n<blockquote>⚙️ Область разработки: Web-Fullstack</blockquote>\n\n<blockquote>💻 Языки: HTML, CSS, JS, PHP, SQL, Python\n⌨️ Дополнительно: SCSS, LARAVEL, GIT</blockquote>\n\n<blockquote>💠 Apps: VSCode, PyCharm, IntelliJ IDEA, Android Studio, Arduino, MAMP, Figma</blockquote>\n\n<blockquote>♻️ Управление: ISPmanager, PHPMyAdmin, <a href='https://www.pythonanywhere.com/'>PythonAnywhere</a>, <a href='https://reg.ru'>Reg.ru</a></blockquote>\n\n<blockquote>❤️ Телеграм: <a href='https://t.me/bulatik205'>личка</a></blockquote>\n<blockquote>❤️ Телеграм-канал: <a href='https://t.me/wtfisphp'>тгк</a></blockquote>\n\n🌇 Год рождения: 2010</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($back)
            ];
            $dataSend = true;
            break;

        case 'git':
            $data = [
                'chat_id' => $chat_id,
                'text' => "<b>✨ GitHub:</b>\n\n🎯 Мои проекты на GitHub: \n<blockquote>📌 Homework - добавляйте домашнее задание. Оно будет видно всем \n📌 Spy - создайте публичное пространство со своей url-биографией \n📌 Math Api - api для работы с математикой \n📌 Forum - оболочка для форума \n📌 Linker - переходите по заданным url. Добавляйте ссылки на страницу, переходите по ним, когда это необходимо</blockquote> \n 🕹 Ссылки: ",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($gitLinks)
            ];
            $dataSend = true;
            break;

        case 'stat':
            $data = [
                'chat_id' => $chat_id,
                'text' => "<b>📊 Статистика:</b>\n\n<blockquote>💠 Написано строк кода: 16.000+\n💠 Проектов: 5\n💠 В web разработке: год</blockquote>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($back)
            ];
            $dataSend = true;
            break;

        case 'links':
            $data = [
                'chat_id' => $chat_id,
                'text' => "<b>🔗 Ссылки</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($allLinks)
            ];
            $dataSend = true;
            break;

        case 'random':
            $int = rand(0, 1);
            $answerText = "";
            if ($int == 1) {
                $answerText = "✅ Выпал орел";
            } else {
                $answerText = "✅ Выпала решка";
            }
            file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?callback_query_id=" . $callback['id'] . "&text=" . $answerText);
            break;

        case 'main':
            $firstName = $callback['from']['first_name'];
            $editData = [
                'chat_id' => $chat_id,
                'message_id' => $callback['message']['message_id'],
                'text' => "<b>✋ Привет, $firstName! Я - начинающий веб-разработчик</b> \n\n🎯 Мои проекты: \n<blockquote>📌 Homework - добавляйте домашнее задание. Оно будет видно всем \n📌 Spy - создайте публичное пространство со своей url-биографией \n📌 Math Api - api для работы с математикой</blockquote> \n 🕹 Подробнее: ",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($startInline)
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/editMessageText");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($editData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            break;
    }

    if ($dataSend) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    file_get_contents("https://api.telegram.org/bot$token/answerCallbackQuery?callback_query_id=" . $callback['id']);
}
