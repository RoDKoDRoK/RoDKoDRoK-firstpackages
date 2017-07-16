<?php

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
	function update($data="",$where="")
	{
		//update prepare
		$dataprepared="";
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=$idlineform."='".$lineform."',";
		}
		$dataprepared=substr($dataprepared,0,-1);
		
		
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
			}
			
			//user de base
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('Login');
			$form['lineform'][count($form['lineform'])-1]['name']="pseudo";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['pseudo'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="text";
			
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('Mail');
			$form['lineform'][count($form['lineform'])-1]['name']="login_mail";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['login_mail'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="text";
			
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('Pwd');
			$form['lineform'][count($form['lineform'])-1]['name']="pwd";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['pwd'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="hidden";
			
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('Langue par defaut');
			$form['lineform'][count($form['lineform'])-1]['name']="lang";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['lang'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="text";
			
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('Droit d\'acces');
			$form['lineform'][count($form['lineform'])-1]['name']="droit";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['droit'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="text";
			
			
			
			//extensions
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
		
		return $tabstruct;
	}

	


}


?>