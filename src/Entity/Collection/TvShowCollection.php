<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
use PDO;

class TvShowCollection
{
    /** renvoie toutes les séries de la table
     * @return TvShow[] liste de toutes les series
     */
    public static function findAll(): ?array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, overview, posterId
            FROM tvshow
            ORDER BY name
            SQL
        );

        $stmt->setFetchMode(PDO::FETCH_CLASS, TvShow::class);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}