<?php

namespace helpers\db;

use \PDO;
use \PDOException;
use helpers\logger\Logger as Logger;

class Connection extends PDO
{

    private $db_host = '';
    private $db_name = '';
    private $db_username = '';
    private $db_password = '';

    function __construct($db_config)
    {
        $this->db_host = $db_config['db_host_name'];
        $this->db_name = $db_config['db_name'];
        $this->db_username = $db_config['db_user_name'];
        $this->db_password = $db_config['db_password'];
        return $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
        try{
            $db = parent::__construct($dsn,$this->db_username,$this->db_password);
            parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            Logger::log('Connected to database : ' . $dsn);
            return $db;
        }catch(PDOException $e){
            Logger::log('Error connecting to database : ' . $e->getMessage());
        }
    }
    function DBbeginTransaction()
    {
        parent::beginTransaction();
    }

    function DBcommit()
    {
        parent::commit();
    }

    function DBrollBack()
    {
        parent::rollBack();
    }

}