			
	
				

	
<?php


class DbTableSharedpackage extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function select($where="",$orderby="")
	{
		$data=array();
		
		$sqlreq="";
		$sqlreq.="select * from sharedpackage ";
		
		
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$where="where idsharedpackage='".$id."'";
		}
		else
		{
			$where="where ".$where;
		}
		
		$sqlreq.=$where;
		
		
		//$sqlreq.=" left join user on sharedpackage.iduserauteur=user.iduser";
		
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
		$columnprepared="idsharedpackage";
		foreach($data as $idlineform=>$lineform)
		{
			$dataprepared.=",'".$lineform."'";
			$columnprepared.=",".$idlineform."";
		}
		
		//INSERT
		$returned=$this->db->query("insert into sharedpackage (".$columnprepared.") values (".$dataprepared.")");
		
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
		
		
		//todo select where $id
		//todo insert into histo table
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("update sharedpackage set ".$dataprepared." where idsharedpackage='".$id."'");
		}
		else
		{
			$returned=$this->db->query("update sharedpackage set ".$dataprepared." where ".$where);
		}
		return $returned;
	}
	
	
	
	function delete($where="")
	{
		//todo select where $id
		//todo insert into histo table
		if(is_numeric($where) && $where>0)
		{
			$id=$where;
			$returned=$this->db->query("delete from sharedpackage where idsharedpackage='".$id."'");
		}
		else
		{
			$returned=$this->db->query("delete from sharedpackage where ".$where);
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
				$res=$this->db->query_one_result("select * from sharedpackage where idsharedpackage='".$id."'");
				$res=$this->db->decode($res);
			}
		
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('nomcodesharedpackage');
			$form['lineform'][count($form['lineform'])-1]['name']="nomcodesharedpackage";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['nomcodesharedpackage'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="varchar";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('nomsharedpackage');
			$form['lineform'][count($form['lineform'])-1]['name']="nomsharedpackage";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['nomsharedpackage'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="varchar";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('groupe');
			$form['lineform'][count($form['lineform'])-1]['name']="groupe";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['groupe'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="varchar";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('mainimg');
			$form['lineform'][count($form['lineform'])-1]['name']="mainimg";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['mainimg'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="img";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('datecreate');
			$form['lineform'][count($form['lineform'])-1]['name']="datecreate";
			$form['lineform'][count($form['lineform'])-1]['default']="NULL";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['datecreate'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="date";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('datemodif');
			$form['lineform'][count($form['lineform'])-1]['name']="datemodif";
			$form['lineform'][count($form['lineform'])-1]['default']="NULL";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['datemodif'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="date";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('text');
			$form['lineform'][count($form['lineform'])-1]['name']="text";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['text'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="textwysiwygckeditor";
			
			$form['lineform'][]=array();
			$form['lineform'][count($form['lineform'])-1]['label']=$this->instanceLang->getTranslation('externallink');
			$form['lineform'][count($form['lineform'])-1]['name']="externallink";
			$form['lineform'][count($form['lineform'])-1]['default']="";
			if($typeform=="update")
				$form['lineform'][count($form['lineform'])-1]['default']=$res['externallink'];
			$form['lineform'][count($form['lineform'])-1]['suggestlist']="none";
			$form['lineform'][count($form['lineform'])-1]['champs']="link";
			

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
	
	
	
	function structure()
	{
		$tabstruct=array();

		
		$tabstruct['nomcodesharedpackage']="varchar";
		$tabstruct['nomsharedpackage']="varchar";
		$tabstruct['groupe']="varchar";
		$tabstruct['mainimg']="img";
		$tabstruct['datecreate']="date";
		$tabstruct['datemodif']="date";
		$tabstruct['text']="text";
		$tabstruct['externallink']="link";


		$tabstruct['lang']="lang";

		$tabstruct['idauthor']="user";

		
		return $tabstruct;
	}

	


}

?>
