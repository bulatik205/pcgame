<?php
require 'config/config.php';
require 'config/texts.php';
require 'config/inline.php';
$update = json_decode(file_get_contents('php://input'), true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $userId;
    $userText = $update['message']['text'];
    $chatType = $update['message']['chat']['type'];
    $firstName = $update['message']['from']['first_name'];
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'parse_mode' => 'HTML'
    ];
    $dataSend = false;

    if ($chatType == "group") {
        $userId = $update['message']['from']['id'];
    } elseif ($chatType == "private") {
        $userId = $chatId;
    }

    try {
        $stmt = $main_pdo->prepare("SELECT id FROM users WHERE telegram_id = ?");
        $stmt->execute([$userId]);
        $dataSQL = $stmt->fetchColumn();

        if (empty($dataSQL)) {
            $stmt = $main_pdo->prepare("INSERT INTO users (telegram_id, lastCash) VALUES (?, ?)");
            $stmt->execute([$userId, "0"]);
        }
    } catch (Exception $e) {
        $data['text'] = "Ошибка: " . $e->getMessage();
        $dataSend = true;
    }

    switch ($userText) {
        case '/start':
            $data['text'] = "<b>🎮 GameBot \n\n🏵 Игра-симулятор, в которой нужно прокачивать комплектующие вашего ПК, играть в игры или играть в КАЗИНО\n<blockquote>┌ 💎 Команды\n├ ➥ /start - вызвать это меню\n├ ➥ /shop - магазин с товарами\n├ ➥ /bonus - получить бонус\n├ ➥ /game - играть\n├ ➥ /info - информация о вас\n└ ➥ /casino - игра в казино</blockquote></b>";
            $dataSend = true;
            break;

        case '/info':
            require 'handlers/info.php';
            $data['text'] = getInfo($main_pdo, $userId, $firstName);
            $data['disable_web_page_preview'] = true;
            $dataSend = true;
            break;

        case '/bonus':
            require 'handlers/bonus.php';
            $data['text'] = getBonus($main_pdo, $userId, $firstName);
            $dataSend = true;
            break;

        case '/shop':
            $data['text'] = "<b>🕹 Магазин с товарами <blockquote>Покупайте новые комплектующие для увеличения прибыли</blockquote></b>";
            $dataSend = true;
            $data['reply_markup'] = json_encode($shopButtons);
            break;

        case '/game':
            require 'handlers/game.php';
            $data['text'] = game($main_pdo, $userId, $firstName);
            $dataSend = true;
            break;

        case (strpos($userText, '/casino') === 0):
            require 'handlers/casino.php';

            $parts = explode(' ', $userText, 2);
            $betAmount = 0;

            if (isset($parts[1])) {
                $betAmount = (int)$parts[1];

                if ($betAmount <= 0) {
                    $data['text'] = "<b>❌ Неверная сумма ставки. Используйте: /casino 100</b>";
                    $dataSend = true;
                    break;
                }
            } else {
                $data['text'] = "<b>🎰 Казино\n\n<blockquote>⛓️ Используйте: /casino [сумма]\n⛓️ Пример: <code>/casino 100</code></blockquote></b>";
                $dataSend = true;
                break;
            }

            $data['text'] = casino($main_pdo, $userId, $firstName, $betAmount);
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
    }
}

if (isset($update['callback_query'])) {
    require 'handlers/callbacks.php';

    $callback = $update['callback_query'];
    $chatId = $callback['message']['chat']['id'];
    $messageId = $callback['message']['message_id'];
    $callbackData = $callback['data'];
    $userId = $callback['from']['id'];

    $url = "https://api.telegram.org/bot$token/";

    try {
        $response = handleCallback($callbackData, $userId, $main_pdo);
        $responseText = $response['text'];
        $replyMarkup = $response['reply_markup'];

        $answerCallback = ['callback_query_id' => $callback['id']];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "answerCallbackQuery");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($answerCallback));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        $editMessage = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $responseText,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode($replyMarkup)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "editMessageText");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($editMessage));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
    } catch (Exception $e) {
        error_log("Callback error: " . $e->getMessage());
    }
}
