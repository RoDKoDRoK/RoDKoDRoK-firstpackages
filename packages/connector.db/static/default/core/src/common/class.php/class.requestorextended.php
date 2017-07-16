<?php

class Requestorextended extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function checkTableExists($table)
	{
		$req=$this->db->query("SHOW TABLES LIKE '".$table."'");
		if($res=$this->db->fetch_array($req))
			return true;
		return false;
	}
	
	
	function exportGenesisdbfromfileToDb($table)
	{
		$tabtmp=$this->genesisdbfromfile->select("",$table);
		foreach($tabtmp as $lignecour)
		{
			$sqlidcolumn="  ";
			$sqlvaluecolumn="  ";
			foreach($lignecour as $idcolumn=>$valuecolumn)
			{
				$sqlidcolumn.=$idcolumn.", ";
				$sqlvaluecolumn.="'".$valuecolumn."', ";
			}
			$sqlidcolumn=substr($sqlidcolumn,0,-2);
			$sqlvaluecolumn=substr($sqlvaluecolumn,0,-2);
			
			if(isset($this->db) && $this->db!=null)
				$this->db->query("INSERT INTO ".$table." (".$sqlidcolumn.") VALUES (".$sqlvaluecolumn.");");
		}
		
		return true;
	}
	
	
	function importGenesisdbfromfileFromDb($table)
	{
		
		
		return false;
	}
	
	
}


?>