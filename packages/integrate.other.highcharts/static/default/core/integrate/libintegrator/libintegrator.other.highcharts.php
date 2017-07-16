<?php

class LibIntegratorHighcharts extends LibIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function charg_highcharts()
	{
		$lib="";
		
		$lib.="<script src=\"core/integrate/lib/Highcharts-4.2.5/js/highcharts.js\"></script>";
		$lib.="<script src=\"core/integrate/lib/Highcharts-4.2.5/js/modules/exporting.js\"></script>";
		
		$lib.="<script src=\"core/integrate/lib/Highcharts-4.2.5/js/modules/data.js\"></script>";
		$lib.="<script src=\"core/integrate/lib/Highcharts-4.2.5/js/modules/drilldown.js\"></script>";
		
		return $lib;
	}

	
}



?>