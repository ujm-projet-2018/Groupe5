<?php

namespace Bagshare\DAO;

use Doctrine\DBAL\Connection;

abstract class DAO
{
    /**
    * The database connection object
    *
    * @var \Doctrine\DBAL\Connection
    */
    private $db;
    
    /**
    * Constructor
    * 
    * @param \Doctrine\DBAL\Connection
    */
    public function __construct(Connection $db){
        $this->db = $db;
    }
    
    /**
    * Return the database connection object
    *
    * @return \Doctrine\DBAL\Connection
    */
    protected function getDb(){
        return $this->db;
    }
    
}