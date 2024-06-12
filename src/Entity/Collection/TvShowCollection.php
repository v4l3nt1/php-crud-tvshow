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

    public static function getTvShowByGenre($genreId) : array
    {
        $stmt = MyPDo::getInstance()->prepare(<<<SQL
            SELECT ts.id, ts.name, ts.originalName, ts.homepage, ts.overview, ts.posterId
            FROM tvShow ts
            INNER JOIN tvshow_genre tg ON (ts.id = tg.tvShowId)
            WHERE tg.genreId=:genreId
SQL);
        $stmt->bindValue(':genreId',$genreId);
        $stmt->setFetchMode(PDO::FETCH_CLASS,TvShow::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
