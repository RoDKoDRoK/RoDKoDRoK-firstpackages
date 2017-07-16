<?php

$arkitect['ext.src']="/src";
$arkitect['ext.control']="/control";
$arkitect['ext.template']="/template";
$arkitect['ext.thread']="/thread";
$arkitect['ext.model']="/model";
$arkitect['ext.first']=$arkitect['ext.model']."/first";
$arkitect['ext.secundary']=$arkitect['ext.model']."/secundary";

$arkitect['ext.class']=$arkitect['ext.src']."/class.php";
$arkitect['ext.threadclass']=$arkitect['ext.class'].$arkitect['ext.thread'];
$arkitect['ext.modelclass']=$arkitect['ext.class'].$arkitect['ext.model'];
$arkitect['ext.firstclass']=$arkitect['ext.class'].$arkitect['ext.first'];
$arkitect['ext.secundaryclass']=$arkitect['ext.class'].$arkitect['ext.secundary'];


?>