<?php
require 'config/config.php';
require 'handlers/shop.php';

function handleCallback($callbackData, $userId, $main_pdo) {
    global $shopButtons;
    
    $response = [
        'text' => '',
        'reply_markup' => null
    ];

    try {
        switch ($callbackData) {
            case 'main':
                $response['text'] = "<b>🕹 Магазин с товарами <blockquote>Покупайте новые комплектующие для увеличения прибыли</blockquote></b>";
                $response['reply_markup'] = $shopButtons;
                break;

            case 'cpu_main':
                $response['text'] = "<b>🕹 Подберем процессор?<blockquote>Процессор - голова комьютера. Все операции проходят через него</blockquote></b>";
                $response['reply_markup'] = getShopCpuButtons();
                break;

            case 'cpu_intel':
                $response['text'] = "<b>💎 Отличный выбор. Процессоры Intel:</b>";
                $response['reply_markup'] = getShopCpuIntelButtons();
                break;

            case 'cpu_amd':
                $response['text'] = "<b>💎 Отличный выбор. Процессоры AMD:</b>";
                $response['reply_markup'] = getShopCpuAmdButtons();
                break;

            case 'gpu_main':
                $response['text'] = "<b>🎮 Видеокарты - дороже золота:</b>";
                $response['reply_markup'] = getShopGpuButtons();
                break;

            case 'ram_main':
                $response['text'] = "<b>🎮 Оперативная память - не оперативнее ФБР:</b>";
                $response['reply_markup'] = getShopRamButtons();
                break;

            case 'monitor_main':
                $response['text'] = "<b>🖥️ Мониторы - позволяет смотреть не только на блок ПК:</b>";
                $response['reply_markup'] = getShopMonitorButtons();
                break;

            case 'mice_main':
                $response['text'] = "🐭 Мышки - крысы есть всегда, наши мышки пока в разработке";
                $response['reply_markup'] = [
                    'inline_keyboard' => [
                        [['text' => '➥ Назад', 'callback_data' => 'main']]
                    ]
                ];
                break;

            case 'more':
                $response['text'] = "❤️ В разработке";
                $response['reply_markup'] = [
                    'inline_keyboard' => [
                        [['text' => '➥ Назад', 'callback_data' => 'main']]
                    ]
                ];
                break;

            default:
                $response = handleDefaultCallback($callbackData, $userId, $main_pdo);
                break;
        }
    } catch (Exception $e) {
        error_log("Callback handler error: " . $e->getMessage());
        $response['text'] = "❌ Произошла ошибка";
        $response['reply_markup'] = $shopButtons;
    }

    return $response;
}

function handleDefaultCallback($callbackData, $userId, $main_pdo) {
    global $shopButtons;
    
    $response = [
        'text' => '',
        'reply_markup' => null
    ];

    if (strpos($callbackData, 'buy_') === 0) {
        $response = handlePurchase($callbackData, $userId, $main_pdo);
    } elseif (
        strpos($callbackData, 'cpu_') === 0 ||
        strpos($callbackData, 'gpu_') === 0 ||
        strpos($callbackData, 'ram_') === 0 ||
        strpos($callbackData, 'monitor_') === 0
    ) {
        $response = handleComponentView($callbackData, $userId, $main_pdo);
    } else {
        $response['text'] = "❌ Неизвестная команда";
        $response['reply_markup'] = $shopButtons;
    }

    return $response;
}

function handlePurchase($callbackData, $userId, $main_pdo) {
    $componentId = str_replace('buy_', '', $callbackData);
    $response = [
        'text' => '',
        'reply_markup' => null
    ];

    try {
        $stmt = $main_pdo->prepare("SELECT * FROM components WHERE id = ?");
        $stmt->execute([$componentId]);
        $componentSQL = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (empty($componentSQL)) {
            $response['text'] = "❌ Товар не найден";
            return $response;
        }

        $stmt = $main_pdo->prepare("SELECT * FROM users WHERE telegram_id = ?");
        $stmt->execute([$userId]);
        $userSQL = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (empty($userSQL)) {
            $response['text'] = "❌ Пользователь не найден";
            return $response;
        }

        if ($userSQL['balance'] < $componentSQL['price_rub']) {
            $response['text'] = "❌ Недостаточно средств";
            return $response;
        }

        $componentType = $componentSQL['type'];
        $allowedColumns = ['cpu', 'gpu', 'ram', 'monitor'];
        
        if (!in_array($componentType, $allowedColumns)) {
            $response['text'] = "❌ Неизвестный тип товара";
            return $response;
        }

        $newBalance = $userSQL['balance'] - $componentSQL['price_rub'];
        $stmt = $main_pdo->prepare("UPDATE users SET balance = ?, $componentType = ? WHERE telegram_id = ?");
        $stmt->execute([$newBalance, $componentSQL['name'], $userId]);

        $response['text'] = "<b>💥 " . $componentSQL['name'] . " куплен за " . number_format($componentSQL['price_rub']) . " монет\n\n<blockquote>💸 Новый баланс: " . number_format($newBalance) . " монет</blockquote></b>";
        $response['reply_markup'] = [
            'inline_keyboard' => [
                [['text' => '🛍 В магазин', 'callback_data' => 'main']]
            ]
        ];

    } catch (Exception $e) {
        error_log("Purchase error: " . $e->getMessage());
        $response['text'] = "❌ Ошибка при покупке";
    }

    return $response;
}

function handleComponentView($callbackData, $userId, $main_pdo) {
    global $shopButtons;
    
    $response = [
        'text' => '',
        'reply_markup' => null
    ];

    $componentId = str_replace(['cpu_', 'gpu_', 'ram_', 'monitor_'], '', $callbackData);
    $component = getComponentInfo($componentId);

    if ($component) {
        $response['text'] = formatComponentInfo($component);
        
        try {
            $stmt = $main_pdo->prepare("SELECT balance FROM users WHERE telegram_id = ?");
            $stmt->execute([$userId]);
            $userBalance = $stmt->fetchColumn();
            
            if ($userBalance !== false) {
                $response['text'] .= "\n\n💰 Баланс: " . number_format($userBalance) . " монет";
            }
        } catch (Exception $e) {
            error_log("Balance check error: " . $e->getMessage());
        }
        
        $response['reply_markup'] = [
            'inline_keyboard' => [
                [
                    ['text' => '🛒 Купить', 'callback_data' => 'buy_' . $componentId],
                    ['text' => '➥ Назад', 'callback_data' => getBackCategory($callbackData)]
                ]
            ]
        ];
    } else {
        $response['text'] = "❌ Товар не найден";
        $response['reply_markup'] = $shopButtons;
    }

    return $response;
}

function formatComponentInfo($component) {
    $typeEmoji = [
        'cpu' => '🔧',
        'gpu' => '🎮',
        'ram' => '💾',
        'monitor' => '🖥️'
    ];
    $componentName = $component['name'];

    $emoji = $typeEmoji[$component['type']] ?? '📦';
    $text = "{$emoji} <b><a href='https://yandex.ru/search/?text={$componentName}'>{$componentName}</a></b>\n\n";
    $text .= "<blockquote>💵 <b>Цена:</b> " . number_format($component['price_rub']) . " монет\n";
    $text .= "⭐ <b>Уровень:</b> " . $component['level'] . "\n";

    if (!empty($component['specifications']) && $component['specifications'] !== 'empty') {
        $text .= "📋 <b>Характеристики:</b>\n" . $component['specifications'];
    }

    $text .= "</blockquote>";

    return $text;
}

function getBackCategory($callbackData) {
    if (strpos($callbackData, 'cpu_') === 0) return 'cpu_main';
    if (strpos($callbackData, 'gpu_') === 0) return 'gpu_main';
    if (strpos($callbackData, 'ram_') === 0) return 'ram_main';
    if (strpos($callbackData, 'monitor_') === 0) return 'monitor_main';
    return 'main';
}