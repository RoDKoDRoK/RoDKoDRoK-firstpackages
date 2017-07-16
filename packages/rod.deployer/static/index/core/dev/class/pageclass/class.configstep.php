<?php

class DeployStep extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="<div class='paragraphe'>";
		$content.=$this->instanceLang->getTranslation("Execute deployer here. A deployer is a list of packages to be deployed step by step.");
		$content.="</div>";
		
		return $content;
	}
	
	function data_loader()
	{
		$data=array();
		
		//select packages from db
		$req=$this->db->query("select * from `deployer` order by nomcodedeployer");
		while($res=$this->db->fetch_array($req))
		{
			$data[]=$res;
			$data[count($data)-1]['codename']=$res['nomcodedeployer'];
			$data[count($data)-1]['codenamewithspace']=str_replace(".",". ",$res['nomcodedeployer']);
		}
	
		return $data;
	}
	
	
	function form_loader()
	{
		//generate the same form for each package
		$preform=array();
		
		$preform['deploybutton']=true;
		$preform['destroybutton']=true;
		
		
		$params=array();
		
		$form=array();
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform,$params);
		}
	
		return $form;
	}
	
	
	
	function form_submiter()
	{
		$submitreturn="";
	
		$deployercodename=$this->instanceVar->varpost("codename");
		
		$this->includer->include_pratikclass("Deployer");
		$instanceDeployer=new PratikDeployer($this->initer);
	
		if($this->instanceVar->varpost("deploysubmit"))
		{
			$instanceDeployer->deployInChain($deployercodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Deploiement effectue"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		else if($this->instanceVar->varpost("destroysubmit"))
		{
			$instanceDeployer->destroyInChain($deployercodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Destruction effectuee"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		
		return $submitreturn;
	}


}


?>