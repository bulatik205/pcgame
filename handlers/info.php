<?php
function getInfo($main_pdo, $userId, $firstName) {
    try {
        $stmt = $main_pdo->prepare("SELECT * FROM users WHERE telegram_id = ?");
        $stmt->execute([$userId]);
        $dataSQL = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dataSQL) {
            return "❌ Пользователь не найден";
        }

        $systemId = $dataSQL['id'];
        $balance = $dataSQL['balance'];
        $lastCash = $dataSQL['lastCash'];
        $cpu = $dataSQL['cpu'];
        $gpu = $dataSQL['gpu'];
        $ram = $dataSQL['ram'];
        $monitor = $dataSQL['monitor'];
        $mouse = $dataSQL['mouse'];
        $micro = $dataSQL['micro'];


        return "<b>
🎮 Игрок: {$firstName}

<blockquote>⛓️ Telegram ID: {$userId}
⛓️ System ID: {$systemId}
</blockquote>
<blockquote>┌ 🌟 Информация
├ 🔸 Баланс: {$balance} монет
├ 🔸 В разработке: {$lastCash}
├ 🔸 Процессор: <a href='https://yandex.ru/search/?text={$cpu}'>{$cpu}</a>
├ 🔸 Видеокарта: <a href='https://yandex.ru/search/?text={$gpu}'>{$gpu}</a>
├ 🔸 Оперативка: <a href='https://yandex.ru/search/?text={$ram}'>{$ram}</a>
├ 🔸 Монитор: <a href='https://yandex.ru/search/?text={$monitor}'>{$monitor}</a>
├ 🔸 Микрофон: <a href='https://yandex.ru/search/?text={$micro}'>{$micro}</a>
└ 🔸 Мышь: <a href='https://yandex.ru/search/?text={$mouse}'>{$mouse}</a>
</blockquote>
</b>";
    } catch (Exception $e) {
        return "Ошибка: " . $e->getMessage();
    }
}
?>