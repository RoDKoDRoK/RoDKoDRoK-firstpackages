<?php

/*
var disponibles :
$instanceConf->conf (array)
$db (classe)
$ajax (nom page ajax)
$instanceLang->lang (array)
$tpl (classe)
$droit (nom droit user)

other var : peuvent être changées pour la page courante
$maintemplate (ajax.tpl, rarement utile de créer un autre tpl)

func disponibles
$instanceMessage->set_message("message","alerte");
$includer->include_dbtableclass("dbtableclassname")
$includer->include_pratikclass("pratikclassname")
$instanceVar->varget("vargetname")
$instanceVar->varpost("varpostname")
$log->pushtolog("mylogmessage")
$log->pushtolog("mylogmessage","errorsource")
$log->pushtolog("mylogmessage","errorsource","myfileordbtabledestination")
$instanceDroit->hasAccessTo("elmttoaccess") (type page par defaut, elmttoaccess=id dans db or text like a pagename)
$instanceDroit->hasAccessTo("elmttoaccess","typeelmttoaccess")
$instanceDroit->redirectToErrorPage()

*/



$instanceAjax=new Error();


$coderesult=$instanceAjax->coderesult;
$this->tpl->remplir_template("coderesult",$coderesult);

$content=$instanceAjax->content_loader();
$this->tpl->remplir_template("content",$content);


?>