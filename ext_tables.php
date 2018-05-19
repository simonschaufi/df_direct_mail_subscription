<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_extMgm::addPlugin(array("LLL:EXT:df_direct_mail_subscription/locallang.xml:pi_dmail_subscr", "21"));

$tempColumns = array (
	"tx_dfdirectmailsubscription_gender" => array (
		"exclude" => 1,
		"label" => "LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender",
		"config" => array (
			"type" => "select",
			"items" => array (
				array("LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender.I.0", "0"),
				array("LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender.I.1", "1"),
				array("LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender.I.2", "2"),
				array("LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender.I.3", "3"),
				array("LLL:EXT:df_direct_mail_subscription/locallang_db.xml:tt_address.tx_dfdirectmailsubscription_gender.I.4", "4"),
			),
			"size" => 1,
			"maxitems" => 1,
		)
	),

);

t3lib_div::loadTCA("tt_address");
t3lib_extMgm::addTCAcolumns("tt_address",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tt_address","tx_dfdirectmailsubscription_gender;;;;1-1-1");

?>