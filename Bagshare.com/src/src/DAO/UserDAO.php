<?php

namespace Bagshare\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Bagshare\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
    * Returns a list of all users, sorted by role and name.
    *
    * @return array A list of all users.
    */
    public function findAll(){
        $sql = "select * from T_USER order by role";
        $result = $this->getDb()->fetchAll($sql);
        
        // convert query result to an array of domain object
        $entities = array();
        foreach ($result as $row){
            $id = $row["id"];
            $entities[$id] = new User($row);;
        }
        
        return $entities;
    }
    
    /**
    * Return the user matching th supplied id.
    *
    * @param int $id The user id.
    * @return \MyBooks\Domain\User|throws exception if no matching user is found
    */
    public function find($id){
        $sql = "CALL affichage_profil_utilisateur(?)";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        
        if(empty($row)){
            throw new \Exception(sprintf("No user matching id : "%d ."", $id));
        }
        
        return new User($row);
    }
    
    /**
    * {@inheritDoc}
    */
    public function loadUserByUsername($username){
        $sql = "select * from T_USER where nom = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));
        
        if(empty($row)){
            throw new UsernameNotFoundException(sprintf("User %s not found.", $username));
        }
        
        return new User($row);
    }
    
    /**
    * {@inheritDoc}
    */
    public function refreshUser(UserInterface $user){
        $class = get_class($user);
        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException(sprintf("Instances of %s are not supported.", $class));
        }
        
        return $this->loadUserByUsername($user->getNom());
    }
    
    /**
    * {@inheritDoc}
    */
    public function supportsClass($class){
        return "Bagshare\Domain\User" === $class;
    }
    
    /**
    * Saves a user into the database.
    *
    * @param \MicroCMS\Domain\User $user The user to save
    */
    public function save(User $user){
        $userData = array(
            "nom" => $user->getNom(),
            "mail" => $user->getMail(),
            "prenom" => $user->getPrenom(),
            "tel" => $user->getTel(),
            "salt" => $user->getSalt(),
            "password" => $user->getPassword(),
            "role" => $user->getRole(),
        );
        
        if ($user->getId()){
            // The user has arleady been saved : update it
            $this->getDb()->update("T_USER", $userData, array("id" => $user->getId()));
        }
        else {
            // The user has never been saved : insert it
            $this->getDb()->insert("T_USER", $userData);
            // Get the id of the newly inserted user and set it  on the entity
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }
    
    /**
    * Removes a user from the database.
    *
    * @param int $id The user id.
    */
    public function delete($id){
        // Delete the user
        $this->getDb()->delete("T_USER", array("id" => $id));
    }
    
}