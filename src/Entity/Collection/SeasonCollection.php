<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use PDO;

class SeasonCollection
{
    /** retrouve la liste des saisons d'un serie a partir de son id
     * @param $tvShowId
     * @return Season[]
     */
    public static function findByTvShowId($tvShowId) : array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE tvShowId = :tvShowId
            ORDER BY name, seasonNumber
            SQL
        );

        $stmt->bindValue('tvShowId', $tvShowId);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Season::class);

        $stmt->execute();

        return $stmt->fetchAll();


    }
}