<?php

{if $instancecour.type == "table"}

class DbTable{$classnom} extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function select($where="",$orderby="")
	{
		$data=array();
		
		$sqlreq="";
		$sqlreq.="select * from {$tablenom} ";
		
		
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$where="where id{$tablenom}='".$id."'";
		}
		else
		{
			$where="where ".$where;
		}
		
		$sqlreq.=$where;
		
		
{if isset($options.hasauthor) && $options.hasauthor == "on"}
		$sqlreq.=" left join user on {$tablenom}.iduserauteur=user.iduser";
{/if}
		
		$sqlreq.=$orderby;
		
		$req=$this->db->query($sqlreq);
		while($res=$this->db->fetch_array($req))
			$data[]=$res;
	
		return $data;
	}
	
	
	
	//$data=array('column_name' => 'value')
	function insert($data=array())
	{
		//insert prepare
		$dataprepared="";
		$dataprepared.="NULL";
		$columnprepared="";
		$columnprepared="id{$tablenom}";
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=",'".$lineform."'";
			$columnprepared.=",".$idlineform."";
		}
		
		//INSERT
		$returned=$this->db->query("insert into {$tablenom} (".$columnprepared.") values (".$dataprepared.")");
		
		return $returned;
	}
	
	
	
	//$data=array('column_name' => 'value')
	function update($data=array(),$where="")
	{
		//update prepare
		$dataprepared="";
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=$idlineform."='".$lineform."',";
		}
		$dataprepared=substr($dataprepared,0,-1);
		
		
{if isset($options.historique) && $options.historique == "on"}
		//todo select where $id
		//todo insert into histo table
{/if}
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("update {$tablenom} set ".$dataprepared." where id{$tablenom}='".$id."'");
		}
		else
		{
			$returned=$this->db->query("update {$tablenom} set ".$dataprepared." where ".$where);
		}
		return $returned;
	}
	
	
	
	function delete($where="")
	{
{if isset($options.historique) && $options.historique == "on"}
		//todo select where $id
		//todo insert into histo table
{/if}
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("delete from {$tablenom} where id{$tablenom}='".$id."'");
		}
		else
		{
			$returned=$this->db->query("delete from {$tablenom} where ".$where);
		}
		return $returned;
	}
	
	
	function form($typeform="insert",$id=0)
	{
		$form=array();
		
		//init form
		$form['classicform']=true;
		
		$form['submitbutton']=true;
		$form['cancelbutton']=true;
		$form['backbutton']=true;
		
		$form['deletebutton']=true;
		
		
		if($typeform=="insert" || $typeform=="update")
		{
			if($typeform=="update")
			{
				$res=$this->db->query_one_result("select * from {$tablenom} where id{$tablenom}='".$id."'");
				$res=$this->db->decode($res);
			}
		
{if isset($columns) }
{section name=cptcolumns loop=$columns}
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('{$columns[cptcolumns].nom}');
			$form['lineform'][count($form['lineform'])-1]['name']="{$columns[cptcolumns].nom}";
			$form['lineform'][count($form['lineform'])-1]['default']="{$columns[cptcolumns].default}";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['{$columns[cptcolumns].nom}'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="{$columns[cptcolumns].suggestlist}";
			$form['lineform'][count($form['lineform'])-1]['champs']="{$columns[cptcolumns].type}";
{/section}
{/if}

{if isset($options.hastranslation) && $options.hastranslation == "on"}
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation("lang");
			$form['lineform'][count($form['lineform'])-1]['name']="lang";
			$form['lineform'][count($form['lineform'])-1]['default']=$_SESSION['lang'];
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res[$form['lineform'][count($form['lineform'])-1]['name']];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="hidden";
{/if}

{if isset($options.hasauthor) && $options.hasauthor == "on"}
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation("idauthor");
			$form['lineform'][count($form['lineform'])-1]['name']="idauthor";
			$form['lineform'][count($form['lineform'])-1]['default']=$_SESSION['uid'];
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res[$form['lineform'][count($form['lineform'])-1]['name']];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="hidden";
{/if}

{if isset($options.hasdest) && $options.hasdest == "on"}
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']="";
			$form['lineform'][count($form['lineform'])-1]['name']="iduserdest";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res[$form['lineform'][count($form['lineform'])-1]['name']];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="userselect";
			$form['lineform'][count($form['lineform'])-1]['champs']="select";
{/if}
			
		}
		
		$form['hiddenid']=false;
		if($typeform=="update" || $typeform=="delete")
		{
			$form['hiddenid']=true;
		}
		
		return $form;
	}
	
	
	
	function structure()
	{
		$tabstruct=array();

{if isset($columns) }		
{section name=cptcolumns loop=$columns}
		$tabstruct['{$columns[cptcolumns].nom}']="{$columns[cptcolumns].type}";
{/section}
{/if}


{if isset($options.hastranslation) && $options.hastranslation == "on"}
		$tabstruct['lang']="lang";
{/if}

{if isset($options.hasauthor) && $options.hasauthor == "on"}
		$tabstruct['idauthor']="user";
{/if}

{if isset($options.hasdest) && $options.hasdest == "on"}
		$tabstruct['iduserdest']="user";
{/if}
		
		return $tabstruct;
	}

	


}

{/if}
?>