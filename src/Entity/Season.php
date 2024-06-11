<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use Entity\Exception\EntityNotFoundException;

class Season
{
    private ?int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    private function __construct()
    {
    }

    /** renvoie l'id de la saison
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** renvois l'id de la de la serie
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /** renvoie le nom de la saison
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /** renvoie le numeroe de la saison
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /** renvoie l'id du poster de la saison
     * @return ?int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /** Renvoie une liste d'épisodes correspondant à la saison courante
     * @return Episode[]
     */
    public function getEpisodes(): array
    {
        return EpisodeCollection::findBySeasonId($this->getId());
    }

    /** permet de recuperer une saison à partir d'un id
     * @param int $id
     * @return Season
     */
    public static function findById(int $id): Season
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE id = :id
        SQL
        );
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if (!($season = $stmt->fetchObject(Season::class))) {
            throw new EntityNotFoundException();
        } else {
            return $season;
        }
    }

}
