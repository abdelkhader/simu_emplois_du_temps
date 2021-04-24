<?php
require("calendrier.php");
//require("groupe.php");
require ("service.php");

$list_groupe=array();
$list_classe=array();
$list_matiere=array();
$list_prof=array();


function creation_groupe_rand(string $n) {
$i=rand(0, 30);
$a=new groupe($n,$i);
global $list_groupe;
$list_groupe[$n]=$a;

}


function creation_classe(string $n){
$a=new classe("$n");
global $list_classe;
$list_classe[$n]=$a;

}

function creation_matiere(string $n){
$a=new matiere($n);
global $list_matiere;
$list_matiere[$n]=$a;
}
//CHANGER
function ajout_categories(string $n,$t=array(),matiere  &$m){
$b=rand(15, 30);
if($n=="TP"){
$c=3.0;}
else $c=1.33;
if($n=="CM"){
$d=1.25;}
else $d=1.0;

$a=new categorie($n,$b,$c,$d,1,$t);
$m->categories[$n]=$a;

}



function ajout_grp_classe(string $n,$t=array()){
	global $list_classe;
	foreach( $list_classe as $val){
		if($val->nom==$n){
			foreach($t as $tab){
			$val->ajout_groupe($tab);
			}
		} 
	}
}



function creation_prof(string $n){
$a=new professeur($n);
global $list_prof;
$list_prof[$n]=$a;


}

function affectation_prof(float $n,string $p,string $m,string $c){
global $list_matiere , $list_prof;
$a=$list_prof[$p];
$list_matiere[$m]->ajout_service($c,$a,$n);


}






creation_groupe_rand("opt_1");
creation_groupe_rand("opt_2i");
creation_groupe_rand("opt_2d");
creation_groupe_rand("opt_3");



creation_classe("Tous");
creation_classe("G1");
creation_classe("G2");
creation_classe("O1");
creation_classe("O2",$list_classe);
creation_classe("O3",$list_classe);

ajout_grp_classe("Tous",$list_groupe);
ajout_grp_classe("G1",[$list_groupe["opt_3"],$list_groupe["opt_1"]]);
ajout_grp_classe("G2",[$list_groupe["opt_2i"],$list_groupe["opt_2d"]]);
ajout_grp_classe("O1",[$list_groupe["opt_1"]]);
ajout_grp_classe("O2",[$list_groupe["opt_2i"],$list_groupe["opt_2d"]]);
ajout_grp_classe("O3",[$list_groupe["opt_3"]]);
//var_dump($list_classe, $expression = null);

creation_matiere("Dev Web",$list_matiere);
creation_matiere("ISI",$list_matiere);

ajout_categories("CM",[$list_classe["Tous"]],$list_matiere["Dev Web"]);
ajout_categories("TD",[$list_classe["G1"],$list_classe["G2"]],$list_matiere["Dev Web"]);
ajout_categories("TP",[$list_classe["O1"],$list_classe["O2"],$list_classe["O3"]],$list_matiere["Dev Web"]);

ajout_categories("CM",[$list_classe["G1"]],$list_matiere["ISI"]);
ajout_categories("TD",[$list_classe["O1"],$list_classe["O3"]],$list_matiere["ISI"]);

ajout_categories("TP",[$list_classe["O1"],$list_classe["O3"]],$list_matiere["ISI"]);

//revoir affichage sur les groupe 
//print_r($list_matiere["ISI"], $return = null);

creation_prof("Marc Legay");
creation_prof("David Lessaint");
creation_prof("David Genest");

//print_r($list_matiere["Dev Web"]->categories["CM"] ,$return = null);
affectation_prof(2.0,"Marc Legay","Dev Web","CM");
$list_prof["Marc Legay"]->affiche();

/*
$dev=new matiere("DevWeb");
$dev->ajout_cate("CM",16.0,1.33,1.25,3);
$dev->ajout_cate("TD",20.0,1.33,1.25,3);
$dev->ajout_service("CM",$a,1.5);
$dev->ajout_service("TD",$a,1.5);
//print_r($dev, $return = null);
echo "<br>";
echo "<br>";
*/




?>
