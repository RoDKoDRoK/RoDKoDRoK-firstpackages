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



//connector db
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="db";
$tabconnector[count($tabconnector)-1]['name']="db";


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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:1-var";
$tabconnector[count($tabconnector)-1]['name']="lib";


//connector ajax
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="ajax";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-header:2-var";
$tabconnector[count($tabconnector)-1]['name']="ajax";



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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-self-var";
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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:3-subtpl:maincontentindex";
$tabconnector[count($tabconnector)-1]['name']="pagemainindex";


//connector lang
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="lang";
$tabconnector[count($tabconnector)-1]['name']="lang";




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
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:2-var";
$tabconnector[count($tabconnector)-1]['name']="message";




//connector event
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="event";
$tabconnector[count($tabconnector)-1]['name']="event";




//connector set mainvar
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="maintitle";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-self-var";
$tabconnector[count($tabconnector)-1]['name']="varmaintitle";

$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="mainsubtitle";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-self-var";
$tabconnector[count($tabconnector)-1]['name']="varmainsubtitle";

$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="maintemplate";
$tabconnector[count($tabconnector)-1]['name']="varmaintemplate";

$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="header";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:1-subtpl:headerfooter";
$tabconnector[count($tabconnector)-1]['name']="varheader";

$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="footer";
$tabconnector[count($tabconnector)-1]['outputaction']="toprint-content:4-subtpl:headerfooter";
$tabconnector[count($tabconnector)-1]['name']="varfooter";




//connector template
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=true;
$tabconnector[count($tabconnector)-1]['vartoiniter']=true;
$tabconnector[count($tabconnector)-1]['aliasiniter']="tpl";
$tabconnector[count($tabconnector)-1]['name']="tp";


//connector thread index (main content)
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="threadmainindex";



//connector headerfooter
$tabconnector[]=array();
$tabconnector[count($tabconnector)-1]['classtoiniter']=false;
$tabconnector[count($tabconnector)-1]['vartoiniter']=false;
$tabconnector[count($tabconnector)-1]['aliasiniter']="none";
$tabconnector[count($tabconnector)-1]['name']="headerfooter";



?>
