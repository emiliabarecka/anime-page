<?php
declare(strict_types=1);
namespace Ap\Model;
use Ap\Exception\ConfigurationException;
use Throwable;
use PDO;

class UserModel extends AbstractModel{
    
public function getOwner(): array{
    try{
        $query = "SELECT name, password, user_type FROM users WHERE user_type = 'owner'";
        $userData = $this->conn->query($query)->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }
    catch(Throwable $e){
        throw new ConfigurationException('Nie znaleziono użytkownika');
    }
}
public function register(array $data):void{
    try{
        $name = $this->conn->quote($data['name']);
        $password = $this->conn->quote($data['password']);
        $email = $this->conn->quote($data['email']);
        $userType = $this->conn->quote($data['userType']);
        $query = "INSERT INTO users (name, password, email, user_type) values ($name , $password, $email, $userType)";
        $this->conn->exec($query);

    }
    catch(ConfigurationException $e){
        throw new ConfigurationException('Nie udało sie dokonać rejestracji');
    }
}
public function getUsers(): array{
    try{
        $query = "SELECT  password, name, user_type FROM users ";
        $users = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        return $users;
    }
    catch (Throwable $e){
        throw new ConfigurationException("Nieprawidłowe hasło");
    }
}
}