<?php

class PratikView extends ClassIniter
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function viewconverter($tabstruct=array(),$data=array())
	{
		$datatmp=array();
		
		//convert data to formate data to print with tpl
		foreach($data as $dataline)
		{
			$tabtmp=array();
			
			foreach($dataline as $idcolonne=>$contentcolonne)
			{
				$tabtmp[$idcolonne]=$contentcolonne;
				
				$typedata="text";
				if(isset($tabstruct[$idcolonne]))
				{
					$typedata=$tabstruct[$idcolonne];
				
					$instanceTpl=new Tp($this->conf,$this->log);
					$tpl=$instanceTpl->tpselected;
					
					//load arkitect data
					$tpl->remplir_template("arkitectoutput",$this->arkitectoutput);
					
					//load css and js for view
					$tpl->remplir_template("css",$this->getCssView($typedata));
					$tpl->remplir_template("js",$this->getJsView($typedata));
					
					//view selected
					$tpl->remplir_template("view",$typedata);
					
					//custom code to prepare champ viewed
					if(file_exists($this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.customview")."/champs.".$typedata.".php"))
						include $this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.customview")."/champs.".$typedata.".php";
						
					$tpl->remplir_template("brutdata",$contentcolonne);
					
					$tabtmp[$idcolonne]=$contentcolonne;
					if(file_exists($this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.template")."/champs.".$typedata.".php"))
						$tabtmp[$idcolonne]=$tpl->get_template($this->arkitect->get("pratiklib.view")."/view.tpl");
				}
				
			}
			
			$datatmp[]=$tabtmp;
		}
		
		return $datatmp;
	}
	
	
	
	//get css and js
	function getCssView($nomcodeview="")
	{
		$css="";
		
		if(file_exists($this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.css")."/champs.".$nomcodeview.".css"))
			$css.="<link rel=\"stylesheet\" href=\"".$this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.css")."/champs.".$nomcodeview.".css\" type=\"text/css\" />\n";
		
		//surcharge de la css possible dans le design
		if(file_exists("core/design/pratik/view/champs.".$nomcodeview.".css"))
			$css.="<link rel=\"stylesheet\" href=\"core/design/pratik/view/champs.".$nomcodeview.".css\" type=\"text/css\" />\n";
		
		return $css;
	}
	
	function getJsView($nomcodeview="")
	{
		$js="";
		
		if(file_exists($this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.js")."/champs.".$nomcodeview.".js"))
			$js.="<script src=\"".$this->arkitect->get("pratiklib.view").$this->arkitect->get("ext.pratikview.js")."/champs.".$nomcodeview.".js\"></script>\n";
		
		return $js;
	}
	

}


?>