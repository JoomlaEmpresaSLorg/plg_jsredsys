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

define('_JSHOP_REDSYS_DESCRIPTION','Método de pagamento Redsys para JoomShopping 3-4. Este plug-in permitirache engadires o pagamento a través do TPV virtual para entidades bancarias da rede Redsys (CaixaBank, Bankia, Banc Sabadell, etc.) aos métodos de pagamento do teu JoomShopping 3-4. Consegue as versións máis recentes e a documentación oficial en <strong><a href="http://www.joomlaempresa.es/gl" target="_blank">http://www.joomlaempresa.es</a></strong>.<br /><br /><strong style=\'color:red;\'>Notas sobre o teu TPVV Redsys:</strong><ul style=\'margin: 0; list-style: none;\'><li>Os parámetros <strong>URL TPVV simulación e/ou URL TPVV simulación</strong>, <strong>Número comercio (FUC)</strong>, <strong>Moeda</strong> e <strong>Terminal do comercio</strong> son obrigatorios e o método de pagamento non funcionará se non os insires</li></ul>');
define('_JSHOP_REDSYS_POS_MODE','Modo do TPVV');
define('_JSHOP_REDSYS_POS_MODE_DET','Modo do TPVV. Simulación ou produción.');
define('_JSHOP_REDSYS_SIMULATION','Simulación');
define('_JSHOP_REDSYS_PRODUCTION','Produción');
define('_JSHOP_REDSYS_POS_URL_SIM','URL TPVV simulación');
define('_JSHOP_REDSYS_POS_URL_SIM_DET','Este URL ven na documentación do teu TPVV, e é o URL de integración para realizar as operacións no modo de simulación');
define('_JSHOP_REDSYS_POS_URL_PROD','URL TPVV produción');
define('_JSHOP_REDSYS_POS_URL_PROD_DET','Este URL ven na documentación do teu TPVV, e é o URL de integración para realizar as operacións no modo de produción');
define('_JSHOP_REDSYS_STORE_NAME','Nome da tenda');
define('_JSHOP_REDSYS_STORE_NAME_DET','Nome da tenda virtual que aparecerá no ticket do cliente');
define('_JSHOP_REDSYS_SALE_DESCRIPTION','Descrición da venda');
define('_JSHOP_REDSYS_SALE_DESCRIPTION_DET','Descrición da venda. Este campo amosarase ao titular na pantalla de confirmación da encomenda');
define('_JSHOP_REDSYS_COMMERCE_NUMBER','Número comercio (FUC)');
define('_JSHOP_REDSYS_COMMERCE_NUMBER_DET','FUC do comercio (numérico 9 díxitos como máximo, non é preciso encher con 0 até as 9 posicións)');
define('_JSHOP_REDSYS_TERMINAL_NUMBER','Número do terminal');
define('_JSHOP_REDSYS_TERMINAL_NUMBER_DET','Terminal do comercio (numérico 3 díxitos, tampouco é preciso encher con 0)');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER','Moeda');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER_DET','Moeda ou divisa empregada para o pagamento (978 para euros)');
define('_JSHOP_REDSYS_TRANSACTION_TYPE','Tipo de transacción');
define('_JSHOP_REDSYS_TRANSACTION_TYPE_DET','A máis habitual é a transacción = 0 => Autorización');
define('_JSHOP_REDSYS_POS_LANG','Idioma do TPVV');
define('_JSHOP_REDSYS_POS_LANG_DET','Idioma do TPVV para amosar ao cliente');
define('_JSHOP_REDSYS_LANG_UNDEFINED','Sen definir');
define('_JSHOP_REDSYS_LANG_AUTOMATIC','Automático');
define('_JSHOP_REDSYS_LANG_SPANISH','Castelán');
define('_JSHOP_REDSYS_LANG_ENGLISH','Inglés');
define('_JSHOP_REDSYS_LANG_CATALAN','Catalán');
define('_JSHOP_REDSYS_LANG_FRENCH','Francés');
define('_JSHOP_REDSYS_LANG_GERMAN','Alemán');
define('_JSHOP_REDSYS_LANG_DUTCH','Holandés');
define('_JSHOP_REDSYS_LANG_ITALIAN','Italiano');
define('_JSHOP_REDSYS_LANG_SWEDISH','Sueco');
define('_JSHOP_REDSYS_LANG_PORTUGUESE','Portugués');
define('_JSHOP_REDSYS_LANG_VALENCIAN','Valenciano');
define('_JSHOP_REDSYS_LANG_POLISH','Polaco');
define('_JSHOP_REDSYS_LANG_GALIZAN','Galego');
define('_JSHOP_REDSYS_LANG_BASQUE','Euskera');
define('_JSHOP_REDSYS_TRANSACTION_END','Estado das encomendas para as transaccións correctas');
define('_JSHOP_REDSYS_TRANSACTION_END_DET','Escolle o estado para o que mudará a encomenda se o pagamento for correcto');
define('_JSHOP_REDSYS_TRANSACTION_PENDING','Estado das encomendas para pagamentos pendentes');
define('_JSHOP_REDSYS_TRANSACTION_PENDING_DET','Escolle o estado para o que mudará a encomenda se a transacción non for completada');
define('_JSHOP_REDSYS_TRANSACTION_FAILED','Estado das encomendas para as transaccións incorrectas');
define('_JSHOP_REDSYS_TRANSACTION_FAILED_DET','Escolle o estado para o que mudará a encomenda se o pagamento for incorrecto');
define('_JSHOP_REDSYS_DEBUG','Depurar?');
define('_JSHOP_REDSYS_DEBUG_DET','Se escolleres \'si\', rexistraranse varios datos das transaccións nun arquivo do cartafol de logs');
define('_JSHOP_REDSYS_POS_KEY','Chave secreta TPVV');
define('_JSHOP_REDSYS_POS_KEY_DET','Amosar / mudar chave secreta');
define('_JSHOP_REDSYS_CRYPT_WARNING','Ollo: non se atopou o compoñente común para os TPVV de Joomla Empresa (version >= 3.0.0). O método de pagamento non funcionará sen el!!!');
define('_JSHOP_REDSYS_CHANGE_KEY','Mudar chave secreta');
define('_JSHOP_REDSYS_CHANGE_KEY_DET','Preme aquí para veres ou mudares a túa chave secreta');

define('_JSHOP_REDSYS_POS_PAYMENT_TYPE','Tipo de pagamento');
define('_JSHOP_REDSYS_ALL','Todos');
define('_JSHOP_REDSYS_CARD','Cartón de crédito');
define('_JSHOP_REDSYS_IUPAY','Iupay');
define('_JSHOP_REDSYS_CARD_IUPAY','Cartón de crédito e Iupay');
define('_JSHOP_REDSYS_POS_PAYMENT_TYPE_DET','Tipo de pagamento permitido no TPVv');
