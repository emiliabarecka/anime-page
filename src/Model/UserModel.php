<?php
declare(strict_types=1);
namespace Ap\Model;
use Ap\Exception\ConfigurationException;
use Throwable;
use PDO;

class UserModel extends AbstractModel{
// public function register(array $data):void{
//     try{
//         $query = "INSERT INTO users (name, password, user_type) values ($name , $pass, $userType)";
//         $this->conn->exec($query);

//     }
//     catch(ConfigurationException $e){
//         throw new ConfigurationException('Nie udało sie dokonać rejestracji');
//     }
// }
public function getUsers(): array{
    try{
        $query = "SELECT  password, name FROM users ";
        $users = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        return $users;
    }
    catch (Throwable $e){
        throw new ConfigurationException("Nieprawidłowe hasło");
    }
}
}