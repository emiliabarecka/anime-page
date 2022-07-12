<?php
declare (strict_types=1);
namespace Ap\Model;

use Ap\Model\AbstractModel;
use Ap\Model\ModelInterface;
use Ap\Exception\NotFoundException;
use Ap\Exception\StorageException;
use Ap\Exception\ConfigurationException;
use PDO;
use Throwable;

class AnimeModel extends AbstractModel implements ModelInterface{

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
    

    public function get(int $id): array{
        try{
            $query = "SELECT id, title, description_0, description_1, characters, episodes, image_name FROM animes WHERE id = $id";
            $result = $this->conn->query($query);
            $anime = $result->fetch(PDO::FETCH_ASSOC);    
        }
        catch(Throwable $e){
            throw new StorageException('Nie ma takiej anime', 400, $e);
        }
        if(!$anime){
            throw new NotFoundException("Anime o id: $id nie zostało znalezione");
        }
        $charactersString =  $anime['characters'];
        $characterArray =  explode(",", $charactersString);
        $anime['characters'] = $characterArray;
        $anime['charactersString'] = $charactersString;
        $anime['episodesString'] = $anime['episodes'];
        $anime['episodes'] = explode("," , $anime['episodes'] ?? []);
        $anime['id'] = (string)$anime['id'];
        $anime['image_name']  = (string)$anime['image_name'];   
        return $anime;
    }

    public function getAnimes(): array{
        try{
            $query = "SELECT id, title, description_0, image_name FROM animes";
            $result = $this->conn->query($query);
            $animes = $result->fetchAll( PDO::FETCH_ASSOC);
            foreach($animes as $key => $anime){
                // $animes[$anime]['id'] = (string)$anime['id'];
                $animes[$key]['id'] = (string)$animes[$key]['id'];
                $animes[$key]['image_name'] = (string)$animes[$key]['image_name'];
               
             }   
            return $animes;
        }
        catch (Throwable $e){
            throw new StorageException('Nie udało się pobrac danych', 400, $e);
        }    
    } 
    public function create(array $data): void{     
        
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
            throw new StorageException('Nie udało się dodać nowej anime do bazy');
        }
    }

    public function edit(int $id, array $data): void{
        try{
            $title = $this->conn->quote($data['title']);
            $desc = $this->conn->quote($data['desc']);
            $desc1 = $this->conn->quote($data['desc1']);
            $characters = $this->conn->quote($data['characters']);
            $eps = $this->conn->quote($data['eps']);
            $img = $data['img'];
            $home_dir = dirname(__FILE__);
            
            $upload_target_dir = "$home_dir\..\uploaded";
            $file_tmp = $_FILES['img']['tmp_name'];
            $name = basename($_FILES['img']['name']);
         
            move_uploaded_file($file_tmp, "$upload_target_dir/$name");

            $query = "
            UPDATE animes SET
            title = $title,
            description_0 = $desc,
            description_1 = $desc1,
            characters = $characters,
            episodes = $eps,
            image_name = '$img'
            WHERE id = $id
            ";
            $this->conn->exec($query);
        }
        catch(Throwable $e){
            throw new StorageException('Nie udało sie zaktualizować anime', 400, $e);
            
        }
    }
    public function delete(int $id): void{
        try{
            $query = "DELETE FROM animes WHERE id = $id LIMIT 1";
            $this->conn->exec($query);
        }
        catch (Throwable $e){
            throw new StorageException('Nie udało sie usunąć danych z bazy');
        }
    }

    
}