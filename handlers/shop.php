<?php
require 'config/config.php';

function getShopCpuButtons() {
    global $main_pdo;
    
    return [
        'inline_keyboard' => [
            [
                ['text' => '💎 Intel', 'callback_data' => 'cpu_intel']
            ],
            [
                ['text' => '💎 AMD', 'callback_data' => 'cpu_amd']
            ],
            [
                ['text' => '➥ Назад', 'callback_data' => 'main']
            ]
        ]
    ];
}

# Intel CPUs
function getShopCpuIntelButtons() {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("
            SELECT id, name, price_rub, level 
            FROM components 
            WHERE type = 'cpu' AND name LIKE '%Intel%' 
            ORDER BY level, price_rub
        ");
        $stmt->execute();
        $cpus = $stmt->fetchAll();
        
        return createComponentKeyboard($cpus, 'cpu', 'cpu_main');
        
    } catch (Exception $e) {
        error_log("Error getting Intel CPUs: " . $e->getMessage());
        return getErrorKeyboard();
    }
}

# AMD CPUs
function getShopCpuAmdButtons() {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("
            SELECT id, name, price_rub, level 
            FROM components 
            WHERE type = 'cpu' AND name LIKE '%AMD%' 
            ORDER BY level, price_rub
        ");
        $stmt->execute();
        $cpus = $stmt->fetchAll();
        
        return createComponentKeyboard($cpus, 'cpu', 'cpu_main');
        
    } catch (Exception $e) {
        error_log("Error getting AMD CPUs: " . $e->getMessage());
        return getErrorKeyboard();
    }
}

# GPUs
function getShopGpuButtons() {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("
            SELECT id, name, price_rub, level 
            FROM components 
            WHERE type = 'gpu' 
            ORDER BY level, price_rub
        ");
        $stmt->execute();
        $gpus = $stmt->fetchAll();
        
        return createComponentKeyboard($gpus, 'gpu', 'main');
        
    } catch (Exception $e) {
        error_log("Error getting GPUs: " . $e->getMessage());
        return getErrorKeyboard();
    }
}

# RAM
function getShopRamButtons() {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("
            SELECT id, name, price_rub, level 
            FROM components 
            WHERE type = 'ram' 
            ORDER BY level, price_rub
        ");
        $stmt->execute();
        $rams = $stmt->fetchAll();
        
        return createComponentKeyboard($rams, 'ram', 'main');
        
    } catch (Exception $e) {
        error_log("Error getting RAM: " . $e->getMessage());
        return getErrorKeyboard();
    }
}

# Monitors
function getShopMonitorButtons() {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("
            SELECT id, name, price_rub, level 
            FROM components 
            WHERE type = 'monitor' 
            ORDER BY level, price_rub
        ");
        $stmt->execute();
        $monitors = $stmt->fetchAll();
        
        return createComponentKeyboard($monitors, 'monitor', 'main');
        
    } catch (Exception $e) {
        error_log("Error getting Monitors: " . $e->getMessage());
        return getErrorKeyboard();
    }
}

// Универсальная функция создания клавиатуры
function createComponentKeyboard($components, $type, $backTo = 'main') {
    $keyboard = [];
    
    foreach ($components as $component) {
        $buttonText = formatButtonText($component['name'], $component['price_rub'], $component['level'], $type);
        
        $keyboard[] = [
            [
                'text' => $buttonText,
                'callback_data' => $type . '_' . $component['id']
            ]
        ];
    }
    
    $keyboard[] = [
        ['text' => '➥ Назад', 'callback_data' => $backTo]
    ];
    
    return ['inline_keyboard' => $keyboard];
}

// Форматирование текста для кнопки (максимум ~30 символов)
function formatButtonText($name, $price, $level, $type) {
    $emoji = getComponentEmoji($level, $type);
    
    $shortName = $name;
    if (mb_strlen($name) > 20) {
        $shortName = mb_substr($name, 0, 17) . '...';
    }
    
    return $emoji . ' ' . $shortName . ' - ' . number_format($price) . ' монет';
}

// Вспомогательные функции для эмодзи
function getComponentEmoji($level, $type) {
    $emojis = [
        'cpu' => ['🔸', '🔹', '🔶', '🔷', '💎', '💠'],
        'gpu' => ['🎮', '🕹️', '🎯', '🔥', '💥', '🚀'],
        'ram' => ['💾', '📀', '💿', '📊', '🚀', '⚡'],
        'monitor' => ['📺', '🖥️', '📀', '🎬', '🔥', '💎']
    ];
    
    $typeEmojis = $emojis[$type] ?? ['🔸', '🔹', '🔶', '🔷', '💎', '💠'];
    return $typeEmojis[min((int)$level - 1, count($typeEmojis) - 1)] ?? $typeEmojis[0];
}

function getErrorKeyboard() {
    return [
        'inline_keyboard' => [
            [['text' => '❌ Ошибка загрузки', 'callback_data' => 'main']]
        ]
    ];
}

// Функция для получения информации о конкретном компоненте
function getComponentInfo($id) {
    global $main_pdo;
    
    try {
        $stmt = $main_pdo->prepare("SELECT * FROM components WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log("Error getting component info: " . $e->getMessage());
        return null;
    }
}

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