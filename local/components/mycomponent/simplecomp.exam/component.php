<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM"));
    return;
}

$this->AddIncludeAreaIcon(
    array(

        'URL' => '/bitrix/admin/iblock_element_admin.php?IBLOCK_ID=1&type=news&lang=ru&apply_filter=Y&back_url_pub=%2F',
        'TITLE' => "ИБ в админке",
        "IN_PARAMS_MENU" => true, //показать в контекстном меню
    )
);

if ($arParams['CODE_AUTHOR'] && $arParams['ID_NEWS'] && $arParams['CODE_USER']):
    if ($USER->GetID()) {
        if ($this->StartResultCache(false, $USER->GetID())) {
            $arResult = array();
            // user
            global $USER;
            $group_user = "";
            $filter = Array("ID" => $USER->GetID());
            $rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter, array("SELECT" => array($arParams['CODE_USER'])));
            while ($arUser = $rsUsers->GetNext()) {
                if ($arUser[$arParams['CODE_USER']])
                    $group_user = $arUser[$arParams['CODE_USER']];
            }
            $user = array();
            $filter = Array($arParams['CODE_USER'] => $group_user);
            $rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
            while ($arUser = $rsUsers->GetNext()) {
                if ($arUser["ID"] != $USER->GetID()) {
                    $arResult["ITEM"][$arUser["ID"]]["ID"] = $arUser["ID"];
                    $arResult["ITEM"][$arUser["ID"]]["NAME"] = $arUser["LOGIN"];
                }
                $user[] = $arUser["ID"];
            }
            $new = array();
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_AUTHOR");
            $arFilter = Array("IBLOCK_ID" => $arParams['ID_NEWS'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_AUTHOR" => $user);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
            while ($ob = $res->GetNext()) {

                $new[$ob["ID"]]["NAME"] = $ob["NAME"];
                $new[$ob["ID"]]["ID"] = $ob["ID"];
                $new[$ob["ID"]]["PROPERTY_NEWS"][] = $ob["PROPERTY_AUTHOR_VALUE"];

            }

            foreach ($new as $key => $value) {
                if (!in_array($USER->GetID(), $value["PROPERTY_NEWS"])) {
                    foreach ($value["PROPERTY_NEWS"] as $key => $news) {
                        $arResult["ITEM"][$news]["NEWS"][] = $value["NAME"];
                        $arResult["COUNT"]++;
                    }
                }
            }
            $this->SetResultCacheKeys("COUNT");
            $APPLICATION->SetTitle("Новостей " . $count);
            $this->includeComponentTemplate();
        }
        $APPLICATION->SetTitle("Новостей " . $arResult["COUNT"]);
    }
endif;


?>