<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"ID_CATALOG" => array(
			"NAME" => GetMessage("ID_CATALOG"),
			"TYPE" => "STRING",
		),
        "ID_NEWS" => array(
            "NAME" => GetMessage("ID_NEWS"),
            "TYPE" => "STRING",
        ),
        "PROPERTY_CODE" => array(
            "NAME" => GetMessage("PROPERTY_CODE"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);