<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;

class GenreCollection{


    public static function getAll() : array
    {
        $stmt = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id, name
            FROM genre
SQL);
        $stmt->setFetchMode(PDO::FETCH_CLASS,Genre::class);
        $stmt->execute();
        $episodes = $stmt->fetchAll();
        return $episodes;
    }
}