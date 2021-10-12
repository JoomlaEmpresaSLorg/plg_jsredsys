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

jimport('joomla.filesystem.folder');

$query = "delete from #__jshopping_payment_method where payment_class='pm_redsys'";
$db->setQuery($query);
$db->query();

JFolder::delete(JPATH_ROOT."/components/com_jshopping/payments/pm_redsys");
JFile::delete(JPATH_ROOT."/administrator/components/com_jshopping/lang/en-GB-redsys.php");
JFile::delete(JPATH_ROOT."/administrator/components/com_jshopping/lang/gl-ES-redsys.php");
JFile::delete(JPATH_ROOT."/administrator/components/com_jshopping/lang/gl-ES-redsys.php");
