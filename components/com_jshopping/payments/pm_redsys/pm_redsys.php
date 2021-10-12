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

class pm_redsys extends PaymentRoot {

	function showPaymentForm($params, $pmconfigs) {
		include(dirname(__FILE__)."/paymentform.php");
	}

	//function call in admin
	function showAdminFormParams($params) {
		$arrayParams = array('pos_mode', 'pos_url_sim', 'pos_url_prod', 'pos_payment_type', 'store_name', 'sale_description', 'commerce_number', 'pos_key', 'terminal_number', 'currency_identifier', 'transaction_type', 'pos_lang', 'transaction_end_status', 'transaction_pending_status', 'transaction_failed_status', 'automatic_redirection', 'debug');
		foreach ($arrayParams as $key){
			if (!isset($params[$key])) $params[$key] = '';
		}
		$language = '';
		$local = JFactory::getLanguage();
		$localFull = $local->getLocale();
		$localShort = explode('.', $localFull[0]);
		$jooLang = str_replace('_', '-', $localShort[0]);
		$orders = version_compare(JVERSION, '3.0.0','ge') ? JModelLegacy::getInstance('orders', 'JshoppingModel') : JModel::getInstance('orders', 'JshoppingModel'); //admin model
		include(dirname(__FILE__)."/adminparamsform.php");
	}

	function checkTransaction($pmConfig, $order, $act) {
		$data = JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jshopping'.DS.'jshopping.xml') ? JInstaller::parseXMLInstallFile(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jshopping'.DS.'jshopping.xml') : null;
		$jsVersion = $data ? $data['version'] : (version_compare(JVERSION, '3.0.0','ge') ? '4.7.0' : '3.19.0');
		$newVersion = (version_compare(JVERSION, '3.0.0','ge') && version_compare($jsVersion, '4.7.0', 'ge')) ||  (version_compare(JVERSION, '3.0.0','lt') && version_compare($jsVersion, '3.19.0', 'ge')) ? true : false;
		$debug = $pmConfig['debug'];
		$jInput = JFactory::getApplication()->input;

		$postData = $jInput->getArray($_POST);

		$redsysOrderParamsB64 = $postData['Ds_MerchantParameters'];
		$redsysOrderParamsJSon = base64_decode(strtr($redsysOrderParamsB64, '-_', '+/'));
		$redsysOrderParamsArray = json_decode($redsysOrderParamsJSon, true);

		require_once JPATH_ADMINISTRATOR . '/components/com_jetpvvcommon/helpers/jetpvvcommon.php';
		require_once JPATH_ADMINISTRATOR . '/components/com_jetpvvcommon/helpers/redsys.php';
		$signatureVersionLocal = "HMAC_SHA256_V1";
		$signature = JETPVvCommonHelperRedsys::createNotifySignature('jshoppingpayment_redsys_key', $order->payment_method_id, $redsysOrderParamsB64);

		if((string)(number_format($order->order_total, 2, '.', '')*100) != (string)$redsysOrderParamsArray['Ds_Amount']) {
			if($debug) $this->logInfo('Error', 'Amount in BD and received don\'t match. Order ID '.$order->order_id);
			return $newVersion ? array(0, 'Error: Amount in BD and received don\'t match. Order ID '.$order->order_id, $redsysOrderParamsArray['Ds_AuthorisationCode'], $postData) : array(0, 'Error: Amount in BD and received don\'t match. Order ID '.$order->order_id);
		}

		if($signature != $postData['Ds_Signature']) {
			if($debug) $this->logInfo('Error', 'The verification signatures don\'t match. Order ID '.$order->order_id);
			return $newVersion ? array(0, 'Error: The verification signatures don\'t match. Order ID '.$order->order_id, $redsysOrderParamsArray['Ds_AuthorisationCode'], $postData) : array(0, 'Error: The verification signatures don\'t match. Order ID '.$order->order_id);
		}
		if(($redsysOrderParamsArray['Ds_Response'] >= 0) && ($redsysOrderParamsArray['Ds_Response'] <= 99) && array_key_exists('Ds_AuthorisationCode', $redsysOrderParamsArray)) {
			if($debug) $this->logInfo('Message', 'Payment done with success. Order ID '.$order->order_id);
			return $newVersion ? array(1, 'Payment done with success. Order ID '.$order->order_id, $redsysOrderParamsArray['Ds_AuthorisationCode'], $postData) : array(1, '');
		}
		else {
			if($debug) $this->logInfo('Message', 'Payment failed. Order ID '.$order->order_id);
			return $newVersion ? array(3, 'Payment failed. Order ID '.$order->order_id, $redsysOrderParamsArray['Ds_AuthorisationCode'], $postData) : array(3, 'Payment failed. Order ID '.$order->order_id);
		}
	}

	function showEndForm($pmConfig, $order) {
		$jshopConfig = JSFactory::getConfig();
		$orderNumber = $order->order_number;
		$itemName = JText::sprintf(_JSHOP_PAYMENT_NUMBER, $order->order_number);

		$length = strlen($orderNumber);
		if($length < 11) {
			for($i = $length; $i < 12; $i++) {
				$orderNumber = "0".$orderNumber;
			}
		}
		elseif($length > 12) {
			$orderNumber = substr($orderNumber, -12);
		}

		$language = 0;
		$local = JFactory::getLanguage();
		$localFull = $local->getLocale();
		$localShort = explode('.', $localFull[0]);
		$jooLang = $localShort[0];
		
		if(trim($pmConfig['pos_lang']) == 'AUTO') {
			switch(substr($jooLang, 0, 3)) {
				case 'es_':
					$language = '001';
					break;
				case 'en_':
					$language = '002';
					break;
				case 'ca_':
					$language = '003';
					break;
				case 'fr_':
					$language = '004';
					break;
				case 'de_':
					$language = '005';
					break;
				case 'nl_':
					$language = '006';
					break;
				case 'it_':
					$language = '007';
					break;
				case 'sv_':
					$language = '008';
					break;
				case 'pt_':
					$language = '009';
					break;
				case 'pl_':
					$language = '011';
					break;
				case 'gl_':
					$language = '012';
					break;
				case 'eu_':
					$language = '013';
					break;
				default :
					$language = '0';
			}
		}
		else 
			$language = trim($pmConfig['pos_lang']);

		$amount = number_format($order->order_total, 2, '.', '')*100;
		$merchantCode = trim($pmConfig['commerce_number']);
		$merchantCurrency = trim($pmConfig['currency_identifier']);
		$transactionType = (int)trim($pmConfig['transaction_type']);
		$languages = JLanguageHelper::getLanguages('lang_code');
		$notificationURL = JURI::root().'index.php?option=com_jshopping&controller=checkout&task=step7&act=notify&js_paymentclass=pm_redsys&no_lang=1&on='.$order->order_id.(JLanguageMultilang::isEnabled() ? '&lang=' . $languages[$local->getTag()]->sef : '').'&tmpl=component';

		$jInput = JFactory::getApplication()->input;
		$Itemid = $jInput->get('Itemid', 0, 'INT') ? '&Itemid='.$jInput->get('Itemid', 0, 'INT') : '';

		$simURL = $pmConfig['pos_url_sim'] != '' ? $pmConfig['pos_url_sim'] : 'https://sis-t.redsys.es:25443/sis/realizarPago';
		$prodURL = $pmConfig['pos_url_prod'] != '' ? $pmConfig['pos_url_prod'] : 'https://sis.redsys.es/sis/realizarPago';
		$posURL = $pmConfig['pos_mode'] == 'prod' ? $prodURL : $simURL;
		$okURL = JURI::root().'index.php?option=com_jshopping&controller=checkout&task=step7&act=return&js_paymentclass=pm_redsys';
		$koURL = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=cancel&js_paymentclass=pm_redsys";

		$redsysOrderParams = Array(
			'Ds_Merchant_Amount' => $amount,
			'Ds_Merchant_Currency' => trim($pmConfig['currency_identifier']),
			'Ds_Merchant_Order' => $orderNumber,
			'Ds_Merchant_ProductDescription' => $pmConfig['sale_description'].' ('.$order->order_number.')',
			'Ds_Merchant_Titular' => $order->d_f_name.' '.$order->d_l_name,
			'Ds_Merchant_MerchantCode' => $pmConfig['commerce_number'],
			'Ds_Merchant_MerchantURL' => $notificationURL,
			'Ds_Merchant_UrlOK' => $okURL,
			'Ds_Merchant_UrlKO' => $koURL,
			'Ds_Merchant_MerchantName' => $pmConfig['store_name'],
			'Ds_Merchant_ConsumerLanguage' => $language,
			'Ds_Merchant_Terminal' => $pmConfig['terminal_number'],
			'Ds_Merchant_TransactionType' => $pmConfig['transaction_type'],
			'Ds_Merchant_PayMethods' => (trim($pmConfig['pos_payment_type']) == 'A' ? ' ' : trim($pmConfig['pos_payment_type']))
		);

		require_once JPATH_ADMINISTRATOR . '/components/com_jetpvvcommon/helpers/jetpvvcommon.php';
		require_once JPATH_ADMINISTRATOR . '/components/com_jetpvvcommon/helpers/redsys.php';
		$signatureVersion = "HMAC_SHA256_V1";
		$signature = JETPVvCommonHelperRedsys::createSendSignature("jshoppingpayment_redsys_key", $order->payment_method_id, $redsysOrderParams);

		$post_variables = array(
			'Ds_SignatureVersion' => $signatureVersion,
			'Ds_MerchantParameters' => base64_encode(json_encode($redsysOrderParams)),
			'Ds_Signature' => $signature,
		);
		?>

		<html>
			<head>
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />            
			</head>
			<body>
				<form id="paymentform" action="<?php echo $posURL; ?>" name = "paymentform" method = "post">
				<?php
					foreach($post_variables as $name => $value) {
						echo '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars($value).'" />';
					}
				?>
				</form>
				<?php echo _JSHOP_REDIRECT_TO_PAYMENT_PAGE ?>
				<br>
				<script type="text/javascript">document.getElementById('paymentform').submit();</script>
			</body>
		</html>
		<?php die();
	}

	function getUrlParams($pmConfig) {
		$params = array();
		$jInput = JFactory::getApplication()->input;
		$orderNumber = $jInput->get('on', 0, 'INT');
		$params['order_id'] = $orderNumber;
		$params['hash'] = "";
		$params['checkHash'] = 0;
		$params['checkReturnParams'] = $pmConfig['checkdatareturn'];
		return $params;
	}

	private function logInfo ($type, $message) {
			$file = JPATH_ROOT."/logs/jshopping_redsys.log";
			$date = JFactory::getDate ();

			$fp = fopen ($file, 'a');
			fwrite ($fp, "\n\n".version_compare(JVERSION, '3.0.0','ge') ? $date->format('%Y-%m-%d %H:%M:%S') : $date->toFormat('%Y-%m-%d %H:%M:%S'));
			fwrite ($fp, "\n".$type.': '.$message);
			fclose ($fp);
	}
}
