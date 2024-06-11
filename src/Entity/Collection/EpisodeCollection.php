<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    /** retrouve la liste des episodes d'une saison a partir de son id
     * @param $seasonId
     * @return Episode[]
     */
    public static function findBySeasonId($seasonId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY episodeNumber;
            SQL
        );
        $stmt->bindValue(':seasonId', $seasonId);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Episode::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
