<?php
function casino($main_pdo, $userId, $firstName, $betAmount) {
    $stmt = $main_pdo->prepare("SELECT balance FROM users WHERE telegram_id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user['balance'] < $betAmount) {
        return "<b>❌ Недостаточно средств для ставки {$betAmount} монет</b>";
    }
    
    $random = mt_rand(1, 100);
    
    if ($random <= 66) { 
        $winAmount = 0;
        $resultText = "❌ Проигрыш";
        $multiplier = "x0";
    } elseif ($random <= 88) { 
        $winAmount = $betAmount * 0.8;
        $resultText = "🔻 Маленький проигрыш";
        $multiplier = "x0.8";
    } elseif ($random <= 97) {
        $winAmount = $betAmount * 1;
        $resultText = "⚖️ Ничья";
        $multiplier = "x1";
    } else { 
        $winAmount = $betAmount * 1.1;
        $resultText = "✅ Маленький выигрыш";
        $multiplier = "x1.1";
    }
    
    $winAmount = ceil($winAmount);
    
    $newBalance = $user['balance'] - $betAmount + $winAmount;
    $stmt = $main_pdo->prepare("UPDATE users SET balance = ? WHERE telegram_id = ?");
    $stmt->execute([$newBalance, $userId]);
    
    return "<b>🎰 Результат игры:\n\n<blockquote>{$resultText} {$multiplier}\n💠Ставка: {$betAmount} монет\n😇 Выигрыш: {$winAmount} монет\n♻️ Новый баланс: {$newBalance} монет</blockquote></b>";
}