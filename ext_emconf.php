<?php

########################################################################
# Extension Manager/Repository config file for ext "df_direct_mail_subscription".
#
# Auto generated 18-08-2015 13:44
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Personalized Direct Mail Subscription',
	'description' => 'Adds a plugin for personalized subscription to direct mail newsletters (collecting subscriptions in the tt_address table and compatible to fe_users with sr_feuser_register) New type character ###USER_tx_gender###',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.1.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'TYPO3_version' => '',
	'PHP_version' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => 'tt_address',
	'clearcacheonload' => 0,
	'lockType' => 'L',
	'author' => 'Simon Schaufelberger, Detlef Fluess',
	'author_email' => 'simonschaufi@googlemail.com, fluess@2-ad.de',
	'author_company' => '2ad - neue medien',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
);

?>