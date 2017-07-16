<?php

/*
Final main action of your form with all data sent

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

//encode data for db
$tabdatafordb=$this->db->encode($tabpost);

//action save to db
if(!(is_numeric($id) && $id>0))
{
	//insert into db
	if($dbtable)
		$dbtable->insert($tabdatafordb);
}
else
{	
	//update into db
	if($dbtable)
		$dbtable->update($tabdatafordb,$id);
}

?>