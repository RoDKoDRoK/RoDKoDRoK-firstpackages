<?php


//list des connector to call dans l'ordre
$tabconnector=array();


//connector arkitectoutput
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="arkitectoutput";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-self-var";
$tabconnector[count($tabconnector)-1]['name']="arkitectoutput";


//connector codeloader (for class core)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['outputaction']="none";
$tabconnector[count($tabconnector)-1]['name']="codeloader";


//connector conf
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="conf";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-self-var";
$tabconnector[count($tabconnector)-1]['name']="conf";


//connector instanciatorextended
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="instanciator";
$tabconnector[count($tabconnector)-1]['outputaction']="none";
$tabconnector[count($tabconnector)-1]['name']="instanciatorextended";



//connector db
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="db";
$tabconnector[count($tabconnector)-1]['name']="db";


//connector otherdb
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="otherdb";
$tabconnector[count($tabconnector)-1]['name']="otherdb";


//connector requestor
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="requestor";
$tabconnector[count($tabconnector)-1]['name']="requestor";



//connector log
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="log";
$tabconnector[count($tabconnector)-1]['name']="log";




//connector variables getter
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="instanceVar";
$tabconnector[count($tabconnector)-1]['name']="variable";


//connector includer
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="includer";
$tabconnector[count($tabconnector)-1]['name']="includer";



//connector codeloader (for class core and others with event onCodeLoad)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['outputaction']="none";
$tabconnector[count($tabconnector)-1]['name']="codeloader";





//connector lib
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="lib";
$tabconnector[count($tabconnector)-1]['name']="lib";


//connector formater
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="formater";


//connector access
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="instanceDroit";
$tabconnector[count($tabconnector)-1]['name']="access";


//connector user
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="user";
$tabconnector[count($tabconnector)-1]['name']="user";


//connector usertoken
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="usertoken";
$tabconnector[count($tabconnector)-1]['name']="usertoken";


//connector auth
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="userloaded";
$tabconnector[count($tabconnector)-1]['name']="authtoken";


//connector droit
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="droit";
$tabconnector[count($tabconnector)-1]['name']="droit";



//connector page
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="page";
$tabconnector[count($tabconnector)-1]['name']="pagevirtualvirtualtask";


//connector lang
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="lang";
$tabconnector[count($tabconnector)-1]['name']="lang";




//connector filestorage
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="filestorage";




//connector thrad cron (main content)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="threadvirtualvirtualtask";



?>
