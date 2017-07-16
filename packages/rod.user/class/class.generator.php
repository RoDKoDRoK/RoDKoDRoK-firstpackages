<?php

class RodUserGenerator extends PackageGenerator
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
	}
	
	
	
	
	
	function prepareDataForTpl($instance="")
	{
		$data=array();
		
		$data=parent::prepareDataForTpl($instance);
		
		
		//add data specific
		
		//tablenom et classnom construct
		$tablenom=strtolower($data['confgenerator']['instancecour']['name']);
		$classnom=ucfirst($tablenom);
		$data['tablenom']=$tablenom;
		$data['classnom']=$classnom;
		
		
		//sqltype construct per column
		if(isset($data['confgenerator']['instancecour']['usercolumns']['column']))
		{
			if(isset($data['confgenerator']['instancecour']['usercolumns']['column'][0]))
			{
				foreach($data['confgenerator']['instancecour']['usercolumns']['column'] as $idcolumn=>$columncour)
				{
					$sqltypecour=$this->typeToSqltype($columncour['type']);
					$data['confgenerator']['instancecour']['usercolumns']['column'][$idcolumn]['sqltype']=$sqltypecour;
				}
			}
			else
			{
				$sqltypecour=$this->typeToSqltype($data['confgenerator']['instancecour']['usercolumns']['column']['type']);
				$data['confgenerator']['instancecour']['usercolumns']['column']['sqltype']=$sqltypecour;
			}
		}	
		
		
		if(isset($data['confgenerator']['instances']))
			foreach($data['confgenerator']['instances'] as $idinstance=>$instancecour)
			{
				if(isset($instancecour['usercolumns']['column']))
				{
					if(isset($instancecour['usercolumns']['column'][0]))
					{
						foreach($instancecour['usercolumns']['column'] as $idcolumn=>$columncour)
						{
							$sqltypecour=$this->typeToSqltype($columncour['type']);
							$data['confgenerator']['instances'][$idinstance]['usercolumns']['column'][$idcolumn]['sqltype']=$sqltypecour;
						}
					}
					else
					{
						$sqltypecour=$this->typeToSqltype($instancecour['usercolumns']['column']['type']);
						$data['confgenerator']['instances'][$idinstance]['usercolumns']['column']['sqltype']=$sqltypecour;
					}
				}
			}
		
		
		return $data;
	}
	
	
	
	function typeToSqltype($type)
	{
		$sqltype=$type;
		
		$type=strtolower($type);
		switch($type)
		{
			case "text":
				$sqltype="TEXT";
				break;
			case "varchar":
				$sqltype="VARCHAR(255)";
				break;
				
			default:
				$sqltype="VARCHAR(255)";
				break;
		}
		
		return $sqltype;
	}

}

?>
