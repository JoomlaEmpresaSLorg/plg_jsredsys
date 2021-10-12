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

define('_JSHOP_REDSYS_DESCRIPTION','Método de pago Redsys para JoomShopping 3-4. Este plug-in te permitirá añadir el pago a través del TPV virtual para entidades bancarias de la red Redsys (CaixaBank, Bankia, Banc Sabadell, etc.) a los métodos de pago de tu JoomShooping 3. Consigue las versiones más recientes y la documentación oficial en <a href="http://www.joomlaempresa.es/es" target="_blank">http://www.joomlaempresa.es</a>.<br /><br /><strong style=\'color:red;\'>Notas sobre tu TPVV Redsys:</strong><ul style=\'margin: 0; list-style: none;\'><li>Los parámetros <strong>URL TPVV simulación y/o URL TPVV producción</strong>, <strong>Número comercio (FUC)</strong>, <strong>Divisa</strong> y <strong>Número terminal</strong> son obligatorios y el método de pago no funcionará si no los defines</li></ul>');
define('_JSHOP_REDSYS_POS_MODE','Modo del TPVV');
define('_JSHOP_REDSYS_POS_MODE_DET','Modo del TPVV. Simulación o producción.');
define('_JSHOP_REDSYS_SIMULATION','Simulación');
define('_JSHOP_REDSYS_PRODUCTION','Producción');
define('_JSHOP_REDSYS_POS_URL_SIM','URL TPVV simulación');
define('_JSHOP_REDSYS_POS_URL_SIM_DET','Esta URL está indicada en la documentación de tu TPVV, y es la URL de integración para realizar las operaciones en modo de simulación');
define('_JSHOP_REDSYS_POS_URL_PROD','URL TPVV producción');
define('_JSHOP_REDSYS_POS_URL_PROD_DET','Esta URL está indicada en la documentación de tu TPVV, y es la URL de integración para realizar las operaciones en modo de producción');
define('_JSHOP_REDSYS_STORE_NAME','Nombre de la tienda');
define('_JSHOP_REDSYS_STORE_NAME_DET','Nombre de la tienda virtual que aparecerá en el ticket del cliente');
define('_JSHOP_REDSYS_SALE_DESCRIPTION','Descripción de la venta');
define('_JSHOP_REDSYS_SALE_DESCRIPTION_DET','Descripción de la venta. Este campo se mostrará al titular en la pantalla de confirmación del pedido');
define('_JSHOP_REDSYS_COMMERCE_NUMBER','Número comercio (FUC)');
define('_JSHOP_REDSYS_COMMERCE_NUMBER_DET','FUC del comercio (numérico 9 dígitos como máximo, no es necesario rellenar con 0 hasta las 9 posiciones)');
define('_JSHOP_REDSYS_TERMINAL_NUMBER','Número terminal');
define('_JSHOP_REDSYS_TERMINAL_NUMBER_DET','Terminal del comercio (numérico 3 dígitos, tampoco es necesario rellenar con 0)');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER','Divisa');
define('_JSHOP_REDSYS_CURRENCY_IDENTIFIER_DET','Divisa aceptada para el pago (978 para euros)');
define('_JSHOP_REDSYS_TRANSACTION_TYPE','Tipo de transacción');
define('_JSHOP_REDSYS_TRANSACTION_TYPE_DET','La más habitual es la transacción = 0 => Autorización');
define('_JSHOP_REDSYS_POS_LANG','Idioma en el TPVV');
define('_JSHOP_REDSYS_POS_LANG_DET','Idioma del TPVV para mostrar al cliente');
define('_JSHOP_REDSYS_LANG_UNDEFINED','No definido');
define('_JSHOP_REDSYS_LANG_AUTOMATIC','Automático');
define('_JSHOP_REDSYS_LANG_SPANISH','Castellano');
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
define('_JSHOP_REDSYS_LANG_GALIZAN','Gallego');
define('_JSHOP_REDSYS_LANG_BASQUE','Vasco');
define('_JSHOP_REDSYS_TRANSACTION_END','Estado de los pedidos en caso de transacciones correctas');
define('_JSHOP_REDSYS_TRANSACTION_END_DET','Elige el estado al que cambiar el pedido si el pago es correcto');
define('_JSHOP_REDSYS_TRANSACTION_PENDING','Estado de los pedidos en caso de pagos pendientes');
define('_JSHOP_REDSYS_TRANSACTION_PENDING_DET','Elige el estado al que cambiar el pedido si la transacción no se completa');
define('_JSHOP_REDSYS_TRANSACTION_FAILED','Estado de los pedidos en caso de transacciones incorrectas');
define('_JSHOP_REDSYS_TRANSACTION_FAILED_DET','Elige el estado al que cambiar el pedido si el pago es incorrecto');
define('_JSHOP_REDSYS_DEBUG','¿Depurar?');
define('_JSHOP_REDSYS_DEBUG_DET','Si seleccionas \'sí\', se registrarán varios datos de las transacciones en un archivo de la carpeta de logs');
define('_JSHOP_REDSYS_POS_KEY','Clave secreta TPVV');
define('_JSHOP_REDSYS_POS_KEY_DET','Mostrar / cambiar clave secreta');
define('_JSHOP_REDSYS_CRYPT_WARNING','Atención: no se ha encontrado el componente común para los TPVV de Joomla Empresa (version >= 3.0.0). ¡¡¡El método de pago no funcionará sin él!!!');
define('_JSHOP_REDSYS_CHANGE_KEY','Cambiar clave secreta');
define('_JSHOP_REDSYS_CHANGE_KEY_DET','Haz click aquí para ver o cambiar tu clave secreta');

define('_JSHOP_REDSYS_POS_PAYMENT_TYPE','Tipo de pago');
define('_JSHOP_REDSYS_ALL','Todos');
define('_JSHOP_REDSYS_CARD','Tarjeta de crédito');
define('_JSHOP_REDSYS_IUPAY','Iupay');
define('_JSHOP_REDSYS_CARD_IUPAY','Tarjeta de crédito e Iupay');
define('_JSHOP_REDSYS_POS_PAYMENT_TYPE_DET','Tipo de pagamento permitido en el TPVv');
