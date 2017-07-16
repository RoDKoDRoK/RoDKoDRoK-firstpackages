<?php

class Lib extends ClassIniter
{
	
	var $returned;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		$this->returned=$this->charg_lib();
		//$this->returned.=$this->charg_lib_old();
	}
	
	
	function charg_lib()
	{
		$lib="";
		
		$chaincour=$this->chainconnector;
		
		
		//load lib
		$req=$this->db->query("select * FROM `lib`, `chainuselib`, `libtype`, `chain` 
							WHERE `lib`.idlib=`chainuselib`.idlib and 
								`lib`.idlibtype=`libtype`.idlibtype and 
								`chainuselib`.idchain=`chain`.idchain and 
								`chain`.nomcodechain='".$chaincour."'  
								order by ordre");
		while($res=$this->db->fetch_array($req))
		{
			//chargement des libs
			$typemoteurlowercase=strtolower($res['nomcodelibtype']);
			$moteurlowercase=strtolower($res['nomcodelib']);
			if(file_exists("core/integrate/libintegrator/libintegrator.".$typemoteurlowercase.".".$moteurlowercase.".php"))
			{
				if($res['uniquelib']=='0' || ($res['uniquelib']=='1' && strtolower($this->instanceConf->get("moteur".$res['nomcodelibtype']))==$moteurlowercase))
				{
					$moteurclass=ucfirst($moteurlowercase); 
					
					include_once "core/integrate/libintegrator/libintegrator.".$typemoteurlowercase.".".$moteurlowercase.".php";
					eval("\$instanceLibIntegrator=new LibIntegrator".$moteurclass."(\$this->initer);");
					eval("\$lib.=\$instanceLibIntegrator->charg_".$moteurlowercase."();");
				}
			}
			else
			{
				//cas lib uniquelib, chargement de la lib par defaut
				if($res['uniquelib']=='1')
				{
					$reqdefaultlib=$this->db->query("select * FROM `lib` WHERE `lib`.idlib='".$res['iddefaultlib']."'");
					if($resdefaultlib=$this->db->fetch_array($reqdefaultlib))
					{
						$typemoteurlowercase=strtolower($resdefaultlib['nomcodelibtype']);
						$moteurlowercase=strtolower($resdefaultlib['nomcodelib']);
						if(file_exists("core/integrate/libintegrator/libintegrator.".$typemoteurlowercase.".".$moteurlowercase.".php"))
						{
							$moteurclass=ucfirst($moteurlowercase);
							
							include_once "core/integrate/libintegrator/libintegrator.".$typemoteurlowercase.".".$moteurlowercase.".php";
							eval("\$instanceLibIntegrator=new LibIntegrator".$moteurclass."(\$this->initer);");
							eval("\$lib.=\$instanceLibIntegrator->charg_".$moteurlowercase."();");
						}
					}
				}
				//log erreur
				$this->log->pushtolog("Echec du chargement de la lib ".$typemoteurlowercase.".".$moteurlowercase.". Verifier la présence des fichiers ou la configuration.");
			}
		}
		
		
		return $lib;
	}
	
	
	
	function addLib($nomcodelib,$nomlib="",$descriptionlib="",$nomcodelibtype="",$nomlibtype="",$descriptionlibtype="",$uniquelib="0",$defaultlib="")
	{
		//check libtype
		$idlibtype=$this->addLibType($nomcodelibtype,$nomlibtype,$descriptionlibtype,$uniquelib,$defaultlib);
		
		//check lib already exists
		$reqexists=$this->db->query("select * FROM `lib` WHERE `lib`.nomcodelib='".$nomcodelib."' or `lib`.idlib='".$nomcodelib."'");
		if($resexists=$this->db->fetch_array($reqexists))
		{
			$idlib=$resexists['idlib'];
			//update not used
			/*$this->db->query("update `lib` set 
										nomlib='".$nomlib."', 
										description='".$descriptionlib."'
									where idlib='".$idlib."'
									");
			*/
		}
		else
		{
			$this->db->query("insert into `lib` (idlib,nomcodelib,nomlib,description,idlibtype) VALUES (NULL,'".$nomcodelib."','".$nomlib."','".$descriptionlib."','".$idlibtype."')");
			$idlib=$this->db->last_insert_id();
		}
		
		//update libtype pour defaultlib (cas self default lib)
		$tabupdate['defaultlib']=$defaultlib;
		$this->updateLibType($nomcodelibtype,$tabupdate);
		
		return $idlib;
		
	}
	
	
	function delLib($nomcodelib="")
	{
		//delete
		$this->db->query("delete from `lib` where (idlib='".$nomcodelib."' or nomcodelib='".$nomcodelib."')");
		
	}
	
	
	
	function addLibType($nomcodelibtype,$nomlibtype="",$description="",$uniquelib="0",$defaultlib="")
	{
		$iddefaultlib="0";
		if(is_numeric($defaultlib))
		{
			$iddefaultlib=$defaultlib;
		}
		else
		{
			//load default lib id
			$reqdefaultlib=$this->db->query("select * FROM `lib` WHERE `lib`.nomcodelib='".$defaultlib."'");
			if($resdefaultlib=$this->db->fetch_array($reqdefaultlib))
				$iddefaultlib=$resdefaultlib['idlib'];
		}
		
		//check lib type already exists
		$reqexists=$this->db->query("select * FROM `libtype` WHERE `libtype`.nomcodelibtype='".$nomcodelibtype."' or `libtype`.idlibtype='".$nomcodelibtype."'");
		if($resexists=$this->db->fetch_array($reqexists))
		{
			$idlibtype=$resexists['idlibtype'];
			//update not used
			/*$req=$this->db->query("update `libtype` set 
										nomlibtype='".$nomlibtype."', 
										description='".$description."', 
										uniquelib='".$uniquelib."', 
										iddefaultlib='".$iddefaultlib."' 
									where idlibtype='".$idlibtype."'
									");
			$res=$this->db->fetch_array($req);*/
		}
		else
		{
			$this->db->query("insert into `libtype` (idlibtype,nomcodelibtype,nomlibtype,description,uniquelib,iddefaultlib) VALUES (NULL,'".$nomcodelibtype."','".$nomlibtype."','".$description."','".$uniquelib."','".$iddefaultlib."')");
			$idlibtype=$this->db->last_insert_id();
		}
		
		return $idlibtype;
	}
	
	
	function updateLibType($nomcodelibtype,$tabupdate=array())
	{
		if(is_array($tabupdate) && count($tabupdate)==0)
			return;
		
		//check idlibtype to update
		$idlibtype="0";
		if(is_numeric($nomcodelibtype))
		{
			$idlibtype=$nomcodelibtype;
		}
		else
		{
			//load default lib id
			$reqlib=$this->db->query("select * FROM `libtype` WHERE `libtype`.nomcodelibtype='".$nomcodelibtype."'");
			if($reslib=$this->db->fetch_array($reqlib))
				$idlibtype=$reslib['idlibtype'];
		}
		
		//cas defaultlib
		if(isset($tabupdate['defaultlib']))
		{
			$tabupdate['iddefaultlib']="0";
			if(is_numeric($tabupdate['defaultlib']))
			{
				$tabupdate['iddefaultlib']=$tabupdate['defaultlib'];
			}
			else
			{
				//load default lib id
				$reqdefaultlib=$this->db->query("select * FROM `lib` WHERE `lib`.nomcodelib='".$tabupdate['defaultlib']."'");
				if($resdefaultlib=$this->db->fetch_array($reqdefaultlib))
					$tabupdate['iddefaultlib']=$resdefaultlib['idlib'];
			}
			unset($tabupdate['defaultlib']);
		}
		
		//prepare update
		$update="";
		foreach($tabupdate as $idtab=>$valuetab)
		{
			$update.=$idtab."='".$valuetab."' , ";
		}
		$update=substr($update,0,-2);
		
		//update
		$this->db->query("update `libtype` set 
										".$update." 
									where idlibtype='".$idlibtype."'
									");
		
	}
	
	
	function delLibType($nomcodelibtype="")
	{
		//delete
		$this->db->query("update `libtype` set idlibtype='1' where (idlibtype='".$nomcodelibtype."' or nomcodelibtype='".$nomcodelibtype."')");
		$this->db->query("delete from `libtype` where (idlibtype='".$nomcodelibtype."' or nomcodelibtype='".$nomcodelibtype."')");
	}
	
	
	
	function addLibToChain($nomcodelib,$tabnomcodechain="all",$ordre="0")
	{
		//check and prepare tabnomcodechain
		if($tabnomcodechain=="none")
			return true;
		
		$tabidchain=array();
		if($tabnomcodechain=="all")
		{
			$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain!='default'");
			while($reschain=$this->db->fetch_array($reqchain))
				$tabidchain[]=$reschain['idchain'];
			
		}
		else if(is_array($tabnomcodechain))
		{
			foreach($tabnomcodechain as $nomcodechaincour)
			{
				$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$nomcodechaincour."'");
				if($reschain=$this->db->fetch_array($reqchain))
					$tabidchain[]=$reschain['idchain'];
			}
		}
		else
		{
			$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$nomcodechaincour."'");
			if($reschain=$this->db->fetch_array($reqchain))
				$tabidchain[]=$reschain['idchain'];
		}
		
		//get idlib
		$idlib="0";
		if(is_numeric($nomcodelib))
		{
			$idlib=$nomcodelib;
		}
		else
		{
			//load lib id
			$reqlib=$this->db->query("select * FROM `lib` WHERE `lib`.nomcodelib='".$nomcodelib."'");
			if($reslib=$this->db->fetch_array($reqlib))
				$idlib=$reslib['idlib'];
		}
		
		//insert chainuselib
		if(count($tabidchain)>0)
			foreach($tabidchain as $idchaincour)
			{
				//chack doublons avant insert
				$reqlib=$this->db->query("select * FROM `chainuselib` WHERE `chainuselib`.idlib='".$idlib."' and `chainuselib`.idchain='".$idchaincour."'");
				if($reslib=$this->db->fetch_array($reqlib))
					continue;
				
				//insert
				$this->db->query("insert into `chainuselib` (idchainuselib,idchain,idlib,ordre) VALUES (NULL,'".$idchaincour."','".$idlib."','".$ordre."')");
			}
		
		return true;
		
	}
	
	
	function delLibFromChain($nomcodelib="",$nomcodechain="all")
	{
		//TODO...prise en compte $nomcodechain
		
		//delete
		$this->db->query("delete from `chainuselib` where (idlib='".$nomcodelib."' or nomcodelib='".$nomcodelib."')");
		
	}
	

	
	
}



?>