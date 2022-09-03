<?php

declare(strict_types=1);

namespace Ap\Model;

use Ap\Exception\StorageException;
use Ap\Model\AbstractModel;
use PDO;
use Throwable;

class ImageModel extends AbstractModel
{

    public function insertImage(array $data): void
    {
        try {
            $imgName = $_FILES['img']['name'];
            $animeId = $data['id'];
            $title = $this->conn->quote($data['title']);
            $home_dir = dirname(__FILE__);
            var_dump($home_dir);
            $upload_target_dir = "$home_dir\..\..\uploaded";
            var_dump($upload_target_dir);
            $file_tmp = $_FILES['img']['tmp_name'];
            //ustawia kreski w dobrym kierunku w zależności od systemu
            $name = basename($_FILES['img']['name']);
            move_uploaded_file($file_tmp, "$upload_target_dir/$name");
            $query = "INSERT into images (anime_id, name, title) Values ('$animeId', '$imgName',  $title)";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            throw new StorageException('Nie udało się dodać obrazu');
        }
    }
    public function getImage(int $animeId): array
    {
        try {
            $query = "SELECT * FROM images WHERE anime_id = $animeId";
            $result = $this->conn->query($query);
            $images = $result->fetchAll(PDO::FETCH_ASSOC);
            shuffle($images);

            return $images;
        } catch (Throwable $e) {
            throw new StorageException('Nie udało się pobrać obrazka');
        }
    }

    public function edit(int $id, string $name): void
    {
        try {
            $name = $this->conn->quote($name);
            $query = "UPDATE images SET name = $name WHERE id = $id";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            dump($e);
            throw new StorageException('Nie udało się zmodyfikować obrazu :(');
        }
    }
    public function delete(int $animeId, int $imageId): void
    {
        try {
            $animeId = $animeId;
            $imageId = $imageId;
            $query = "DELETE FROM images WHERE anime_id = '$animeId' AND id = '$imageId'";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            dump($e);
            throw new StorageException('Nie udało się usunąć obrazu :(');
        }
    }
}
