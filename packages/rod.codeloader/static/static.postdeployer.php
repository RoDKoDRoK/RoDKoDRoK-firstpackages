<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout du codesrc dans la db
if(isset($this->includer) && $this->includer->include_pratikclass("codesrc"))
{
	$instanceCodeSrc=new PratikCodesrc($this->initer);
	
	//codesrc
	$instanceCodeSrc->addCodeSrc('class.php','class.php','class.php','phpclass');
	$instanceCodeSrc->addCodeSrcToChain('class.php','all','1');
	
}


?>