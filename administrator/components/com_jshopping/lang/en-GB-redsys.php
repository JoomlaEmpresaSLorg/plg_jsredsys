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

define('_JSHOP_REDSYS_DESCRIPTION','Redsys payment method for JoomShopping 3-4. This add-on allows you to add the Redsys POS (CaixaBank, Bankia, Banc Sabadell, etc.) to your JoomShopping 3-4 payment methods. Check the latest version and the official documentation in <strong><a href="http://www.joomlaempresa.es/en" target="_blank">http://www.joomlaempresa.es</a></strong>.<br /><br /><strong style=\'color:red;\'>Notes about your Redsys POS:</strong><ul style=\'margin: 0;  list-style: none;\'><li>The <strong>POS simulation URL and/or POS production URL</strong>, <strong>Commerce number (FUC)</strong>, <strong>Currency identifier</strong> and <strong>Terminal number</strong> options are mandatory and the payment method will not work if you don\'t define them</li></ul>');
define('_JSHOP_REDSYS_POS_MODE','Pos mode');
define('_JSHOP_REDSYS_POS_MODE_DET','POS mode. Simulation or production.');
define('_JSHOP_REDSYS_SIMULATION','Simulation');
define('_JSHOP_REDSYS_PRODUCTION','Production');
define('_JSHOP_REDSYS_POS_URL_SIM','POS simulation URL');
define('_JSHOP_REDSYS_POS_URL_SIM_DET','URL to connect with the POS in simulation mode');
define('_JSHOP_REDSYS_POS_URL_PROD','POS production URL');
define('_JSHOP_REDSYS_POS_URL_PROD_DET','URL to connect with the POS in production mode');
define('_JSHOP_REDSYS_STORE_NAME','Store name');
define('_JSHOP_REDSYS_STORE_NAME_DET','Virtual store name that appears on the ticket of the customer');
define('_JSHOP_REDSYS_SALE_DESCRIPTION','Sale description');
define('_JSHOP_REDSYS_SALE_DESCRIPTION_DET','Description of the sale. This field will be shown to the client in the confirmation purchase screen');
define('_JSHOP_REDSYS_COMMERCE_NUMBER','Commerce number (FUC)');
define('_JSHOP_REDSYS_COMMERCE_NUMBER_DET','FUC of the commerce (numeric, 9 digits long, it is not necessary to fill with 0 to 9 positions)');
define('_JSHOP_REDSYS_TERMINAL_NUMBER','Terminal number');
define('_JSHOP_REDSYS_TERMINAL_NUMBER_DET','Terminal of commerce (numeric, 3 digits long, also not necessary to fill with 0 all the positions)');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER','Currency identifier');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER_DET','ISO code of the currency used in the POS (978 for euro)');
define('_JSHOP_REDSYS_TRANSACTION_TYPE','Transaction type identifier');
define('_JSHOP_REDSYS_TRANSACTION_TYPE_DET','The most common is transaction = 0 => Authorization');
define('_JSHOP_REDSYS_POS_LANG','POS customer language');
define('_JSHOP_REDSYS_POS_LANG_DET','POS language to show to the customer');
define('_JSHOP_REDSYS_LANG_UNDEFINED','Undefined');
define('_JSHOP_REDSYS_LANG_AUTOMATIC','Automatic');
define('_JSHOP_REDSYS_LANG_SPANISH','Spanish');
define('_JSHOP_REDSYS_LANG_ENGLISH','English');
define('_JSHOP_REDSYS_LANG_CATALAN','Catalan');
define('_JSHOP_REDSYS_LANG_FRENCH','French');
define('_JSHOP_REDSYS_LANG_GERMAN','German');
define('_JSHOP_REDSYS_LANG_DUTCH','Dutch');
define('_JSHOP_REDSYS_LANG_ITALIAN','Italian');
define('_JSHOP_REDSYS_LANG_SWEDISH','Swedish');
define('_JSHOP_REDSYS_LANG_PORTUGUESE','Portuguese');
define('_JSHOP_REDSYS_LANG_VALENCIAN','Valencian');
define('_JSHOP_REDSYS_LANG_POLISH','Polish');
define('_JSHOP_REDSYS_LANG_GALIZAN','Galizan');
define('_JSHOP_REDSYS_LANG_BASQUE','Basque');
define('_JSHOP_REDSYS_TRANSACTION_END','Order status for successful transactions');
define('_JSHOP_REDSYS_TRANSACTION_END_DET','Select the order status to which the actual order will be set, if the payment process was successful');
define('_JSHOP_REDSYS_TRANSACTION_PENDING','Order status for pending payments');
define('_JSHOP_REDSYS_TRANSACTION_PENDING_DET','Select the order status to which the actual order will be set if the payment transaction isn\'t completed');
define('_JSHOP_REDSYS_TRANSACTION_FAILED','Order Status for failed transactions');
define('_JSHOP_REDSYS_TRANSACTION_FAILED_DET','Select the order status to which the actual order will be set, if the payment process fails');
define('_JSHOP_REDSYS_DEBUG','Debug?');
define('_JSHOP_REDSYS_DEBUG_DET','If set to yes, payment transaction will be logged in the log folder');
define('_JSHOP_REDSYS_POS_KEY','POS secret key');
define('_JSHOP_REDSYS_POS_KEY_DET','Show / change secret key');
define('_JSHOP_REDSYS_CRYPT_WARNING','Warning: Joomla Empresa POS common component (version >= 3.0.0) not found. The payment plug-in won\'t work at all without it!!!');
define('_JSHOP_REDSYS_CHANGE_KEY','Change secret key');
define('_JSHOP_REDSYS_CHANGE_KEY_DET','Click here to see or change your secret key');

define('_JSHOP_REDSYS_POS_PAYMENT_TYPE','Payment type');
define('_JSHOP_REDSYS_ALL','All');
define('_JSHOP_REDSYS_CARD','Credit card');
define('_JSHOP_REDSYS_IUPAY','Iupay');
define('_JSHOP_REDSYS_CARD_IUPAY','Credit card and Iupay');
define('_JSHOP_REDSYS_POS_PAYMENT_TYPE_DET','Payment type allowed in the POS');
