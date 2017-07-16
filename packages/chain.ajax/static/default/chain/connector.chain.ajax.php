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


//connector includer
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="includer";
$tabconnector[count($tabconnector)-1]['name']="includer";


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


//connector requestorextended
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="requestor";
$tabconnector[count($tabconnector)-1]['name']="requestorextended";



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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:1-var";
$tabconnector[count($tabconnector)-1]['name']="lib";


//connector ajax
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="ajax";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:2-var";
$tabconnector[count($tabconnector)-1]['name']="ajax";



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


//connector auth
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="uidsession";
$tabconnector[count($tabconnector)-1]['name']="auth";


//connector droit
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="droit";
$tabconnector[count($tabconnector)-1]['name']="droit";



//connector langselector
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="langselector";


//connector page
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="page";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:1-subtpl:maincontentajax";
$tabconnector[count($tabconnector)-1]['name']="pagesubajax";


//connector lang
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="lang";
$tabconnector[count($tabconnector)-1]['name']="lang";


//connector varcacheisallowed
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="cacheisallowed";
$tabconnector[count($tabconnector)-1]['name']="varcacheisallowed";

//connector cache
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="cachedpage";
$tabconnector[count($tabconnector)-1]['name']="cache";


//connector codeloader (for css and js)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="cssandjs";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:3-var";
$tabconnector[count($tabconnector)-1]['name']="codeloader";


//connector message
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="message";
$tabconnector[count($tabconnector)-1]['name']="message";



//connector set mainvar
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="maintemplate";
$tabconnector[count($tabconnector)-1]['name']="varmaintemplate";




//connector filestorage
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="filestorage";




//connector template
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="tpl";
$tabconnector[count($tabconnector)-1]['name']="tp";


//connector thread ajax (main content)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="threadsubajax";




?>
