<?php
/** @var int $clientId */
/** @var array $errors */
/** @var array $old */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оставить отзыв</title>
</head>
<body>
<h2>Оцените качество обслуживания</h2>

<form method="POST" action="/">
    <input type="hidden" name="client_id" value="<?= htmlspecialchars((string) $clientId) ?>">

    <div>
        <label><input type="radio" name="rating" value="1" <?= (($old['rating'] ?? '') == '1') ? 'checked' : '' ?>> 1</label>
        <label><input type="radio" name="rating" value="2" <?= (($old['rating'] ?? '') == '2') ? 'checked' : '' ?>> 2</label>
        <label><input type="radio" name="rating" value="3" <?= (($old['rating'] ?? '') == '3') ? 'checked' : '' ?>> 3</label>
        <label><input type="radio" name="rating" value="4" <?= (($old['rating'] ?? '') == '4') ? 'checked' : '' ?>> 4</label>
        <label><input type="radio" name="rating" value="5" <?= (($old['rating'] ?? '') == '5') ? 'checked' : '' ?>> 5</label>
    </div>

    <?php if (!empty($errors['rating'])): ?>
        <p style="color:red;"><?= htmlspecialchars($errors['rating']) ?></p>
    <?php endif; ?>

    <br>

    <div>
        <label for="comment">При желании оставьте комментарий к отзыву</label><br>
        <textarea id="comment" name="comment" rows="5" cols="50"><?= htmlspecialchars($old['comment'] ?? '') ?></textarea>
    </div>

    <?php if (!empty($errors['comment'])): ?>
        <p style="color:red;"><?= htmlspecialchars($errors['comment']) ?></p>
    <?php endif; ?>

    <br>

    <button type="submit">Отправить</button>
</form>
</body>
</html>