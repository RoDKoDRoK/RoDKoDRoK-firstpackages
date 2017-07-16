<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//init menus
$instanceMenu=null;
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
	$instanceMenu=new PratikMenu($this->initer);


foreach($this->confgenerator->instance as $instance)
{
	//ajout des droits
	if(isset($this->instanceDroit))
	{
		//droit des pages
		$tabfilestoload=$this->loader->charg_dossier_dans_tab("package/rod.dbmaker/generator/index/core/dev/page");
		if(isset($tabfilestoload))
			foreach($tabfilestoload as $filecour)
			{
				$file=substr($filecour,strrpos($filecour,"/"),strlen($filecour)-4-strrpos($filecour,"/"));
				$file=substr($file,1,-4);
				$elmtcour=str_replace("__INSTANCE__",$instance->name,$file);
				
				//recup du droit
				$droitcour=$instance->droits->edit;
				if(strstr($elmtcour,"form")===false)
					$droitcour=$instance->droits->view;
				
				$this->instanceDroit->removeGrantTo($elmtcour,"page",$droitcour);
				
				if($instanceMenu && $instance->type!="link")
				{
					//test page avec menu
					if(strstr($elmtcour,"list")===false)
						continue;
					
					$instanceMenu->deleteMenu($elmtcour);
					$this->instanceDroit->removeGrantTo($elmtcour,'menu',$instance->droits->view);
				}
			}
		
		//droit des ws
		$tabfilestoload=$this->loader->charg_dossier_dans_tab("package/rod.dbmaker/generator/ws/core/ws/flux");
		if(isset($tabfilestoload))
			foreach($tabfilestoload as $filecour)
			{
				$file=substr($filecour,strrpos($filecour,"/"),strlen($filecour)-4-strrpos($filecour,"/"));
				$file=substr($file,1,-4);
				$elmtcour=str_replace("__INSTANCE__",$instance->name,$file);
				
				//recup du droit
				$droitcour=$instance->droits->wsedit;
				if(strstr($elmtcour,"action")===false)
					$droitcour=$instance->droits->wsview;
					
				$this->instanceDroit->removeGrantTo($elmtcour,"ws",$droitcour);
				
			}
	}

}

?>