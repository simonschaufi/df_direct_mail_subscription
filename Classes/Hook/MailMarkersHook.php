<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Simon Schaufelberger <simonschaufi@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class Tx_DfDirectMailSubscription_Hook_MailMarkersHook {

	/**
	 * @param array $params
	 * @param dmailer $pObj
	 */
	public function replaceMailMarkers($params, dmailer $pObj) {
		/** @var $LANG language */
		global $LANG;

		$LANG->includeLLFile('EXT:df_direct_mail_subscription/pi1/locallang.xml');

		$tempMarkers = &$params['markers'];
		if ($params['row']['tx_dfdirectmailsubscription_gender'] == '3') {
			$tempMarkers['###USER_tx_gender###'] = $LANG->getLL('dmail_gender_mfale');
			$tempMarkers['###USER_TX_GENDER###'] = strtoupper($LANG->getLL('dmail_gender_mfale'));
		}
		elseif ($params['row']['tx_dfdirectmailsubscription_gender'] == "1" || $params['row']['gender'] == '0') {
			$tempMarkers['###USER_tx_gender###'] = $LANG->getLL('dmail_gender_male');
			$tempMarkers['###USER_TX_GENDER###'] = strtoupper($LANG->getLL('dmail_gender_male'));
		}
		elseif ($params['row']['tx_dfdirectmailsubscription_gender'] == "2" || $params['row']['gender'] == '1') {
			$tempMarkers['###USER_tx_gender###'] = $LANG->getLL('dmail_gender_fmale');
			$tempMarkers['###USER_TX_GENDER###'] = strtoupper($LANG->getLL('dmail_gender_fmale'));
		}
		elseif ($params['row']['tx_dfdirectmailsubscription_gender'] == '0') {
			$tempMarkers['###USER_tx_gender###'] = $LANG->getLL('dmail_gender_all');
			$tempMarkers['###USER_TX_GENDER###'] = strtoupper($LANG->getLL('dmail_gender_all'));

			$tempMarkers['###USER_name###'] = '';
			$tempMarkers['###USER_NAME###'] = '';
		}
	}
}
?>