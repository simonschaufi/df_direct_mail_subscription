<?php
/* execute some database operation if certain parameters have been set */
// if tt_address record has been deleted, delete also from relation table related direct_mail category information
if (t3lib_div::_GP('cmd') == 'delete' || (t3lib_div::_GP('cmd') == 'setfixed' && t3lib_div::_GP('sFK') == 'DELETE')) {
	$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_dmail_ttaddress_category_mm', 'uid_local='.intval(t3lib_div::_GP('rU')));
}

// if subscription has been confirmed mark the record as not hidden
if (t3lib_div::_GP('cmd') == 'setfixed' && t3lib_div::_GP('sFK') == 'approve') {
	$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address', 'uid='.intval(t3lib_div::_GP('rU')), array('hidden' => 0));
}

class user_dmailsubscribe {

	/**
	 * @var tslib_cObj
	 */
	var $cObj;

	public function __construct() {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
	}
	
	/**
	 * Create direct_mail categories related checkboxes
	 * @param	string	$content: HTML
	 * @param	array	$conf: array, which has information about the current record
	 * @return 	string	HTML
	 */
	public function makeCheckboxes($content,$conf) {
		$content = '';
		$pid = $this->cObj->stdWrap($conf['pid'], $conf['pid.']);

		if ($address_uid = t3lib_div::_GP('rU')) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*','sys_dmail_ttaddress_category_mm','uid_local='.intval($address_uid));
			$subscribed_to = array();
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				$subscribed_to[] = $row['uid_foreign'];
			}
			$subscribed_to_list = implode(',', $subscribed_to);
		}

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*','sys_dmail_category','l18n_parent=0 AND pid='.intval($pid).$this->cObj->enableFields('sys_dmail_category') .' ORDER BY sorting ASC');

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$checked = t3lib_div::inList($subscribed_to_list, $row['uid']);
			//$content .= $row['category'].'<input type="checkbox" '.($checked?'checked':'').' name="FE[tt_address][module_sys_dmail_category][]" value="'.$row['uid'].'" /><br />';

			//Stanislas way of doing localization is different, always subscribed to the original uid, and not the translated overlay records.
			if ($theRow = $GLOBALS['TSFE']->sys_page->getRecordOverlay('sys_dmail_category',$row,$GLOBALS['TSFE']->sys_language_uid,$conf['hideNonTranslatedCategories']?'hideNonTranslated':'')) {
				$content .= '<input type="checkbox" '.($checked?'checked':'').' name="FE[tt_address][module_sys_dmail_category]['.$row['uid'].']" value="1" class="module_sys_dmail_category" /> '.$theRow['category'].'<br />';
			}
		}
		return $content;
	}

	/**
	 * function, which has been used creating and editing records
	 * @param	array	$conf: array, which has information about the current record
	 * @return 	void
	 */
	public function saveRecord($conf) {
		if (intval($conf['rec']['uid'])) {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_dmail_ttaddress_category_mm','uid_local='.intval($conf['rec']['uid']));
			$fe = t3lib_div::_GP('FE');
			$newFieldsArr = $fe['tt_address']['module_sys_dmail_category'];

			$count = 0;
			if (is_array($newFieldsArr)) {
				foreach(array_keys($newFieldsArr) as $uid) {
					$count++;
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_dmail_ttaddress_category_mm',array('uid_local'=>$conf['rec']['uid'],'uid_foreign'=>$uid,'sorting'=>$count));
				}
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address','uid='.intval($conf['rec']['uid']),array('module_sys_dmail_category'=>$count));
			}
			if (empty($conf['rec']['name'])) {
				if (!empty($conf['rec']['first_name'])) {
					$name = $conf['rec']['first_name'];
					if (!empty($conf['rec']['last_name'])) {
						$name .= ' '.$conf['rec']['last_name'];
					}
				}
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address','uid='.intval($conf['rec']['uid']),array('name'=>$name));
			}
			if (t3lib_div::_GP('cmd') != 'edit') { // not do that when editing records
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address','uid='.intval($conf['rec']['uid']),array('hidden'=>1));
			}
		}
	}
}
if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/df_direct_mail_subscription/pi1/class.dmailsubscribe.php"]) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/df_direct_mail_subscription/pi1/class.dmailsubscribe.php"]);
}
?>