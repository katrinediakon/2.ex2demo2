<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"CODE_AUTHOR" => array(
			"NAME" => GetMessage("CODE_AUTHOR"),
			"TYPE" => "STRING",
		),
        "ID_NEWS" => array(
            "NAME" => GetMessage("ID_NEWS"),
            "TYPE" => "STRING",
        ),
        "CODE_USER" => array(
            "NAME" => GetMessage("CODE_USER"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);