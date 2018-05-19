<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/direct_mail']['res/scripts/class.dmailer.php']['mailMarkersHook'][] = t3lib_extMgm::extPath('df_direct_mail_subscription') . 'Classes/Hook/MailMarkersHook.php:Tx_DfDirectMailSubscription_Hook_MailMarkersHook->replaceMailMarkers';
