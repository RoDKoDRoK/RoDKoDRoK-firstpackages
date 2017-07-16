<?php


class RequestorDriver extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	}
	
	
	
	
	function getSpecificDbtable($table="")
	{
		$instance=null;
		
		if($this->includer->include_class("dbtableclass",$table))
		{
			$instance=$this->instanciator->newInstance("dbtable".$table,$this->initer);
		}
		
		return $instance;
	}
	
	
	
	function select($table="",$where="",$orderby="")
	{
		$data=array();
		
		if($table=="")
			return $data;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->select($table,$where,$orderby);
		
		
		$sqlreq="";
		$sqlreq.="select * from ".$table." ";
		
		
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$where="where id".$table."='".$id."'";
		}
		else
		{
			$where="where ".$where;
		}
		
		$sqlreq.=$where;
		
		
		//$sqlreq.=" left join user on news.iduserauteur=user.iduser";
		
		$sqlreq.=$orderby;
		
		$req=$this->db->query($sqlreq);
		while($res=$this->db->fetch_array($req))
			$data[]=$res;
	
		return $data;
	}
	
	
	
	//$data=array('column_name' => 'value')
	function insert($table="",$data=array())
	{
		if($table=="")
			return null;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->insert($table,$data);
		
		
		//insert prepare
		$dataprepared="";
		$dataprepared.="NULL";
		$columnprepared="";
		$columnprepared="id".$table;
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=",'".$lineform."'";
			$columnprepared.=",".$idlineform."";
		}
		
		//INSERT
		$returned=$this->db->query("insert into ".$table." (".$columnprepared.") values (".$dataprepared.")");
		
		return $returned;
	}
	
	
	
	//$data=array('column_name' => 'value')
	function update($table="",$data=array(),$where="")
	{
		if($table=="")
			return null;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->update($table,$data,$where);
		
		
		//update prepare
		$dataprepared="";
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=$idlineform."='".$lineform."',";
		}
		$dataprepared=substr($dataprepared,0,-1);
		
		
		//todo select where $id
		//todo insert into histo table
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("update ".$table." set ".$dataprepared." where id".$table."='".$id."'");
		}
		else
		{
			$returned=$this->db->query("update ".$table." set ".$dataprepared." where ".$where);
		}
		return $returned;
	}
	
	
	
	function delete($table="",$where="")
	{
		if($table=="")
			return null;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->delete($table,$where);
		
		
		//todo select where $id
		//todo insert into histo table
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("delete from ".$table." where idnews='".$id."'");
		}
		else
		{
			$returned=$this->db->query("delete from ".$table." where ".$where);
		}
		return $returned;
	}
	
	
	function form($table="",$typeform="insert",$id=0)
	{
		if($table=="")
			return null;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->form($table,$typeform,$id);
		
		
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
				$res=$this->db->query_one_result("select * from ".$table." where id".$table."='".$id."'");
				$res=$this->db->decode($res);
			}
			
			//TODO !!!!!!!!!!!!!!!!!!!!!!!!!
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('titre');
			$form['lineform'][count($form['lineform'])-1]['name']="titre";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['titre'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="varchar";
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('texte');
			$form['lineform'][count($form['lineform'])-1]['name']="texte";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['texte'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="textwysiwygckeditor";
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('date');
			$form['lineform'][count($form['lineform'])-1]['name']="date";
			$form['lineform'][count($form['lineform'])-1]['default']="NULL";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['date'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="date";

			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation("lang");
			$form['lineform'][count($form['lineform'])-1]['name']="lang";
			$form['lineform'][count($form['lineform'])-1]['default']=$_SESSION['lang'];
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res[$form['lineform'][count($form['lineform'])-1]['name']];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="hidden";

			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation("idauthor");
			$form['lineform'][count($form['lineform'])-1]['name']="idauthor";
			$form['lineform'][count($form['lineform'])-1]['default']=$_SESSION['uid'];
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res[$form['lineform'][count($form['lineform'])-1]['name']];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="";
			$form['lineform'][count($form['lineform'])-1]['champs']="hidden";

			
		}
		
		$form['hiddenid']=false;
		if($typeform=="update" || $typeform=="delete")
		{
			$form['hiddenid']=true;
		}
		
		return $form;
	}
	
	
	
	function structure($table="")
	{
		if($table=="")
			return null;
		
		
		//check specific dbtable class
		$instance=$this->getSpecificDbtable($table);
		if($instance)
			return $instance->structure($table);
		
		
		$tabstruct=array();

		//TODO !!!!!!!!!!!!!!!!!!!!!!!!!
		$tabstruct['titre']="varchar";
		$tabstruct['texte']="textwysiwygckeditor";
		$tabstruct['date']="date";


		$tabstruct['lang']="lang";

		$tabstruct['idauthor']="user";

		
		return $tabstruct;
	}

	
	
	

}



?>