<?php

/**
 * Prequel amélioré: SQL-based manipulations for PHP arrays.
 * Select. Where. Like. Union. Join. Insert, Update, delete, order by, and improved with table per file yet
 * 
 * PHP version 5
 *
 * @author    Alfred Xing <xing@lfred.info> repaired and improved by Rodolphe Boury
 * @copyright 2013 Alfred Xing
 * @license   LICENSE.md MIT License
 * @version   0.1.0
 * 
 */

class DbFromFile
{

	function __construct($dbpath = "rkrsystem/dbfromfile")
	{
		$this -> dbpath = $dbpath;
	}
	
	
	
	
	function getPathToTableFile($table)
	{
		return $this -> dbpath."/".$table.".rdb";
	}
	
	
	/**
	 * Initialize database for work
	 *
	 * @param string $file relative path of database
	 *
	 * @return string       existence status of database
	 */
	function createTable($table)
	{
		if (!file_exists($this->getPathToTableFile($table))) {
			file_put_contents($this->getPathToTableFile($table), "");
			return "Table '".$table."' successfully created.";
		}
	}

	/**
	 * Delete database
	 *
	 * @return string
	 */
	function dropTable($table)
	{
		if (file_exists($this->getPathToTableFile($table))) {
			unlink($this->getPathToTableFile($table));
			return "Table '".$table."' successfully deleted.";
		} else {
			return "Table '".$table."' doesn't exist.";
		}
	}
	
	
	function getTable($table)
	{
		if(is_array($table))
			return $table;
		
		$tablecontent=array();
		if (file_exists($this->getPathToTableFile($table)))
		{
			$tablecontenttmp = file_get_contents($this->getPathToTableFile($table));
			if ($tablecontenttmp!="")
			{
				return json_decode($tablecontenttmp, true);
			}
			return $tablecontent;
		}
		
		return $tablecontent;
	}
	
	
	/**
	 * Rewrite data
	 *
	 * @param array $data
	 */
	function setTable($table,$data)
	{
		file_put_contents($this->getPathToTableFile($table), json_encode($data));
		return $data;
	}
	
	
	
	/**
	 * Check if table exists
	 *
	 * @param string $table
	 */
	function isTable($table)
	{
		if (file_exists($this->getPathToTableFile($table)))
			return true;
		return false;
	}
	
	
	
	
	
	
	
	
	/**
	 * Appends data to database
	 *
	 * @param array $data
	 */
	function insert($table, $data)
	{
		$_db = $this->getTable($table);
		$_db[] = $data;
		return $this -> setTable($table,$_db);
	}
	
	/**
	 * Remove a row from the database
	 *
	 * @param integer $index the index of the row to remove with id<table>
	 * @activatedirectindex boolean $activatedirectindex to use the index of the row to remove with the case number directly, old system, dangerous to use...
	 */
	function delete($table, $index, $activatedirectindex=false) {
		$_db = $this->getTable($table);
		
		//find the number of the row with id<table> selected in $index
		if($activatedirectindex==false)
		{
			if(!is_array($table))
				$index=$this->index("id".$table,$index,$_db,"",true);
		}
		
		//delete a row with the number of the case in $index
		array_splice($_db, $index, 1);
		
		return $this -> setTable($table,$_db);
	}

	/**
	 * Updates a row in the database
	 *
	 * @param integer $index the index of the row to update
	 * @param array $data
	 */
	function update($table, $index, $data, $activatedirectindex=false) {
		$_db = $this->getTable($table);
		
		//find the number of the row with id<table> selected in $index
		if($activatedirectindex==false)
		{
			if(!is_array($table))
				$index=$this->index("id".$table,$index,$_db,"",true);
		}
		
		//update a row with the number of the case in $index
		$_db[$index] = array_merge($_db[$index], $data);
		
		return $this -> setTable($table,$_db);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * Returns the index of a row where key matches value or if exists the column $idtablename or id<table> by default which is considered as an index
	 *
	 * @param string $key
	 * @param string $val
	 * @param string $db
	 * @param string $idtablename = nom column identifiant ou id<table> par défaut, à préciser impérativement quand la table à scanner est un tableau intermédiaire et non le nom d'une table directement scannée
	 * @param string $returncasenumber true pour forcer le renvoie du numéro de la case à la place de l'id<table> (utilisé dans les fonction delete et update, à ne pas utiliser ailleurs)
	 *
	 * @return integer
	 */
	function index($key, $val, $db, $idtablename="", $returncasenumber=false)
	{
		//get table name
		if(!is_array($db) && $idtablename=="")
			$idtablename="id".$db;
		
		//check db is a table or an array
		$db=$this->getTable($db);
		
		foreach ($db as $index => $row)
		{
			if ($row[$key] === $val)
			{
				//check if exists id<table>
				if($returncasenumber==false && isset($row[$idtablename]))
					return $row[$idtablename];
				
				return $index;
			}
		}
		
		return 0;
		
	}
	
	
	
	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * 
	 * @param string $col the column to get
	 * @param string $key the key whose value to match
	 * @param string $val the value to match
	 * @param array  $db  the array to get from
	 * 
	 * @return array
	 */
	function get($col, $key, $val, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		foreach ($db as $row) {
			if ($row[$key] === $val && $row[$col]) {
				return $row[$col];
				break;
			}
		}
	}

	/**
	 * Get a set of columns for all rows
	 * 
	 * @param array $cols the list of columns to get, empty for all
	 * @param array $db   the array to select from
	 * 
	 * @return array
	 */
	function select($cols, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = array();
		$_values = array();
		if ($cols === array() || $cols=="") {
			foreach ($db as $row) {
				foreach (array_keys($row) as $c) {
					$_values[$c] = $row[$c];
				};
				if ($_values)
					$_result[] = $_values;
				$_values = array();
			}
		} else {
			foreach ($db as $row) {
				foreach ((array) $cols as $c) {
					if ($row[$c])
						$_values[$c] = $row[$c];
				};
				if ($_values)
					$_result[] = $_values;
				$_values = array();
			}
		}
		return $_result;
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * 
	 * @param array  $cols the columns to select
	 * @param string $key  the key whose value to match
	 * @param string $val  the value to match
	 * @param array  $db   the array to work on
	 * @param array  $operator   the operator to compare key with value (=, !=, <, >, <=, >=) //TOTEST
	 * 
	 * @return array
	 */
	function where($cols, $key, $val, $db, $operator="=")
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = array();
		$_values = array();
		if ($cols === array() || $cols=="") {
			foreach ($db as $row) {
				//operator pour le test
				switch($operator)
				{
					case "=":
							$test=($row[$key] === $val);
						break;
					case "!=":
							$test=($row[$key] != $val);
						break;
						
					default:
							eval("\$test=(\$row[\$key] ".$operator." \$val);");
						break;
				}
				
				//test
				if ($test) {
					foreach (array_keys($row) as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				}
			}
		} else {
			foreach ($db as $row) {
				//operator pour le test
				switch($operator)
				{
					case "=":
							$test=($row[$key] === $val);
						break;
					case "!=":
							$test=($row[$key] != $val);
						break;
						
					default:
							eval("\$test=(\$row[\$key] ".$operator." \$val);");
						break;
				}
				
				//test
				if ($test) {
					foreach ((array) $cols as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				};
			}
		}
		return $_result;
	}

	/**
	 * Get columns from rows in which the key's value is part of the inputted array of values
	 * 
	 * @param array  $cols the columns to return
	 * @param string $key  the column to look for the value
	 * @param array  $val  an array of values to be accepted
	 * @param array  $db   the array to work on
	 * 
	 * @return array
	 */
	function in($cols, $key, $val, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = array();
		$_values = array();
		if ($cols === array() || $cols=="") {
			foreach ($db as $row) {
				if (in_array($row[$key], $val)) {
					foreach (array_keys($row) as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				}
			}
		} else {
			foreach ($db as $row) {
				if (in_array($row[$key], $val)) {
					foreach ((array) $cols as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				};
			}
		}
		return $_result;
	}

	/**
	 * Matches keys and values based on a regular expression
	 * 
	 * @param array  $cols  the columns to return; an empty array returns all columns
	 * @param string $key   the column whose value to match
	 * @param string $regex the regular expression to match
	 * @param array  $db    the array to go through
	 * 
	 * @return array
	 */
	function like($cols, $key, $regex, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = array();
		$_values = array();
		if ($cols === array() || $cols=="") {
			foreach ($db as $row) {
				if (preg_match($regex, $row[$key])) {
					foreach (array_keys($row) as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				}
			}
		} else {
			foreach ($db as $row) {
				if (preg_match($regex, $row[$key])) {
					foreach ((array) $cols as $c) {
						$_values[$c] = $row[$c];
					};
					$_result[] = $_values;
					$_values = array();
				};
			}
		}
		return $_result;
	}


	/**
	 * Merges two databases and gets rid of duplicates
	 * 
	 * @param array $cols   the columns to merge
	 * @param array $left   the first array to merge
	 * @param array $right  the second array to merge
	 * 
	 * @return array          the merged array
	 */
	function union($cols, $left, $right)
	{
		//check db is a table or an array
		$left=$this->getTable($left);
		$right=$this->getTable($right);
		
		return array_map(
			"unserialize", array_unique(
				array_map(
					"serialize", array_merge(
						$this
						-> select($cols, $left),
						$this
						-> select($cols, $right)
						)
					)
				)
			);
	}

	/**
	 * Matches and merges columns between databases
	 * 
	 * @param string $method the method to join (inner, left, right, full)
	 * @param array  $cols   the columns to select
	 * @param array  $left   the first database to consider
	 * @param array  $righ   the second database to consider
	 * @param array  $match  a key-value pair: left column to match => right column
	 * 
	 * @return array joined array
	 */
	function join($method, $cols, $left, $right, $match)
	{
		//check db is a table or an array
		$left=$this->getTable($left);
		$right=$this->getTable($right);
		
		$_result = array();
		$_values = array();
		if ($method === "inner") {
			foreach ($left as $lrow) {
				foreach ($right as $rrow) {
					if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
						$_result[] = array_merge($lrow, $rrow);
					}
				}
			}
		} elseif ($method === "left") {
			foreach ($left as $lrow) {
				foreach ($right as $rrow) {
					if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
						$_values = array_merge($lrow, $rrow);
						break;
					} else {
						$_values = $lrow;
					}
				}
				$_result[] = $_values;
				$_values = array();
			}
		} elseif ($method === "right") {
			foreach ($left as $lrow) {
				foreach ($right as $rrow) {
					if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
						$_values = array_merge($lrow, $rrow);
						break;
					} else {
						$_values = $rrow;
					}
				}
				$_result[] = $_values;
				$_values = array();
			}
		} elseif ($method === "full") {
			$_result = array_map(
				"unserialize", array_unique(
					array_map(
						"serialize", array_merge(
							$this
							-> join("left", $cols, $left, $right, $match),
							$this
							-> join("right", $cols, $left, $right, $match)
							)
						)
					)
				);
		}
		return $this -> select($cols, $_result);
	}


	/**
	 * Checks whether the given key/value pair exists
	 * 
	 * @param string $key the key
	 * @param string $val the value
	 * @param array  $db  the array to work on
	 * 
	 * @return boolean whether the pair exists
	 */
	function exists($key, $val, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = false;
		foreach ($db as $row) {
			if ($row[$key] === $val) {
				$_result = true;
			}
		}
		return $_result;
	}

	/**
	 * Counts the number of items per column or for all columns
	 * 
	 * @param string $col the column name to count. No input counts all columns.
	 * @param array  $db  the array to count
	 * 
	 * @return int the number of rows containing that column.
	 */
	function count($col, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		if ($col === "") {
			$query = array();
		} else {
			$query = (array) $col;
		}
		return count($this -> select($query, $db));
	}

	/**
	 * Gets the first item of a column
	 * 
	 * @param string $col the column to look at
	 * @param array  $db  the array to work on
	 * 
	 * @return mixed the first item in the column
	 */
	function first($col, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		return $this -> select((array) $col, $db)[0][$col];
	}

	/**
	 * Gets the last item in a column
	 * 
	 * @param string $col the name of the column to look at
	 * @param array  $db  the array to work on
	 * 
	 * @return mixed the last item in the column
	 */
	function last($col, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_values = $this -> select((array) $col, $db);
		return end($_values)[$col];
	}
	
	
	
	
	
	
	
	function orderby($col, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$tabtri=array();
		foreach ($db as $key=>$row)
			if(isset($row[$col]))
				$tabtri[$key]=$row[$col];
			else
				return $db;
		
		$_result=$db;
		
		array_multisort(
				$tabtri,
				$_result
			);
		
		return $_result;
	}
	
	
	
	/**
	 * Get a max value of a column
	 * 
	 * @param array $col  the  columns to get
	 * @param array $db   the array to select from
	 * 
	 * @return array
	 */
	function max($col, $db)
	{
		//check db is a table or an array
		$db=$this->getTable($db);
		
		$_result = false;
		$_values = array();
		if ($col != "") {
			foreach ($db as $row) {
				if(isset($row[$col])) {
					$_values[] = $row[$col];
				};
			}
		}
		if(count($_values)>0)
			$_result=max($_values);
		
		if($_result==false)
			$_result=0;
		
		return $_result;
	}
	
	
	
}


?>