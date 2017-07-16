<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//sync codesrc genesis avec db créé
//... TODO !!!

//en attendant sync... A DETRUIRE APRES SYNC DONE OK
if(isset($this->includer) && $this->includer->include_pratikclass("codesrc"))
{
	$instanceCodeSrc=new PratikCodesrc($this->initer);
	
	//codesrc
	$instanceCodeSrc->addCodeSrc('class.php','class.php','class.php','phpclass');
	$instanceCodeSrc->addCodeSrcToChain('class.php','all','1');
	$instanceCodeSrc->addCodeSrcToChain('class.php','all','2');
	
}


?>