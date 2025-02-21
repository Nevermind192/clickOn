<?php
function addWorkDays($startDate, $days) {
    $date = new DateTime($startDate);
    $workDays = 0;

    while ($workDays < $days)
    {
        $date->modify('+1 day');
        $dayOfWeek = $date->format('N');
        if ($dayOfWeek < 6)
        {
            $workDays++;
        }
    }
    return $date->format('d-m-Y');
}

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $startDate = $_POST['startDate'];
    $days = (int)$_POST['days'];

    $result = addWorkDays($startDate, $days);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Производственный календарь</title>
</head>
<body>
    <form action="" method="POST">
        <label for="startDate">Дата:</label>
        <input type="date" name="startDate" value="<?php echo isset($_POST['startDate']) ? $_POST['startDate'] : '' ?>" required>
        <label for="days">Количество рабочих дней:</label>
        <input type="number" name="days" min="1" value="<?php echo isset($_POST['days']) ? $_POST['days'] : '' ?>" required>
        <button type="submit">Рассчитать</button>
    </form>
    <?php if (isset($result)): ?>
        <p>Дедлайн: <strong><?= $result ?></strong></p>
    <?php endif; ?>
</body>
</html>