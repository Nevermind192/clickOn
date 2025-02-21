<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($_GET['clear_cache'] == 'Y') {
    $this->ClearResultCache(); // Очистить кеш компонента
}

if ($this->StartResultCache(3600, false))
{
    $res = CIBlockElement::GetList(
        array('DATE_CREATE' => 'DESC'), // Сортировка по порядку
        array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y'), // Фильтр по инфоблоку и активности
        false,
        array('nTopCount' => 5), // Ограничение на 5 товаров
        array('ID', 'NAME', 'DETAIL_PICTURE') // Поля, которые получаем
    );

    $products = array();
    while ($ob = $res->GetNextElement()) {
        $fields = $ob->GetFields();
        $properties = $ob->GetProperties();

        $priceData = CCatalogProduct::GetOptimalPrice($fields['ID']);
        $price = $priceData['RESULT_PRICE']['DISCOUNT_PRICE'];

        $previewPicture = CFile::ResizeImageGet(
            $fields['DETAIL_PICTURE'],
            array('width' => 200, 'height' => 200),
            BX_RESIZE_IMAGE_EXACT
        );

        $product = array(
            'ID' => $fields['ID'],
            'NAME' => $fields['NAME'],
            'DETAIL_PICTURE' => $previewPicture['src'],
            'PRICE' => $price ? $price : 'Не указана',
        );
        $products[] = $product;
    }

    $this->arResult['PRODUCTS'] = $products;
    $this->IncludeComponentTemplate();
}
?>
