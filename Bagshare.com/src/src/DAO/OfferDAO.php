<?php

namespace Bagshare\DAO;

use Doctrine\DBAL\Connection;
use Bagshare\Domain\Offer;
use Bagshare\DAO\UserDAO;

class OfferDAO extends DAO
{
    private $userDAO;
    
    public function __construct(Connection $db, UserDAO $userDAO){
        parent::__construct($db);
        $this->userDAO = $userDAO;   
    }
    /**
    * Retourne les n derniere offre disponible
    *
    * @param int : nombre d'offre à afficher
    *
    * @return array Offer : liste d'objet offre
    */
    public function n_last_offer($n){
        //$req = "CALL n_derniere_offre_disponible(?)";
        $req = "select * from T_OFFRE";
        $data = $this->getDb()->fetchAll($req);
        //$data = $this->getDb()->fetchAll($req, array($n));
        $offer_array = array();
        foreach ($data as $row){
            $id = $row["id"];
            $user = $this->userDAO->find($row["id_user"]);
            $offer_array[$id] = new Offer($user,$row);
        }
        
        return $offer_array;
    }
}