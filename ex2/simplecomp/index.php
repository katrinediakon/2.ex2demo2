<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CODE_AUTHOR" => "AUTHOR",
		"CODE_USER" => "UF_AUTHOR_TYPE",
		"ID_CATALOG" => "",
		"ID_NEWS" => "1",
		"PROPERTY_CODE" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>