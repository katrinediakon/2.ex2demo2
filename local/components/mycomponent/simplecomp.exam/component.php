<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM"));
    return;
}
if ($arParams['PROPERTY_CODE'] && $arParams['ID_NEWS'] && $arParams['ID_CATALOG']):
    if ($this->StartResultCache()) {
        $arResult = array();

        $arSelect = Array("ID", "NAME", "ACTIVE_FROM");
        $arFilter = Array("IBLOCK_ID" => $arParams['ID_NEWS'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {

            $arResult['NEWS'][$ob['ID']]["NAME"] = $ob['NAME'];
            $arResult['NEWS'][$ob['ID']]["DATE"] = $ob['ACTIVE_FROM'];
        }

        $arCatalog = array();
        $arFilter = Array('IBLOCK_ID' => $arParams['ID_CATALOG'], 'GLOBAL_ACTIVE' => 'Y');
        $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter, false, array("NAME", "ID", $arParams['PROPERTY_CODE']));
        while ($ar_result = $rsSections->GetNext()) {
            foreach ($ar_result[$arParams['PROPERTY_CODE']] as $news):
                $arResult['NEWS'][$news]["CATALOG"][$ar_result["ID"]] = $ar_result["NAME"];
            endforeach;
        }
        $arResult['COUNT'] = 0;
        $arSelect = Array("NAME", "DATE_ACTIVE_FROM", 'IBLOCK_SECTION_ID', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER');
        $arFilter = Array("IBLOCK_ID" => $arParams['ID_CATALOG'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            foreach ($arResult['NEWS'] as $key => $item):
                if (isset($item['CATALOG'][$ob['IBLOCK_SECTION_ID']])):
                    $arResult['NEWS'][$key]['CATALOG']['ITEM'][] = $ob;
                    $arResult['COUNT']++;
                    if (!$arResult["MAX"] && !$arResult["MIN"]) {
                        $arResult["MAX"] = $ob["PROPERTY_PRICE_VALUE"];
                        $arResult["MIN"] = $ob["PROPERTY_PRICE_VALUE"];
                    }
                    if ($arResult["MAX"] < $ob["PROPERTY_PRICE_VALUE"])
                        $arResult["MAX"] = $ob["PROPERTY_PRICE_VALUE"];
                    if ($arResult["MIN"] > $ob["PROPERTY_PRICE_VALUE"])
                        $arResult["MIN"] = $ob["PROPERTY_PRICE_VALUE"];
                endif;
            endforeach;
        }
    }
    $this->SetResultCacheKeys(array("MAX", "MIN", "COUNT"));
    $this->includeComponentTemplate();
endif;


?>