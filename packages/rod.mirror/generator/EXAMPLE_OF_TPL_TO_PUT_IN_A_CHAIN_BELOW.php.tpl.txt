
//ce fichier présente les variables déjà disponibles pour les fichiers de template
//il n'est pas pris en compte dans le déploiement du package example
//possibilité de créer et charger vos propres variables en créant une class generator dans votre package (class/class.generator.php)


//variables accessibles
{$packagecodename} string
{$descripter} array(key=>value)
{$confstatic} array(key=>value)
{$confform} array(key=>value)
{$confgenerator.instances} array(instancename => array(key=>value)) -->> pour les parcourir utiliser smarty {section name=cptinstance loop=$confgenerator} puis {$confgenerator[cptinstance].example}
{$confgenerator.instancecour} array(key=>value)


//Pour simplifier l'utilisation de sous variables, vous pouvez créer des variables intermédiaires
//Par exemple pour accéder à {$confgenerator.instancecour.name}
//vous pouvez créer une balise intermédiaire smarty "var" de ce type :
//{assign var="instancecour" value=$confgenerator.instancecour}
//puis appeler votre variable de cette façon :
//{$instancecour.name}
//{$instancecour.otherexample}
//...



