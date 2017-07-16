<?php

class DumpNodump
{	
	
	function __construct($initer=null,$dumpfilename='dump.sql')
	{
		
	}

	
	
	/**
	* Writes to file the $table's structure
	* @param string $table The table name
	*/
  function getTableStructure($table){
		
	}

	/**
	* Writes to file the $table's data
	* @param string $table The table name
	* @param boolean $hexValue It defines if the output is base 16 or not
	*/
	function getTableData($table,$hexValue = true) {
		
	}

  /**
	* Writes to file all the selected database tables structure
	* @return boolean
	*/
	function getDatabaseStructure(){
		
		return true;
  }

	/**
	* Writes to file all the selected database tables data
	* @param boolean $hexValue It defines if the output is base-16 or not
	*/
	function getDatabaseData($hexValue = true){
		
  }

  /**
	* Writes to file the selected database dump
	*/
	function startDump() {
		
		return true;
	}
	
	/**
	* Writes to file the selected database dump
	*/
	function endDump($close_file = true) {
		if ($close_file)
			$this->closeFile($this->file);
		return true;
	}
  
	/**
	* Writes to file the selected database dump
	*/
	function doDump($params = array(), $close_file = true) {
		
		return true;
	}
	

	/**
	* @access private
	*/
	function getSqlKeysTable ($table) {
		return null;
	}

  /**
	* @access private
	*/
	function isTextValue($field_type) {
		switch ($field_type) {
			case "tinytext":
			case "text":
			case "mediumtext":
			case "longtext":
			case "binary":
			case "varbinary":
			case "tinyblob":
			case "blob":
			case "mediumblob":
			case "longblob":
				return True;
				break;
			default:
				return False;
		}
	}
	
	/**
	* @access private
	*/
	function openFile($filename) {
		$file = false;
		if ( $this->compress )
			$file = @gzopen($filename, "w9");
		else
			$file = @fopen($filename, "w");
		return $file;
	}

  /**
	* @access private
	*/
	function saveToFile($file, $data) {
		if ( $this->compress )
			@gzwrite($file, $data);
		else
			@fwrite($file, $data);
		$this->isWritten = true;
	}

  /**
	* @access private
	*/
	function closeFile($file) {
		if ( $this->compress )
			@gzclose($file);
		else
			@fclose($file);
	}
	
	/**
	 * rod import
	 */
	function importDump($dumpfilename)
	{
		//load db
		$sqltoload=file_get_contents($dumpfilename);
		$tabsqltoload=explode(";",$sqltoload);
		foreach($tabsqltoload as $sqlcour)
		{
			$req=$this->db->query($sqlcour);
		}
	}
	
}


?>