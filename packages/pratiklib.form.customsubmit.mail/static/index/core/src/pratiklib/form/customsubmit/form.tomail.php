<?php

/*
var dispos:
$tabpost (array des valeur envoyées en POST)
$tabparam (array des params supplémentaires)

$preform (array du preform si besoin)

*/


//prepare contenu du mail
$dataprepared="";
foreach($tabpost as $idlineform=>$lineform)
{
	$dataprepared[]=array();
	$dataprepared[count($dataprepared)-1]['label']=$idlineform;
	$dataprepared[count($dataprepared)-1]['champs']=$lineform;
}


//action send mail
if($this->includer->include_pratikclass("mail"))
{
	$instanceMail=new PratikMail($this->initer);
	$data=array("objet"=>"Data saved","texte"=>"Data saved ! ","tabdata"=>$dataprepared);
	$instanceMail->construct_mail("custom",$data,"datamailcontent"); //,"mainmail");
	$resultsentmail=$instanceMail->send_mail($instanceMail->objet,array($_SESSION['mail_user']));
}


?>