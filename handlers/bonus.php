<?php
function getBonus($main_pdo, $userId, $firstName) {
    $stmt = $main_pdo->prepare("SELECT * FROM users WHERE telegram_id = ?");
    $stmt->execute([$userId]);
    $dataSQL = $stmt->fetch(PDO::FETCH_ASSOC);
    $bonusFlag = false;
    $balance = $dataSQL['balance'];

    if ($dataSQL['lastCash'] == "0") {
        $bonusFlag = true;
    } else {
        $lastCashTime = strtotime($dataSQL['lastCash']);
        $currentTime = time();
        $diffMinutes = ($currentTime - $lastCashTime) / 60;

        if ($diffMinutes >= 60) {
            $bonusFlag = true;
        } else {
            $minutesLeft = 60 - ceil($diffMinutes);
            return "<b>💰 Бонус можно получить через $minutesLeft минут(у/ы)</b>";
        }
    }

    if ($bonusFlag) {
        $balance += 150;
        $stmt = $main_pdo->prepare("UPDATE users SET lastCash = ?, balance = ? WHERE telegram_id = ?");
        $stmt->execute([date("Y-m-d H:i:s"), $balance, $userId]);
        return "<b>💰 Бонус получен! \n\n<blockquote>🏵 +150 монет\n💎 Новый баланс: {$balance}</blockquote></b>";
    }
}
