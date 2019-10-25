<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetTitle("Элементов - " . $arResult['COUNT']);
$APPLICATION->AddViewContent("PRICE", "Максимальная цена: " . $arResult['MAX'] . "</br> Минимальная цена: " . $arResult['MIN'] );