<?php

namespace Bagshare\Domain;


use Symfony\Component\Validator\Constraints\DateTime;
use Bagshare\Domain\User;
use Bagshare\Domain\DateFormater;


class Offer
{
    /**
    * DATA
    */
    private $id = 0;
    private $proprietaire;
    private $date_ajout;
    private $date_modif;
    private $nb_kg_dispo = 0.0;
    private $nb_env_dispo = 0;
    private $ville_depart = " ";
    private $ville_arrivee = " ";
    private $date_depart;
    private $date_arrivee;
    private $prix_kg = 0.0;
    private $prix_env = 0.0;
    /**
	 * 
	 * @var Precision
	 * @access private
	 */
	private  $precision;
    /**
    * constructor
    */
    public function __construct(User $user, array $offerData){
        $this->hydrate($offerData);
        $this->proprietaire = $user;
    }
    
    /**
    * hydrator
    */
    private function hydrate(array $data){
        foreach($data as $key => $value){
            $method = "set".ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    /**
    * getters
    */
    public function getId(){return $this->id;}
    public function getProprietaire(){return $this->proprietaire;}
    public function getDate_ajout(){
        return DateFormater::formaterDate($this->date_ajout);
    }
    public function getDate_modif(){
        return DateFormater::formaterDate($this->date_modif);
    }
    public function getNb_kg_dispo(){return $this->nb_kg_dispo;}
    public function getNb_env_dispo(){return $this->nb_env_dispo;}
    public function getVille_depart(){return $this->ville_depart;}
    public function getVille_arrivee(){return $this->ville_arrivee;}
    public function getDate_depart(){
        return DateFormater::formaterDate($this->date_depart);
    }
    public function getDate_arrivee(){
        return DateFormater::formaterDate($this->date_arrivee);
    }
    public function getPrix_kg(){return $this->prix_kg;}
    public function getPrix_env(){return $this->prix_env;}
    public function getPrecision(){return $this->precision;}
    
    /**
    * setters
    */
    public function setId($id){
        $this->id = (int)$id;
        return null != $this->id;
    }
    public function setProprietaire(User $proprietaire){
        $this->proprietaire = $proprietaire;
        return null != $this->proprietaire;
    }
    public function setDate_ajout($date){
        $this->date_ajout = DateFormater::setDate($date);
        return null != $this->date_ajout;
    }
    public function setDate_modif($date){
        $this->date_modif = DateFormater::setDate($date);
        return null != $this->date_modif;
    }
    public function setNb_kg_dispo($kg){
        $this->nb_kg_dispo = (float)$kg;
        return null != $this->nb_kg_dispo;
    }
    public function setNb_env_dispo($env){
        $this->nb_env_dispo = (int)$env;
        return null != $this->nb_env_dispo;
    }
    public function setVille_depart($ville){
        $this->ville_depart = $ville;
        return null != $this->ville_depart;
    }
    public function setVille_arrivee($ville){
        $this->ville_arrivee = $ville;
        return null != $this->ville_arrivee;
    }
    public function setDate_depart($date){
        $this->date_depart = DateFormater::setDate($date);
        return null != $this->date_depart;
    }
    public function setDate_arrivee($date){
        $this->date_arrivee = DateFormater::setDate($date);
        return null != $this->date_arrivee;
    }
    public function setPrix_kg($prix){
        $this->prix_kg = (float)$prix;
        return null != $this->prix_kg;
    }
    public function setPrix_env($prix){
        $this->prix_env = (float)$prix;
        return null != $this->prix_env;
    }
    public function setPrecision(Precision $precision){
        $this->precision = $precision;
        return null != $this->precision;
    }
    
    
}