<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSelect = Array("NAME");
$arFilter = Array("IBLOCK_ID"=>$arParams["CANNONICAL"], "PROPERTY_NEWS" => $arResult["ID"] ,"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNext())
{
    $APPLICATION->SetPageProperty('CANNONICAL', $ob["NAME"]);
}