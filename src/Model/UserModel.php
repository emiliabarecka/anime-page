<?php
declare(strict_types=1);
namespace Ap\Model;
use Ap\Exception\ConfigurationException;
use Throwable;
use PDO;

class UserModel extends AbstractModel{
    
    public function register(array $data):int {
        
        try{
            $name = $this->conn->quote($data['name']);
            $password = $this->conn->quote($data['password']);
            $email = $this->conn->quote($data['email']);
            $userType = $this->conn->quote($data['userType']);
            $query = "INSERT INTO users (name, password, email, user_type) values ($name , $password, $email, $userType)";
            $this->conn->exec($query);

            return (int)$this->conn->lastInsertId();

        }
        catch(ConfigurationException $e){
            throw new ConfigurationException('Nie udało sie dokonać rejestracji');
        }
    }
    public function getUsers(): array{
        try{
            $query = "SELECT id, password, name, user_type FROM users ";
            $users = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
            
            return $users;
        }
        catch (Throwable $e){
            throw new ConfigurationException("Nieprawidłowe hasło");
        }
    }
    public function getUser($id):array{
        try{
            $query = "SELECT id, name FROM users WHERE id = $id";
            $user = $this->conn->query($query)->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        catch (Throwable $e){
            throw new ConfigurationException("Brak danych o takim użytkowniku");
        }    
    }
}