<?php

class Lang
{
	var $lang;

	function __construct($lang="fr_fr",$cron="error")
	{
		$this->lang=$this->charg_lang($lang,$cron);
		
	}


	function charg_lang($lang="fr_fr",$cron="error")
	{
		$translate_datas=array();
	
		//récup du chemin des main trad
		$chemin="lang/".$lang.".xml";
		
		//chargement du xml
		if(file_exists($chemin))
		{
			$parser = simplexml_load_file($chemin) ;
			
			foreach($parser as $key=>$value){
				$translate_datas[$key] = $this->load_string_from_xml($value);
			}
		}
		
		//récup du chemin des page trad
		$chemin="lang/cron_".$cron."_".$lang.".xml";
		
		//chargement du xml
		if(file_exists($chemin))
		{
			$parser = simplexml_load_file($chemin) ;
			
			foreach($parser as $key=>$value){
				$translate_datas[$key] = $this->load_string_from_xml($value);
			}
		}
		
		
		return $translate_datas;
	}
	
	
	
	
	//chargement d'une chaine depuis un xml
	function load_string_from_xml($chaine)
	{

		return utf8_decode(str_replace('@@@','\n',eval("return \"".str_replace('\n','@@@',str_replace('"','&quot;',(string)$chaine)."\";"))));
	}
	
	
	//renvoie la chaine traduite (à utiliser dans vos pages)
	function getTranslation($text="")
	{
		$textwithunderscores=str_replace(" ","_",$text);
		if(isset($this->lang[$textwithunderscores]))
			return $this->lang[$textwithunderscores];
		return $text;
	}
	
	
}


?>