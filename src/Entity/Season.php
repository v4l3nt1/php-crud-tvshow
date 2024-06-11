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

    /** modifie l'id de la saison
     * @param ?int $id
     * @return Season
     */
    public function setId(?int $id): Season
    {
        $this->id = $id;
        return $this;
    }

    /** modifie l'id de la série
     * @param int $tvShowId
     * @return Season
     */
    public function setTvShowId(int $tvShowId): Season
    {
        $this->tvShowId = $tvShowId;
        return $this;
    }

    /** modifie le nom de la saison
     * @param string $name
     * @return Season
     */
    public function setName(string $name): Season
    {
        $this->name = $name;
        return $this;
    }

    /** modifie le numéro de la saison
     * @param int $seasonNumber
     * @return Season
     */
    public function setSeasonNumber(int $seasonNumber): Season
    {
        $this->seasonNumber = $seasonNumber;
        return $this;
    }

    /** modifie l'id du poster de la saison
     * @param ?int $posterId
     * @return Season
     */
    public function setPosterId(?int $posterId): Season
    {
        $this->posterId = $posterId;
        return $this;
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

    /** Créé une saison
     * @param ?int $id
     * @param int $tvShowId
     * @param string $name
     * @param int $seasonNumber
     * @param ?int $posterId
     * @return Season
     */
    public static function create(int $id = null, int $tvShowId, string $name, int $seasonNumber, ?int $posterId = null): Season
    {
        $season = new Season();
        $season->setId($id);
        $season->setTvShowId($tvShowId);
        $season->setName($name);
        $season->setSeasonNumber($seasonNumber);
        $season->setPosterId($posterId);
        return $season;
    }

    /** met a jour dans la base de données la saison à partir de l'id de l'instance
     * @return Season
     */
    public function update(): Season
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            UPDATE season
            SET name=:name, seasonNumber=:seasonNumber
            WHERE id=:id
        SQL);
        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':seasonNumber', $this->getSeasonNumber());

        $stmt->execute();

        return $this;
    }

    /** ajouter à la base de données (table season)
     * @return $this
     */
    private function insert()
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            INSERT INTO season (id,tvShowId,name,seasonNumber,posterId)
            VALUES (:id,:tvShowId,:name,:seasonNumber,:posterId)
        SQL
        );
        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':tvShowId', $this->getTvShowId());
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':seasonNumber', $this->getSeasonNumber());
        $stmt->bindValue(':posterId', $this->getPosterId());

        $stmt->execute();

        $this->setId((int) MyPdo::getInstance()->lastInsertId());

        return $this;
    }
}
