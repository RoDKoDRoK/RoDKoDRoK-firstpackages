<?php

class PratikMirrorData extends Mirror
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function movePackageFromLocalDevToMirror($packagecodename,$mirrordest,$distantpathdest="",$force=true,$archive=true)
	{
		$pathtomirrordest=$this->getMirrorLink($mirrordest,$distantpathdest);
		if($archive)
		{
			//archivage du package distant
			
		}
		
		if($force)
		{
			//destruction du package distant
			
		}
		
		if(!file_exists($pathtomirrordest.$packagecodename.$this->instanceConf->get('extpackage')))
		{
			//envoi du package
			if($distantpathdest=="")
			{
				
			}
			else
			{
				
			}
		}
	}
	
	
	function movePackageFromMirrorToMirror($packagecodename,$mirrorsrc,$distantpathsrc="",$mirrordest,$distantpathdest="",$force=false,$archive=false)
	{
		if(isset($this->db) && $this->db)
		{
			$this->db->query("update `package` set localdev='".$localdev."' where nomcodepackage='".$packagecodename."'");
			return true;
		}
		
		return false;
	}
	
	
	function movePackageFromMirrorToRKRAirlock($packagecodename,$mirrorsrc,$distantpathsrc="")
	{
		if(isset($this->db) && $this->db)
		{
			$this->db->query("update `package` set localdev='".$localdev."' where nomcodepackage='".$packagecodename."'");
			return true;
		}
		
		return false;
	}
	
	
	
}


?>