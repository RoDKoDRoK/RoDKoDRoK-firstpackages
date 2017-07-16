<?php

class PratikEvent extends ClassIniter
{	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function getIniterPrerequis()
	{
		$prerequis=array();
		
		//$prerequis[]="db";
		
		return $prerequis;
	}
	
	
	function execEvent($eventtype="",$params=array())
	{
		$returned="";
		
		//prepare eventtype
		$eventtype=strtolower($eventtype);
		$eventtypeclass=ucfirst($eventtype);
		
		//params from db
		if(isset($this->includer) && $this->includer->include_pratikclass("Params"))
		{
			//$instanceParams=new PratikParams($this->initer);
			$instanceParams=$this->instanciator->newInstance("PratikParams",$this->initer);
			if($instanceParams)
			{
				$paramseventfromdb=$instanceParams->getParams($eventtype,"event");
				$params=array_merge($params,$paramseventfromdb);
			}
		}
		
		//exec eventintegrator selected with eventtype
		if(file_exists("core/integrate/event/eventintegrator.".$eventtype.".php"))
		{
			include_once "core/integrate/event/eventintegrator.".$eventtype.".php";
			eval("\$instanceEventIntegrator=new EventIntegrator".$eventtypeclass."(\$this->initer);");
			$instanceEventIntegrator->setNomcodeevent($eventtype);
			$returned=$instanceEventIntegrator->execEvent($params);
		}
		else if(file_exists("core/integrate/event/eventintegrator.php"))
		{
			include_once "core/integrate/event/eventintegrator.php";
			$instanceEventIntegrator=new EventIntegrator($this->initer);
			$instanceEventIntegrator->setNomcodeevent($eventtype);
			$returned=$instanceEventIntegrator->execEvent($params);
		}
		else
		{
			$this->log->puttolog("Class EventIntegrator manquante : core/integrate/event/eventintegrator.php");
		}
		
		return $returned;
	}
	
	
	
	function getTaskFromEvent($nomcodeevent="")
	{
		$tabevent=array();
		
		//dbfromfile
		$tabtmp=$this->genesisdbfromfile->join("inner", "", "event", "eventexectask", array("nomcodeevent"=>"nomcodeevent"));
		$tabtmp=$this->genesisdbfromfile->join("inner", "", $tabtmp, "task", array("nomcodetask"=>"nomcodetask"));
		$tabtmp=$this->genesisdbfromfile->where("", "nomcodeevent", $nomcodeevent, $tabtmp);
		$tabtmp=$this->genesisdbfromfile->orderby("ordre", $tabtmp);
		$tabevent=$tabtmp;
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			$tabevent=array();
			$req=$this->db->query("select * from `event`,`eventexectask`,`task` where `event`.nomcodeevent='".$nomcodeevent."' and `event`.nomcodeevent=`eventexectask`.nomcodeevent and `task`.nomcodetask=`eventexectask`.nomcodetask order by `eventexectask`.ordre asc");
			while($res=$this->db->fetch_array($req))
				$tabevent[]=$res;
		}
		
		return $tabevent;
	}
	
	
	
	function addTaskToEvent($nomcodetask,$nomcodeevent,$ordre="")
	{
		//prepare data
		$nomcodeevent=strtolower($nomcodeevent);
		$nomcodetask=strtolower($nomcodetask);
		
		//dbfromfile
		//cas ordre
		$sqlordre=false;
		if($ordre!="")
			$sqlordre=true;
		else
		{
			$ordre="0";
			
			$tabtmp=$this->genesisdbfromfile->where("", "nomcodeevent", $nomcodeevent, "eventexectask");
			$ordre=$this->genesisdbfromfile->max("ordre",$tabtmp);
			$ordre++;
		}
		
		//test doublons
		$tabtmp=$this->genesisdbfromfile->where("", "nomcodetask", $nomcodetask, "eventexectask");
		$tabtmp=$this->genesisdbfromfile->where("", "nomcodeevent", $nomcodeevent, $tabtmp);
		if($sqlordre)
			$tabtmp=$this->genesisdbfromfile->where("", "ordre", $ordre, $tabtmp);
		
		if(is_array($tabtmp) && count($tabtmp)>0)
			return;
		
		//insert
		$datacour=array();
		$datacour['ideventexectask']=$this->genesisdbfromfile->max("ideventexectask","eventexectask");
		$datacour['ideventexectask']++;
		$datacour['nomcodeevent']=$nomcodeevent;
		$datacour['nomcodetask']=$nomcodetask;
		$datacour['ordre']=$ordre;
		
		$this->genesisdbfromfile->insert("eventexectask",$datacour);
	
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			//cas ordre
			$sqlordre="";
			if($ordre!="")
				$sqlordre=" and ordre='".$ordre."'";
			else
			{
				$ordre="0";
				$req=$this->db->query("select max(ordre) as maxordre FROM `eventexectask` WHERE nomcodeevent='".$nomcodeevent."';");
				if($res=$this->db->fetch_array($req))
					$ordre=$res['maxordre']+1;
			}
			
			//test doublons
			$req=$this->db->query("select ideventexectask FROM `eventexectask` WHERE nomcodetask='".$nomcodetask."' and nomcodeevent='".$nomcodeevent."' ".$sqlordre.";");
			$res=$this->db->fetch_array($req);
			if($res)
				return;
			
			//insert
			$this->db->query("INSERT INTO `eventexectask` VALUES (NULL,'".$nomcodeevent."','".$nomcodetask."','".$ordre."');");
		}
	}
	
	
	
	function delTaskFromEvent($nomcodetask,$nomcodeevent,$ordre="")
	{
		//prepare data
		$nomcodeevent=strtolower($nomcodeevent);
		$nomcodetask=strtolower($nomcodetask);
		
		
		//dbfromfile
		//cas ordre
		$sqlordre=false;
		if($ordre!="")
			$sqlordre=true;
		
		//delete
		$tabtmp=$this->genesisdbfromfile->where("", "nomcodetask", $nomcodetask, "eventexectask");
		if($sqlordre)
			$tabtmp=$this->genesisdbfromfile->where("", "ordre", $ordre, $tabtmp);
		$index=$this->genesisdbfromfile->index("nomcodeevent",$nomcodeevent,$tabtmp,"ideventexectask");
		$this->genesisdbfromfile->delete("eventexectask", $index);
		
	
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			//cas ordre
			$sqlordre="";
			if($ordre!="")
				$sqlordre=" and ordre='".$ordre."'";
			
			//delete
			$this->db->query("delete from `eventexectask` where nomcodetask='".$nomcodetask."' and nomcodeevent='".$nomcodeevent."' ".$sqlordre.";");
		}
	}
	
	
	
	function addEvent($nomcodeevent,$nomevent="",$description="")
	{
		//prepare data
		$nomcodeevent=strtolower($nomcodeevent);
		
		
		//dbfromfile
		//check event already exists
		$idevent=$nomcodeevent;
		if(!is_numeric($idevent))
			$idevent=$this->genesisdbfromfile->index("nomcodeevent",$nomcodeevent,"event");
		if($idevent!="0")
		{
			//update not used
			/*
			$tabdata=array();
			$tabdata['nomevent']=$nomevent;
			$tabdata['description']=$description;
			
			$this->updateEvent($idevent,$tabdata);
			*/
		}
		else
		{
			//insert event
			$datacour=array();
			$datacour['idevent']=$this->genesisdbfromfile->max("idevent","event");
			$datacour['idevent']++;
			$datacour['nomcodeevent']=$nomcodeevent;
			$datacour['nomevent']=$nomevent;
			$datacour['description']=$description;
			
			$this->genesisdbfromfile->insert("event",$datacour);
			$idevent=$datacour['idevent']; //$this->genesisdbfromfile->count("","param");
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			//check event already exists
			$reqexists=$this->db->query("select * FROM `event` WHERE `event`.nomcodeevent='".$nomcodeevent."' or `event`.idevent='".$nomcodeevent."'");
			if($resexists=$this->db->fetch_array($reqexists))
			{
				$idevent=$resexists['idevent'];
				//update not used
				/*$req=$this->db->query("update `event` set 
											nomevent='".$nomevent."', 
											description='".$description."'
										where idevent='".$idevent."'
										");
				*/
			}
			else
			{
				$this->db->query("insert into `event` (idevent,nomcodeevent,nomevent,description) VALUES (NULL,'".$nomcodeevent."','".$nomevent."','".$description."')");
				$idevent=$this->db->last_insert_id();
			}
		}
		
		return $idevent;
	}
	
	
	function updateEvent($nomcodeevent,$tabupdate=array())
	{
		if(!is_array($tabupdate) || (is_array($tabupdate) && count($tabupdate)==0))
			return;
		
		
		//dbfromfile
		//check idevent to update
		$idevent="0";
		if(is_numeric($nomcodeevent))
		{
			$idevent=$nomcodeevent;
		}
		else
		{
			//prepare data
			$nomcodeevent=strtolower($nomcodeevent);
			
			//load event id
			$idevent=$this->genesisdbfromfile->index("nomcodeevent",$nomcodeevent,"event");
		}
		
		//update
		//prepare data
		$datacour=$tabupdate;
		
		//update event
		$this->genesisdbfromfile->update("event",$idevent,$datacour);
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			//check idevent to update
			$idevent="0";
			if(is_numeric($nomcodeevent))
			{
				$idevent=$nomcodeevent;
			}
			else
			{
				//prepare data
				$nomcodeevent=strtolower($nomcodeevent);
				
				//load event id
				$reqevent=$this->db->query("select * FROM `event` WHERE `event`.nomcodeevent='".$nomcodeevent."'");
				if($resevent=$this->db->fetch_array($reqevent))
					$idevent=$resevent['idevent'];
			}
			
			//prepare update
			$update="";
			foreach($tabupdate as $idtab=>$valuetab)
			{
				$update.=$idtab."='".$valuetab."' , ";
			}
			$update=substr($update,0,-2);
			
			//update
			$this->db->query("update `event` set 
											".$update." 
										where idevent='".$idevent."'
										");
			
		}
		
	} 
	
	
	function delEvent($nomcodeevent="")
	{
		//prepare data
		$nomcodeevent=strtolower($nomcodeevent);
		
		
		//dbfromfile
		if(is_numeric($nomcodeevent))
		{
			//delete with id
			$this->genesisdbfromfile->delete("event", $nomcodeevent);
		}
		else
		{
			//delete with codename
			$index=$this->genesisdbfromfile->index("nomcodeevent",$nomcodeevent,"event");
			$this->genesisdbfromfile->delete("event", $index);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			//delete
			$this->db->query("delete from `event` where (idevent='".$nomcodeevent."' or nomcodeevent='".$nomcodeevent."')");
		}
	}
	
	
}


?>