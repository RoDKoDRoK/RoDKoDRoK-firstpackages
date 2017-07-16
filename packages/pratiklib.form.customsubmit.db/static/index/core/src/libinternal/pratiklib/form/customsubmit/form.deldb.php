<?php

/*
var dispos:
$tabpost (array des valeur envoyées en POST)
$tabparam (array des params supplémentaires)

$preform (array du preform si besoin)

*/


//get params
$id=$tabparam['id'];
$table=ucfirst(strtolower($tabparam['table']));

//table
$dbtable=null;
if($this->includer->include_dbtableclass("DbTable".$table))
	eval("\$dbtable=new DbTable".$table."(\$this->initer);");

//action del from db
if(is_numeric($id) && $id>0)
{
	//del from db
	if($dbtable)
		$dbtable->delete($id);
}


?>