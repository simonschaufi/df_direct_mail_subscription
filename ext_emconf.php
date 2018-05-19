<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'Personalized Direct Mail Subscription',
	'description' => 'Adds a plugin for personalized subscription to direct mail newsletters (collecting subscriptions in the tt_address table and compatible to fe_users with sr_feuser_register) New type character ###USER_tx_gender###',
	'category' => 'plugin',
	'version' => '1.1.0',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => false,
	'author' => 'Simon Schaufelberger, Detlef Fluess',
	'author_email' => 'simonschaufi+typo3@gmail.com, fluess@2-ad.de',
	'author_company' => '2ad - neue medien',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-8.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
