<?php

class PackageManager extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="<div class='paragraphe'>";
		$content.=$this->instanceLang->getTranslation("Deploy or destroy packages there. <i>Download and Deploy</i> button instantly starts downloading the package before asking you to deploy it. Some packages are slower than others.");
		$content.="</div>";
		
		return $content;
	}
	
	function data_loader()
	{
		$data=array();
		
		//select packages from db
		$req=$this->db->query("select * from `package` order by nomcodepackage");
		while($res=$this->db->fetch_array($req))
		{
			$data[]=$res;
			$data[count($data)-1]['codename']=$res['nomcodepackage'];
			$data[count($data)-1]['codenamewithspace']=str_replace(".",". ",$res['nomcodepackage']);
			
			//todownload
			$data[count($data)-1]['todownload']="0";
			if(!is_dir("package/".$res['nomcodepackage']))
				$data[count($data)-1]['todownload']="1";
			
			//depends
			$data[count($data)-1]['depend']="";
			$reqdepend=$this->db->query("select * from `package_depends_on` where nomcodepackage='".$res['nomcodepackage']."'");
			while($resdepend=$this->db->fetch_array($reqdepend))
			{
				$data[count($data)-1]['depend'].=$resdepend['nomcodedepend']." ";
			}
			
			//locked by other depend
			$data[count($data)-1]['lockedbyotherdepend']="0";
			$reqdepend=$this->db->query("select * from `package_depends_on`,`package` where `package_depends_on`.nomcodedepend='".$res['nomcodepackage']."' and `package`.nomcodepackage=`package_depends_on`.nomcodepackage and `package`.deployed='1'");
			while($resdepend=$this->db->fetch_array($reqdepend))
			{
				$data[count($data)-1]['lockedbyotherdepend']="1";
			}
		}
	
		return $data;
	}
	
	
	function form_loader()
	{
		//generate the same form for each package
		$preform=array();
		
		$preform['deploybutton']=true;
		$preform['downloadanddeploybutton']=true;
		$preform['destroybutton']=true;
		$preform['updatebutton']=true;
		$preform['checkupdatebutton']=true;
		
		
		$params=array();
		
		$form=array();
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform,$params);
		}
	
		return $form;
	}
	
	
	
	function check_new_package()
	{
		//downloader init
		$downloader=null;
		if($this->includer->include_pratikclass("Downloader"))
			$downloader=new PratikDownloader($this->initer);
		
		
		//vérifie si de nouveaux packages sont disponibles dans le dossier package et les ajoute à la bd
		
		
		$tabpackagefromdb=array();
		$tabdatapackagefromdb=$this->data_loader();
		
		//prepare tab from db et test db result has a folder
		if($tabdatapackagefromdb)
			foreach($tabdatapackagefromdb as $datapackagefromdb)
			{
				$packagecour=$tabpackagefromdb[]=$datapackagefromdb['nomcodepackage'];
				
				
				//test db result has folder
				if(!is_dir("package/".$packagecour) && ($downloader==null || $downloader->getFileLink($packagecour.".zip","packages")==""))
				{
					//suppr de la db
					$this->db->query("delete from `package` where nomcodepackage='".$packagecour."'");
					
					$this->db->query("delete from `package_depends_on` where nomcodepackage='".$packagecour."' or nomcodedepend='".$packagecour."'");
				}
			}
		
		
		
		$tabpackagefromfolder=array();
		$tabcheminpackagefromfolder=$this->loader->charg_dossier_unique_dans_tab("package",true);
		
		//prepare tab from folder
		if($tabcheminpackagefromfolder)
			foreach($tabcheminpackagefromfolder as $packagecour)
			{
				if(!is_dir($packagecour))
					continue;
				
				$packagecour=str_replace("package/","",$packagecour);
				$tabpackagefromfolder[]=$packagecour;
			}
		
		//test folder is in db
		foreach($tabpackagefromfolder as $packagecour)
		{
			//test folder is in db
			if(array_search($packagecour,$tabpackagefromdb)===false)
			{
				$descripter=array();
				$descripter['name']="";
				$descripter['description']="";
				$descripter['version']="";
				$descripter['groupe']="";
				
				if(file_exists("package/".$packagecour."/package.descripter.php"))
					include "package/".$packagecour."/package.descripter.php";
				
				//check package is deployed
				$deployed=0;
				if(file_exists("core/files/tmp/log/packageloaded/".$packagecour.".loaded.log"))
					$deployed=1;
				
				//chack package is locked in first deployer (to lock it later for example)
				$indeployer=0;
				if(file_exists("deploy/package.chain.deploy.php"))
				{
					include "deploy/package.chain.deploy.php";
					if($tabpackagetodeploy)
						foreach($tabpackagetodeploy as $packagefirstdeployment)
						{
							if($packagefirstdeployment['name']==$packagecour)
								if(isset($packagefirstdeployment['locked']) && $packagefirstdeployment['locked'])
									$indeployer=1;
								else
									break;
							if($indeployer)
								break;
						}
				}
				
				//set package to update
				$toupdate="0";
				
				
				//ajout dans la db
				$descripter=$this->db->encode($descripter);
				$this->db->query("insert into `package` (`idpackage`, `nomcodepackage`, `nompackage`, `groupepackage`, `description`, `version`, `indeployer`, `deployed`, `toupdate`) values (NULL,'".$packagecour."','".$descripter['name']."','".$descripter['groupe']."','".$descripter['description']."','".$descripter['version']."','".$indeployer."','".$deployed."','".$toupdate."')");
				
				//ajout des dependances
				if(isset($descripter['depend']) && is_array($descripter['depend']))
					foreach($descripter['depend'] as $dependcour)
						if($dependcour!="")
							$this->db->query("insert into `package_depends_on` (`nomcodepackage`, `nomcodedepend`) values ('".$packagecour."','".$dependcour."')");
				
			}
			
		}
		
		
		
		$tabpackagefromsrclinks=array();
		$tabcheminpackagefromsrclinks=array();
		for($cptsrclink=0;$cptsrclink<count($downloader->getTabSrcLink());$cptsrclink++)
		{
			$tabtmp=$this->loader->charg_url_unique_dans_tab($downloader->getSrcLink($cptsrclink)."/packages/");
			$tabcheminpackagefromsrclinks=array_merge($tabcheminpackagefromsrclinks,$tabtmp);
		}
		//print_r($tabcheminpackagefromsrclinks);
		
		//prepare tab from srclinks
		if($tabcheminpackagefromsrclinks)
			foreach($tabcheminpackagefromsrclinks as $packagecour)
			{
				//$packagecour=substr($packagecour,(strrpos($packagecour,"/")));
				$packagecour=str_replace(".zip","",$packagecour);
				
				if(!is_dir("package/".$packagecour))
					$tabpackagefromsrclinks[]=$packagecour;
			}
		
		//test folder is in db
		foreach($tabpackagefromsrclinks as $packagecour)
		{
			//test folder is in db
			if(array_search($packagecour,$tabpackagefromdb)===false)
			{
				//check package is deployed
				$deployed=0;
				
				//chack package is locked in first deployer (to lock it later for example)
				$indeployer=0;
				
				//ajout dans la db
				$this->db->query("insert into `package` (`idpackage`, `nomcodepackage`, `indeployer`, `deployed`) values (NULL,'".$packagecour."','".$indeployer."','".$deployed."')");
				
			}
			
		}
	}
	
	
	
	function form_submiter()
	{
		$submitreturn="";
	
		$packagecodename=$this->instanceVar->varpost("codename");
		
		$this->includer->include_pratikclass("Package");
		$instancePackage=new PratikPackage($this->initer);
	
		if($this->instanceVar->varpost("deploysubmit"))
		{
			$instancePackage->deploy($packagecodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Deploiement effectue"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		else if($this->instanceVar->varpost("destroysubmit"))
		{
			$instancePackage->destroy($packagecodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Destruction effectuee"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		else if($this->instanceVar->varpost("updatesubmit"))
		{
			$instancePackage->update($packagecodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Mise a jour effectuee"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		else if($this->instanceVar->varpost("checkupdatesubmit"))
		{
			$tabpackages=$this->data_loader();
			foreach($tabpackages as $packagecour)
			{
				$packagecodename=$packagecour['nomcodepackage'];
				$toupdate=0;
				if($instancePackage->checkUpdate($packagecodename))
					$toupdate=1;
				$this->db->query("update `package` set toupdate='".$toupdate."' where nomcodepackage='".$packagecodename."'");
			}
			
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Les dernieres mises a jours disponibles sont visibles"));
			
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