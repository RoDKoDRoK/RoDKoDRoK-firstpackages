<?php

class PratikPackager extends ClassIniter
{
	var $folderdestdownload="core/files/packagezip/";
	var $folderdestarchives="core/files/packageziparchived/";
	var $folderdestpackage="package/";
	
	var $folderdestprivatemirror="private-mirror-1/";
	var $folderdestlocalmirror="local-mirror-1/";
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function pack($packagecodename="example")
	{
		//pack package
		$this->initer['packagecodename']=$packagecodename;
		$classpackagename="";
		$tabclassname=explode(".",$packagecodename);
		foreach($tabclassname as $classnamecour)
			$classpackagename.=ucfirst(strtolower($classnamecour));
		
		
		if(file_exists("package/".$packagecodename))
		{
			//zip and archives current package in $folderdestarchives
			
			//kill package in $folderdestpackage
		}
		
		//create package in $folderdestpackage
		  //make descripter file
		  //put elmt (with drivers elmt)
		  //copy files to static different chains
		  //make db file with tables
		  
		
		//del old zip in $folderdestdownload
		
		//zip package in $folderdestdownload
		
		//del old zip in $folderdestprivatemirror
		
		//copy zip in $folderdestprivatemirror
		
		
		return array();
	}
	
	
	
	
	
	
	
	
	function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir"){
				$this->rrmdir($dir."/".$object);
			 }else{ 
				unlink($dir."/".$object);
			 }
		   }
		 }
		 reset($objects);
		 rmdir($dir);
	  }
	}
	
	
	
	
	function unzipPackage($packagecodename="example")
	{
		$folderzip=$this->folderdestdownload;
		$folderdestunzip=$this->folderdestpackage;
		$filename=$packagecodename.".zip";
		
		if(file_exists($folderzip.$filename))
		{
			//unzip
			$zip = new ZipArchive;
			$res = $zip->open($folderzip.$filename);
			if ($res === TRUE) {
				$zip->extractTo($folderdestunzip);
				$zip->close();
				return true;
			}
			
		}
		
		return false;
	}
	
	
	
	function zipAndArchivePackage($packagecodename="example")
	{
		$folderpackage=$this->folderdestpackage;
		$folderdestzipandarchive=$this->folderdestarchives;
		$filename=date("YmdHis_____").$packagecodename.".zip";
		
		if(file_exists($folderpackage.$packagecodename))
		{
			//zip
			
			// Get real path for our folder
			$rootPath = realpath($folderpackage.$packagecodename);

			// Initialize archive object
			$zip = new ZipArchive();
			$zip->open($folderdestzipandarchive.$filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			// Create recursive directory iterator
			/** @var SplFileInfo[] $files */
			$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($rootPath),
				RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($files as $name => $file)
			{
				// Skip directories (they would be added automatically)
				if (!$file->isDir())
				{
					// Get real and relative path for current file
					$filePath = $file->getRealPath();
					$relativePath = substr($filePath, strlen($rootPath) + 1);

					// Add current file to archive
					$zip->addFile($filePath, $relativePath);
				}
			}

			// Zip archive will be created only after closing object
			$zip->close();
			
			return true;
		}
		
		return false;
	}
	
	
	
	function getExtSql()
	{
		$sqltype="sql";
		
		if(isset($this->conf['maindb']['moteurbd']))
		{
			switch($this->conf['maindb']['moteurbd'])
			{
				case "Mysql":
					$sqltype="sql";
				break;
				
				default:
					$sqltype="sql";
				break;
			}
		}
		
		return $sqltype;
	}
	
	
	
	function checkDependAreDeployedForPackage($packagecodename="example")
	{
		//check depend are deployed
		$reqdepend=$this->db->query("select * from `package` where deployed='0' and nomcodepackage in (select nomcodedepend from `package_depends_on` where nomcodepackage='".$packagecodename."')");
		if($resdepend=$this->db->fetch_array($reqdepend))
			return false;
		
		return true;
	}
	
	
}


?>