<?php
/*
 *      TPVV Redsýs for JoomShopping 3-4
 *      @package TPVV Redsýs for JoomShopping 3-4
 *      @subpackage Content
 *      @author José António Cidre Bardelás
 *      @copyright Copyright (C) 2012-2013 José António Cidre Bardelás and Joomla Empresa. All rights reserved
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

$code = "redsys";
$class = "pm_redsys";
$name = "Redsys payment method";
$element = "addon_redsys";
$version = "1.6.1";
$params = 'pos_mode=sim
pos_url_sim=https://sis-t.redsys.es:25443/sis/realizarPago
pos_url_prod=https://sis.redsys.es/sis/realizarPago
store_name=
sale_description=
commerce_number=
signature_type=extended
terminal_number=
currency_identifier=978
transaction_type=0
pos_lang=Undefined
transaction_end_status=6
transaction_pending_status=1
transaction_failed_status=3
debug=0';

$addon = &JTable::getInstance('addon', 'jshop');
$addon->loadAlias($element);

$paymentData = array(
		'payment_code' => $code,
		'payment_class' => $class,
		'payment_publish' => 1,
		// 'payment_params' => $params,
		'payment_type' => 2,
		'price' => 0,
		'price_type' => 0,
		'tax_id' => 1,
		'image' => '',
		'show_descr_in_email' => 0
		);

$allLanguages = getAllLanguages();
foreach($allLanguages as $_lang){
	if($_lang->language == 'gl-ES') {
		$paymentData['name_'.$_lang->language] = 'Cartón de crédito (Redsys)';
		$paymentData['description_'.$_lang->language] = 'Pague en seguranza co seu cartón de crédito a través da rede Redsys.';
	}
	elseif($_lang->language == 'es-ES') {
		$paymentData['name_'.$_lang->language] = 'Tarjeta de crédito (Redsys)';
		$paymentData['description_'.$_lang->language] = 'Pague con total seguridad con su tarjeta de crédito a través de la red Redsys.';
	}
	else {
		$paymentData['name_'.$_lang->language] = 'Credit card (Redsys)';
		$paymentData['description_'.$_lang->language] = 'Pay securely with your credit card via the Redsys network.';
	}
}

$addon->installPayment($paymentData, 1);

$addon->set("name", $name);
$addon->set("version", $version);
$addon->set("uninstall","/components/com_jshopping/payments/pm_redsys/uninstall.php");
$addon->store();
