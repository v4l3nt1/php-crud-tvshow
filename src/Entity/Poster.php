<?php

declare(strict_types=1);

namespace Entity;
use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Poster{

    private int $id;
    private string $jpeg;

    public function getId(){
        return $this->id;
    }

    public function getJpeg(){
        return $this->jpeg;
    }

    public static function findById(int $id): Poster
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, jpeg
            FROM poster
            WHERE id = :id
        SQL
        );
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if (!($poster = $stmt->fetchObject(Poster::class))) {
            throw new EntityNotFoundException();
        } else {
            return $poster;
        }
    }
}