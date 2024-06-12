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
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            ORDER BY name
            SQL
        );

        $stmt->setFetchMode(PDO::FETCH_CLASS, TvShow::class);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getTvShowByGenre($genreList) : array
    {

        $conditions=[];
        $count=0;
        foreach ($genreList as $genreId)
        {
            $conditions+=[(<<<SQL
                tg.genreId=:genre{$count}
SQL)];
            $count+=1;
        }

        $finalCondition = join(" AND ",$conditions);

        $requete=(<<<SQL
            SELECT DISTINCT ts.id, ts.name, ts.originalName, ts.homepage, ts.overview, ts.posterId
            FROM tvshow ts
            INNER JOIN tvshow_genre tg ON (ts.id = tg.tvShowId)
            WHERE $finalCondition
SQL);




        /**$stmt = MyPDo::getInstance()->prepare(<<<SQL
            SELECT ts.id, ts.name, ts.originalName, ts.homepage, ts.overview, ts.posterId
            FROM tvShow ts
            INNER JOIN tvshow_genre tg ON (ts.id = tg.tvShowId)
            WHERE tg.genreId=:genreId
SQL);*/
        $stmt = MyPDo::getInstance()->prepare($requete);
        $i=0;
        while ($i<$count)
        {
            $stmt->bindValue(":genre$i",$genreList[$i]);
            $i+=1;
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS,TvShow::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
