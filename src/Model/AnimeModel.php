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

    
    public function get(int $id): array{
        try{
            $query = "SELECT id, title, description_0, characters, episodes, published FROM animes WHERE id = $id";
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
        $anime['published'] = (string)$anime['published'];
        
        return $anime;
    }

    public function getAnimes(null| string $user):array{
        try{
            if($user){
                $query = "SELECT id, title, published,  LEFT(description_0, 800) AS description_0 FROM animes";
            }else{
                $query = "SELECT id, title, published, LEFT(description_0, 600) AS description_0 FROM animes WHERE published != 0";
            }
            
            $result = $this->conn->query($query);
            $animes = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach($animes as $key => $anime){
                $animes[$key]['id'] = (string)$animes[$key]['id'];
                $animes[$key]['published'] = (string)$animes[$key]['published'];
                if(str_contains($anime['description_0'], '#image')){
                    $animes[$key]['description_0'] = str_replace('#image','', $anime['description_0']);   
                }
             } 
            return $animes;
        }
        catch(Throwable $e){
            throw new StorageException('Nie udało sie pobrać danych', 400, $e);
        }
    }
    
    public function create(array $data): int{     
        
        try{
            $title = $this->conn->quote($data['title']);
            $desc = $this->conn->quote($data['desc']);
            $characters = $this->conn->quote($data['characters']);
            $eps = $this->conn->quote($data['eps']);
            $published = (string)($data['published']);
 
            $query = "INSERT INTO animes (title, description_0, characters, episodes, published)
                      VALUES($title, $desc, $characters, $eps, $published)";
            $this->conn->exec($query);
            return (int)$this->conn->lastInsertId();
            
        }
        catch (Throwable $e){
            throw new StorageException('Nie udało się dodać nowej anime do bazy');
        }
    }

    public function edit(int $id, array $data): void{
        try{
            $title = $this->conn->quote($data['title']);
            $desc = $this->conn->quote($data['desc']);
            $characters = $this->conn->quote($data['characters']);
            $eps = $this->conn->quote($data['eps']);
            $published = $this->conn->quote($data['published']);

            $query = "
            UPDATE animes SET
            title = $title,
            description_0 = $desc,
            characters = $characters,
            episodes = $eps,
            published = $published
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
    public function putImagesToDescription(string $desc, array $images): array{
        $upload_target_dir = basename("\uploaded");

        if (str_contains($desc, '#image')) {
            $descriptionPart = explode('#image', $desc);

            for ($i = 0; $i < count($descriptionPart) -1; $i++) {
                $descriptionPart[$i] .= '
                <img src='. $upload_target_dir. '\\' 
                . $images[$i]['name'].' '
                .'class="img-fluid  float-start my-3 me-3">
                ';
            }

            // skleiłem to na końcu w jednego stringa w tablicy
            $descriptionPart = [implode('', $descriptionPart)];

        } else {
            $descriptionPart = [$desc];
        }
        
        return $descriptionPart;
    }
    
}