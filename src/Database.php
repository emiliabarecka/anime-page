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
    private PDO $conn;

    public function __construct(array $config){

        try{
            $this->validateConfig($config);
            $this->createConnection($config);  
        }   
        catch(PDOException $e){
            throw new StorageException('connnection error');
        }
    }

    public function getPassword(): array{
        try{
            $query = "SELECT  password FROM users ";
            $password = $this->conn->query($query)->fetch(PDO::FETCH_ASSOC);
            return $password;
        }
        catch (Throwable $e){
            throw new ConfigurationException("Nieprawidłowe hasło");
        }
    }

    public function getAnimes(): array{
        try{
            $query = "SELECT title, description_0, image_name FROM animes";
            $result = $this->conn->query($query);
            $animes = $result->fetchAll( PDO::FETCH_ASSOC);    
            return $animes;
        }
        catch (Throwable $e){
            throw new StorageException('Nie udało się pobrac danych', 400, $e);
        }
        
    }

    //data przychodzi z posta od create z kontrolera 
    public function createAnime(array $data): void{     
        
        try{
            $title = $this->conn->quote($data['title']);
            $desc = $this->conn->quote($data['desc']);
            $desc2 = $this->conn->quote($data['desc2']);
            $characters = $this->conn->quote($data['characters']);
            $eps = $this->conn->quote($data['eps']);
            $img = $data['img']['name'];

            // $upload_dir = 'C:\xampp\htdocs\animePage\uploaded';
            $home_dir = dirname(__FILE__);
            
            $upload_target_dir = "$home_dir\..\uploaded";
            $file_tmp = $_FILES['img']['tmp_name'];
            //ustawia kreski w dobrym kierunku w zależności od systemu
            $name = basename($_FILES['img']['name']);
         
            move_uploaded_file($file_tmp, "$upload_target_dir/$name");
            
            $query = "INSERT INTO animes(title, description_0, description_1, characters, episodes, image_name)
                      VALUES($title, $desc, $desc2, $characters, $eps, '$img')";
            $this->conn->exec($query);
        }
        catch (Throwable $e){
            dump($e);
            throw new StorageException('Nie udało się dodać nowej anime do bazy');
        }
    }

    //funkcja do dokonania polacznia z bazą
    private function createConnection(array $config): void{

        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->conn = new PDO(
            $dsn, 
            $config['user'], 
            $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
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