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
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:1-subtpl:maincontentws";
$tabconnector[count($tabconnector)-1]['name']="pagews";


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


//connector main content
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="maincontentws";




?>
