<?php

//initial conf to load conf (only for the minimum conf before loading a real conf system later without any other solution)
$arkitect['initialconf']['initialcodeloader']=array();

$arkitect['initialconf']['initialcodeloader'][]=array();
$arkitect['initialconf']['initialcodeloader'][count($arkitect['initialconf']['initialcodeloader'])-1]['nomcodecodesrc']="class";
$arkitect['initialconf']['initialcodeloader'][count($arkitect['initialconf']['initialcodeloader'])-1]['typecodesrc']="phpclass";

//$arkitect['initialconf']['initialcodeloader'][]=array();
//$arkitect['initialconf']['initialcodeloader'][count($arkitect['initialconf']['initialcodeloader'])-1]['nomcodecodesrc']="other";
//$arkitect['initialconf']['initialcodeloader'][count($arkitect['initialconf']['initialcodeloader'])-1]['typecodesrc']="othertype";
//...


//classic arkitect
$arkitect['src.common']="core/src/common";
$arkitect['src.ponctual']="core/src/ponctual";

$arkitect['ext.src']="/src";
$arkitect['ext.thread']="/thread";

$arkitect['integrate.codeloader']="core/integrate/codeloader";



?>