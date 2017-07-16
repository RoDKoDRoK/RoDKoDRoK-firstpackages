<?php


//list des connector to call dans l'ordre
$tabconnector=array();


//connector classloader
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="classloader";


//connector conf
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="conf";
$tabconnector[count($tabconnector)-1]['name']="conf";



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



//connector log
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="log";
$tabconnector[count($tabconnector)-1]['name']="log";


//connector lib
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="lib";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:1-var";
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
$tabconnector[count($tabconnector)-1]['name']="pageajax";


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


//connector css
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="css";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:2-var";
$tabconnector[count($tabconnector)-1]['name']="css";


//connector js
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="js";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:3-var";
$tabconnector[count($tabconnector)-1]['name']="js";


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



//connector includer
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="includer";
$tabconnector[count($tabconnector)-1]['name']="includer";


//connector variables getter
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="instanceVar";
$tabconnector[count($tabconnector)-1]['name']="variable";


//connector template
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="tpl";
$tabconnector[count($tabconnector)-1]['name']="tp";


//connector main content
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="maincontentajax";




?>
