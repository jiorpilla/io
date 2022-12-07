<?php
namespace io;

use \Exception;
use helpers\db\Connection as DB_CONNECTION;
use helpers\logger\Logger as Logger;
use \helpers\file\FileHandler as FileHandler;

class Main
{
    /** @var function helper */
    public static $helperFunction = 'helpers\Functions';
    // public static $helperRoute = 'helpers\route\Route';
    
    /** @var function helper */
    public static $_view = 'io\view';

    /** config file */
    public $config;

    /** language variable */
    public $language;

    /** db_connection */
    public $db;

    public function __construct($config = [])
    {
        $this->config = $config;
        
        defined('CLIENT_PATH') or define('CLIENT_PATH', __DIR__ . "/../client/{$this->config['client_name']}/");
        
        $this->getClientConfig();

        date_default_timezone_set($this->config['timezone']);
    }

    public function run()
    {
        
        Logger::log("Entry point ");
        //get Languages
        $this->getLanguages();
        // //connect to database - not necessary for now
        // $this->connectToDB();

        Logger::log( 'test' );
        var_export((new \helpers\route\Route())->parseRoute($_REQUEST));
        // \helpers\logger\Logger::log("test_me here");


        Logger::log("End point ");

        
        // $result = Logger::dump_to_string();
        // var_export($result);
    }

    public function preInit()
    {
        echo self::$helperFunction::createGuid(); // OR Main::$helperFunction::createGuid()
    }

    public function getClientConfig()
    {
        $client_config_path = CLIENT_PATH . "config.{$this->config['dev_type']}.php";
        //check client if exists
        if(file_exists($client_config_path)){
            //call the client config file
            require_once $client_config_path;
            //initialize the client config file for this class
            $this->config = array_merge($this->config, $config);
        }else{
            throw new Exception( 'client does not exists');  
        }
    }

    public function getLanguages()
    {
        //get MAIN language 
        $language_path = "helpers/language/{$this->config['language']}.lang.php";
        $main_language_file_path = __DIR__ . "/../{$language_path}";
        $this->language = require_once $main_language_file_path;

        //get CLIENT language file
        $client_language_file_path = CLIENT_PATH . $language_path;
        if(file_exists($client_language_file_path)){
            //call the client language file
            $language = require_once $client_language_file_path;
            if(empty($language)){
                throw new Exception('No Client language file');
            }
            //initialize the client language file for this class
            $this->language = array_merge($this->language, $language);
        }

        if(empty($this->language)){
            throw new Exception('No language file');
        }
    }

    public function connectToDB()
    {            
        $this->db = new DB_CONNECTION($this->config['db']);
    }

}