<?php

namespace Bagshare\Domain;

use Doctrine\DBAL\Connection;
use Bagshare\Domain\Reservation;
use Bagshare\DAO\UserDAO;
use Bagshare\DAO\OfferDAO;

class ReservationDAO extends DAO
{
    
    private $userDAO;
    private $offerDAO;
    
    public function __construct(Connection $db, UserDAO $userDAO, OfferDAO $offerDAO){
        parent::__construct($db);
        $this->userDAO = $userDAO;
        $this->offerDAO = $offerDAO;
    }
    
}