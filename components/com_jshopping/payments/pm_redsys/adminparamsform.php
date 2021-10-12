<?php
/*
 *      TPVV Redsýs for JoomShopping 3-4
 *      @package TPVV Redsýs for JoomShopping 3-4
 *      @subpackage Content
 *      @author José António Cidre Bardelás
 *      @copyright Copyright (C) 2012-2015 José António Cidre Bardelás and Joomla Empresa. All rights reserved
 *      @license GNU/GPL v3 or later
 *      
 *      Contact us at info@joomlaempresa.com (http://www.joomlaempresa.es)
 *      
 *      This file is part of TPVV Redsýs for JoomShopping 3-4.
 *      
 *          TPVV Redsýs for JoomShopping 3-4 is free software: you can redistribute it and/or modify
 *          it under the terms of the GNU General Public License as published by
 *          the Free Software Foundation, either version 3 of the License, or
 *          (at your option) any later version.
 *      
 *          TPVV Redsýs for JoomShopping 3-4 is distributed in the hope that it will be useful,
 *          but WITHOUT ANY WARRANTY; without even the implied warranty of
 *          MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *          GNU General Public License for more details.
 *      
 *          You should have received a copy of the GNU General Public License
 *          along with TPVV Redsýs for JoomShopping 3-4.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Acesso a '.basename(__FILE__).' restrito.');

require_once(JFile::exists(JPATH_ROOT.'/administrator/components/com_jshopping/lang/'.$jooLang.'-redsys.php') ? JPATH_ROOT.'/administrator/components/com_jshopping/lang/'.$jooLang.'-redsys.php' : JPATH_ROOT.'/administrator/components/com_jshopping/lang/en-GB-redsys.php');

function getKeyJEHTML($fieldName, $name, $id, $value, $class, $size, $tooltip) {
	$component = JComponentHelper::getComponent('com_jetpvvcommon', true);
	if(!JFile::exists(JPATH_ADMINISTRATOR.'/components/com_jetpvvcommon/version.php')) {
		$size = ( isset($size) ? 'size="'.$size.'"' : '' );
		return '<span class="label label-important">'.JHTML::tooltip($tooltip)._JSHOP_REDSYS_CRYPT_WARNING.'</span>';
	}
	elseif(!$component->enabled) {
		$size = ( isset($size) ? 'size="'.$size.'"' : '' );
		return '<span class="label label-important">'.JHTML::tooltip($tooltip)._JSHOP_REDSYS_CRYPT_WARNING.'</span>';
	}
	else {
		require_once JPATH_ADMINISTRATOR . '/components/com_jetpvvcommon/version.php';
		if(version_compare(JETPVVCOMMON_VERSION, '3.0.0', 'lt')) {
			$size = ( isset($size) ? 'size="'.$size.'"' : '' );
			return '<span class="label label-important">' . _JSHOP_REDSYS_CRYPT_WARNING . '</span>';
	}
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		// Setup variables for display.
		$html = array();
		$jeTPVVToken = version_compare(JVERSION, '3.0.0','ge') ? JSession::getFormToken() : JUtility::getToken();
		$link = 'index.php?option=com_jetpvvcommon&amp;layout=modal&amp;tmpl=component&amp;key=jshoppingpayment_'.$fieldName.'_key&amp;cid=' . JFactory::getApplication()->input->getInt('payment_id') . '&amp;'.$jeTPVVToken.'=1';

		// The user select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '	<a class="modal btn btn-primary" title="'._JSHOP_REDSYS_CHANGE_KEY_DET.'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 800, y: 450}}">'._JSHOP_REDSYS_CHANGE_KEY.'</a> '.JHTML::tooltip($tooltip);
		$html[] = '  </div>';
		$html[] = '</div>';
		
		return implode("\n", $html);
	}
}
?>
<div class="col100">
<fieldset class="adminform">
<table class="admintable" style="background-color: #FFFFFF; border: 1px solid #CCCCCC;" width = "100%" >
	<tr style="background-color: #FFFFFF;">
		<td colspan="2">
			<?php echo _JSHOP_REDSYS_DESCRIPTION; ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td style="width: 350px;" class="key">
			<?php echo _JSHOP_REDSYS_POS_MODE; ?>
		</td>
		<td>
		<?php
			$options = array();
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_SIMULATION, 'sim');
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_PRODUCTION, 'prod');
			echo JHTML::_('select.genericlist', $options, 'pm_params[pos_mode]', 'class = "inputbox" size = "1"', 'text', 'value', ($params['pos_mode'] != '' ? $params['pos_mode'] : 'sim'))." ".JHTML::tooltip(_JSHOP_REDSYS_POS_MODE_DET);
		?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_POS_URL_SIM; ?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[pos_url_sim]" size="50" value = "<?php echo ($params['pos_url_sim'] != '' ? $params['pos_url_sim'] : 'https://sis-t.redsys.es:25443/sis/realizarPago'); ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_POS_URL_SIM_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_POS_URL_PROD; ?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[pos_url_prod]" size="50" value = "<?php echo ($params['pos_url_prod'] != '' ? $params['pos_url_prod'] : 'https://sis.redsys.es/sis/realizarPago'); ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_POS_URL_PROD_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td style="width: 350px;" class="key">
			<?php echo _JSHOP_REDSYS_POS_PAYMENT_TYPE; ?>
		</td>
		<td>
		<?php
			$options = array();
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_ALL, 'A');
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_CARD, 'C');
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_IUPAY, 'O');
			$options[] = JHTML::_('select.option', _JSHOP_REDSYS_CARD_IUPAY, 'T');
			echo JHTML::_('select.genericlist', $options, 'pm_params[pos_payment_type]', 'class = "inputbox" size = "1"', 'text', 'value', ($params['pos_payment_type'] != '' ? $params['pos_payment_type'] : 'A'))." ".JHTML::tooltip(_JSHOP_REDSYS_POS_PAYMENT_TYPE_DET);
		?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_STORE_NAME; ?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[store_name]" size="20" value = "<?php echo @$params['store_name']; ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_STORE_NAME_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_SALE_DESCRIPTION; ?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[sale_description]" size="45" value = "<?php echo @$params['sale_description']; ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_SALE_DESCRIPTION_DET);?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_COMMERCE_NUMBER;?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[commerce_number]" size="20" value = "<?php echo @$params['commerce_number']; ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_COMMERCE_NUMBER_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #FFFFFF;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_POS_KEY; ?>
		</td>
		<td>
			<?php
			echo getKeyJEHTML('redsys', 'pm_params[pos_key]', 'pm_params[pos_key]', @$params['pos_key'], 'inputbox', '20', _JSHOP_REDSYS_POS_KEY_DET);
			?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_TERMINAL_NUMBER;?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[terminal_number]" size="5" value = "<?php echo @$params['terminal_number']; ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_TERMINAL_NUMBER_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_CURRENCY_IDENTIFIER;?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[currency_identifier]" size="5" value = "<?php echo ($params['currency_identifier'] != '' ? $params['currency_identifier'] : '978'); ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_CURRENCY_IDENTIFIER_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td  class="key">
			<?php echo _JSHOP_REDSYS_TRANSACTION_TYPE;?>
		</td>
		<td>
			<input type = "text" class = "inputbox" name = "pm_params[transaction_type]" size="5" value = "<?php echo ($params['transaction_type'] != '' ? $params['transaction_type'] : '0'); ?>" />
			<?php echo JHTML::tooltip(_JSHOP_REDSYS_TRANSACTION_TYPE_DET); ?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td class="key">
			<?php echo _JSHOP_REDSYS_POS_LANG; ?>
		</td>
		<td>
		<?php
			$langArray = array(
				'0' => _JSHOP_REDSYS_LANG_UNDEFINED,
				'AUTO' => _JSHOP_REDSYS_LANG_AUTOMATIC,
				'001' => _JSHOP_REDSYS_LANG_SPANISH,
				'002' => _JSHOP_REDSYS_LANG_ENGLISH,
				'003' => _JSHOP_REDSYS_LANG_CATALAN,
				'004' => _JSHOP_REDSYS_LANG_FRENCH,
				'005' => _JSHOP_REDSYS_LANG_GERMAN,
				'006' => _JSHOP_REDSYS_LANG_DUTCH,
				'007' => _JSHOP_REDSYS_LANG_ITALIAN,
				'008' => _JSHOP_REDSYS_LANG_SWEDISH,
				'009' => _JSHOP_REDSYS_LANG_PORTUGUESE,
				'010' => _JSHOP_REDSYS_LANG_VALENCIAN,
				'011' => _JSHOP_REDSYS_LANG_POLISH,
				'012' => _JSHOP_REDSYS_LANG_GALIZAN,
				'013' => _JSHOP_REDSYS_LANG_BASQUE
			);
			$options = array();
			foreach($langArray as $key => $value) {
				$options[] = JHTML::_('select.option', $value, $key);
			}
			echo JHTML::_('select.genericlist', $options, 'pm_params[pos_lang]', 'class = "inputbox" size = "1"', 'text', 'value', ($params['pos_lang'] != '' ? $params['pos_lang'] : '0'))." ".JHTML::tooltip(_JSHOP_REDSYS_POS_LANG_DET);
		?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td class="key">
			<?php echo _JSHOP_REDSYS_TRANSACTION_END; ?>
		</td>
		<td>
			<?php              
			echo JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_end_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', ($params['transaction_end_status'] != '' ? $params['transaction_end_status'] : '6'))." ".JHTML::tooltip(_JSHOP_REDSYS_TRANSACTION_END_DET);
			?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td class="key">
			<?php echo _JSHOP_REDSYS_TRANSACTION_PENDING;?>
		</td>
		<td>
			<?php 
			echo JHTML::_('select.genericlist',$orders->getAllOrderStatus(), 'pm_params[transaction_pending_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', ($params['transaction_pending_status'] != '' ? $params['transaction_pending_status'] : '1'))." ".JHTML::tooltip(_JSHOP_REDSYS_TRANSACTION_PENDING_DET);
			?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td class="key">
			<?php echo _JSHOP_REDSYS_TRANSACTION_FAILED;?>
		</td>
		<td>
			<?php 
			echo JHTML::_('select.genericlist',$orders->getAllOrderStatus(), 'pm_params[transaction_failed_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', ($params['transaction_failed_status'] != '' ? $params['transaction_failed_status'] : '3'))." ".JHTML::tooltip(_JSHOP_REDSYS_TRANSACTION_FAILED_DET);
			?>
		</td>
	</tr>
	<tr style="background-color: #CCCCCC;">
		<td class="key">
			<?php echo _JSHOP_REDSYS_DEBUG;?>
		</td>
		<td>
			<?php 
			echo JHTML::_('select.booleanlist', 'pm_params[debug]', 'class = "inputbox"', ($params['debug'] != '' ? $params['debug'] : '0'))." ".JHTML::tooltip(_JSHOP_REDSYS_DEBUG_DET);
			?>
		</td>
	</tr>
</table>
</fieldset>
</div>
<div class="clr"></div>
