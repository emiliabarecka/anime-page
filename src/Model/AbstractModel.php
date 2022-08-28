<?php
declare(strict_types=1);
namespace Ap\Model;
use PDO;
use PDOException;
use Ap\Exception\StorageException;
use Ap\Exception\ConfigurationException;

abstract class AbstractModel{
    protected PDO $conn;

    public function __construct(array $config){

        try{
            $this->validateConfig($config);
            $this->createConnection($config);  
        }   
        catch(PDOException $e){
            throw new StorageException('connnection error');
        }
    }
    //funkcja do dokonania polacznia z bazą
    private function createConnection(array $config): void{

        $dsn = "mysql:dbname={$config['database']};host={$config['host']};charset=utf8";
        $this->conn = new PDO(
            $dsn, 
            $config['user'], 
            $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"
        ]
        );
    }
    
    //funkcja sprawdzająca, czy istnieją klucze
    private function validateConfig(array $config): void{
        if(
            empty($config['database'])||
            empty($config['host'])||
            empty($config['user'])||
            empty($config['password'])
            ){
                throw new ConfigurationException('Storage configuration error');
            }   
    }
} 