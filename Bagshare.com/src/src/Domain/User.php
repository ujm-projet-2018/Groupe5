<?php

namespace Bagshare\Domain;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class User implements UserInterface
{
   /** 
   * DATA
   */
    private $id = 0;
    private $nom = " ";
    private $prenom = " ";
    private $tel = " ";
    private $mail = " ";
    private $password = " ";
    private $salt = " ";
    private $role = " ";
    private $identite = " ";
    private $identite_confirme = false;
    
    
    private $errors = array();
    
    /**
    * constructors
    */
    public function __construct(array $data){
        $this->hydrate($data);
    }
    
    /**
    * hydrator
    */
    private function hydrate(array $data){
        foreach($data as $key => $value){
            $method = "set".ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    /**
    * getters
    */
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getUsername(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getTel(){
        return $this->tel;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getSalt(){
        return $this->salt;
    }
    public function getRole(){
        return $this->role;
    }

    public function getRoles(){
        return array($this->getRole());
    }
    
    public function getErrors(){
        return $this->errors;
    }
    
    /**
    * setters
    */
    public function setId($id){
        $this->id = $id;
    }
    
    public function setMail($mail){
        // check if the mail is valid
        if (preg_match("#^[a-zA-Z0-9.-]{3,}@[a-zA-Z0-9.-]{2,}.[a-z]{2,4}$#i", $mail)){
            $this->mail = $mail;
        }
        else{
            return false;
        }
    }
    
    public function setTel($tel){
        // check if the phone number is valid
        if (preg_match("#^0(6|7|4)[0-9]{8}$#", $tel) || preg_match("#^0(20|30|32|33|34)[0-9]{7}$#i", $tel)){
            $this->tel= $tel;
        }
        else{
            return false;
        }
        
    }
    
    public function setPrenom($prenom){
        $nameLength = strlen($prenom);
        if ($nameLength < 2 || $nameLength > 15){
            return false;
        }
        $this->prenom = $prenom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setSalt($salt){
        $this->salt = $salt;
    }
    
    public function setRole($role){
        $this->role = $role;
    }
    
    public function signIn(array $post, $password_name, $role){
        $this->hydrate($post);
        if ($post[$password_name] !== $this->password)
            $this->errors = "Les mots de passes ne correspondent pas.";
        if (!empty($this->nom) && empty($this->tel) && empty($this->mail) && empty($this->prenom) && empty($this->password))
            $this->errors = "Veillez remplir correctement le formulaire";
        
        /* crypt password */
        $this->salt = substr(md5(time()), 0, 23);
        $enc = new BCryptPasswordEncoder(10);
        $this->password = $enc->encodePassword($this->password, $this->salt);
        
        $this->role = $role; /*set role */
        
        return $this->errors;
    }
    
    /**
    * @inheritDoc
    */
    public function eraseCredentials(){
        //Nothing to do here
    }
}