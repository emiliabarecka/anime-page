<?php
declare (strict_types=1);
namespace Ap\Model;
use Ap\Exception\ConfigurationException;
use Throwable;

class CommentModel extends AbstractModel{

    public function addComment(array $data):void{
        dump($data);
        try{
            $userName = $this->conn->quote($data['name']);
            $userId = $this->conn->quote($data['userId']);
            $content = $this->conn->quote($data['content']);
            $date = $this->conn->quote($data['date']);
            $query = "INSERT INTO comments (user_name, user_id, content, date) VALUES ($userName, $userId, $content, $date)";

            $this->conn->exec($query);
        }
        catch(Throwable $e){
            throw new ConfigurationException('Nie udało sie dodać komentarza');
        }
    }
}