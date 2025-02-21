<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");  // Подключаем шапку Битрикс
$APPLICATION->SetTitle("Новинки");  // Указываем заголовок страницы
?>

<!-- Здесь будет твой компонент -->
<?$APPLICATION->IncludeComponent(
    "myshop:last.products",   // Имя компонента
    ".default",                  // Шаблон компонента
    array(
        "IBLOCK_ID" => 1,        // ID инфоблока
        "CACHE_TIME" => 3600      // Время кеширования
    )
);?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");  // Подключаем подвал Битрикс
?>
