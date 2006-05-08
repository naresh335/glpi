<?php
/*
 * @version $Id$
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/

 

//Class Devices
class Device extends CommonDBTM {
	var $type=0;

	function Device($dev_type) {
		$this->type=$dev_type;
		$this->table=getDeviceTable($dev_type);
	}
	
	
	function cleanDBonPurge($ID) {
		global $db;
		$query2 = "DELETE FROM glpi_computer_device WHERE (FK_device = '$ID' AND device_type='".$this->type."')";
		$db->query($query2);
	}
	
	// SPECIFIC FUNCTIONS
	
	function computer_link($compID,$device_type,$specificity='') {
		global $db;
		$query = "INSERT INTO glpi_computer_device (device_type,FK_device,FK_computers,specificity) values ('".$device_type."','".$this->fields["ID"]."','".$compID."','".$specificity."')";
		if($db->query($query)) {
			return $db->insert_id();
		} else { 
			return false;
		}
	}
}
?>