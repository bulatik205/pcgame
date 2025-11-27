<?php
function game($main_pdo, $userId, $firstName)
{
    $stmt = $main_pdo->prepare("SELECT * FROM users WHERE telegram_id = ?");
    $stmt->execute([$userId]);
    $userSQL = $stmt->fetch(PDO::FETCH_ASSOC);
    $gameFlag = false;
    $balance = $userSQL['balance'];

    if ($userSQL['lastGame'] == "0") {
        $gameFlag = true;
    } else {
        $lastGameTime = strtotime($userSQL['lastGame']);
        $currentTime = time();
        $diffSeconds = $currentTime - $lastGameTime;

        if ($diffSeconds >= 60) {
            $gameFlag = true;
        } else {
            $secondsLeft = 60 - $diffSeconds;
            return "<b>💰 Играть можно через $secondsLeft секунд</b>";
        }
    }

    if ($gameFlag) {
        $components = [
            $userSQL['gpu'],
            $userSQL['ram'],
            $userSQL['cpu'],
            $userSQL['monitor']
        ];

        $value = null;

        $placeholders = str_repeat('?,', count($components) - 1) . '?';
        $stmt = $main_pdo->prepare("SELECT SUM(price_rub) as total_price FROM components WHERE name IN ($placeholders)");
        $stmt->execute($components);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $e = $result['total_price'] ?? 0;

        if ($e === 0) {
            return "<b>🧨 Фатальная ошибка базы данных. Поиграть не получится</b>";
        } else {
            $baseValue = $e / (log($e, 10) * 2);
            $randomMultiplier = mt_rand(60, 120) / 100;
            $value = ceil($baseValue * $randomMultiplier);
            $balance += $value;
        }

        $stmt = $main_pdo->prepare("UPDATE users SET lastGame = NOW(), balance = ? WHERE telegram_id = ?");
        $stmt->execute([$balance, $userId]);
        
        // Добавляем информацию о множителе в сообщение
        $multiplierText = number_format($randomMultiplier, 2);
        return "<b>💰 Игра сыграна! \n\n<blockquote>🏵 Получено: +{$value} монет\n🎲 Множитель: x{$multiplierText}\n💥 Новый баланс: {$balance} монет</blockquote></b>";
    }
}