<?php
require "groupe.php";

//classe professeur qui ressence tout les prof
class professeur{

//prenom et nom du professeur
public $id;
//nombre d'heure a effectué
public $service;
//nombre d'heure qui a actuellement 
public $charge;
//nombre comparaison entre l'heure de charge et de service
public $difference;
//tableau des affectaction des categories
public $affectation;

public function __construct(string $i){
$this->id=$i;
$this->service=192;
$this->charge=0;
$this->difference=-192;
$this->affectation=array();
}

//fonction qui met a jour les heure de charge et différence du prof et rajoute la categorie a affectation 
public function ajout_heure(float $h,string $n,float $nb){
$this->charge+=$h;
$this->difference=$this->charge - $this->service;
$this->affectation[$n]=[$nb];
}

//fonction d'affichage d'un prof 
public function affiche(){
echo "Nom: ",$this->id," service: ",$this->service," charge: ",$this->charge," difference: ",$this->difference ,"<br>",$this->affiche_affectation();
}

//fonction d'affichage 
public function affiche_affectation(){
echo "affectaction : ";
foreach($this->affectation as $c => $val){
echo $c,": ",$val[0],"<br>";

}

}
}

class categorie{
public $nom;
public $heure;
public $creneau;
public $duree ;
public $coef;
public $nbgroupe;
public $EDT;
public $service;
public $reste;

public $effectif;
public $groupe;

public function __construct(string $n ,float $h,float $d,float $c,float $ng,$G=array()){
$this->nom=$n;
$this->heure=$h;
$this->duree=$d;
$this->creneau= $h/$d;
$this->coef=$c;
$this->nbgroupe=$ng;
$this->reste=$ng;
$this->EDT=$h*$c;
$this->service=array();
$this->groupe=array();
foreach($G as $val){
	//$this->effectif+=$val->effectif;
	array_push($this->groupe, $val);
} 
}

public function ajout_service(professeur $P,float $n){
$this->service[$P->id]=[$n];
$this->reste-=$n;
$a=$n*$this->EDT;
$P->ajout_heure($a,$this->nom,$n);
}


//fonction qui ajoute un objet groupe a la classe
public function ajout_groupe(groupe $a){
	$this->totaleffectif+=$a->effectif;
	$this->groupe[$a->nom]=$a;
}
}




class matiere{
	public $id;
	public $descritpion;
	public $categories;
	
 


	public function __construct(string $n){
		$this->id=$n;
		$this->categories=array();
	}

//fonction qui ajoute des categorie au matiere (CM TP etc)
	public function ajout_categories(categorie $g){
		$this->categories[$g->nom]=$g;
		}


	public function ajout_service(string $c,professeur $P,float $n){
		foreach ($this->categories as $val){
			if($val->nom==$c){
				$val->ajout_service($P,$n);
			}	
		}
	}

}





class semestre{
public $nom;
public $matieres;

public function __construct(string $i,$t =array()){
$this->nom=$i;
$this->matieres=$t;
}

public function ajout_matiere(matiere $m){
	array_push($this->matieres, $m);
}

}



class filiare{
public $nom;
public $descritpion;
public $semestre;

public function __construct(string $i,string $d){
$this->nom=$i;
$this->description=$d;
$this->semestre=array();

}
public function ajout_semestre(semestre $s){
array_push($this->semestre,$s);
}
}



?>