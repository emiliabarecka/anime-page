<?php
declare (strict_types=1);
namespace Ap;
require_once('src/Exception/StorageException.php');
use Ap\Exception\StorageException;
use App\Exception\ConfigurationException;
use PDO;
use PDOException;
use Throwable;

class Database{
    public function __construct(array $config){
        
        try{
            if(
                empty($config['database'])||
                empty($config['host'])||
                empty($config['user'])||
                empty($config['password'])
                ){
                    throw new ConfigurationException('Storage configuration error');
                }
                
            $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            $connection = new PDO(
                $dsn, 
                $config['user'], 
                $config['password']);
        }
        catch(PDOException $e){
            throw new StorageException('connnection error');
        }
    }
}