<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;

class TvShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private string $posterId;

    /** Getter de id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Getter de name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /** Getter de originalName
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /** Getter de homepage
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /** Getter de overview
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /** Getter de posterId
     * @return string
     */
    public function getPosterId(): string
    {
        return $this->posterId;
    }

    /** Renvoie une liste de saison correspondant à la série courante
     * @return Season[]
     */
    public function getSeasons(): array
    {
        return SeasonCollection::findByTvShowId($this->getId());
    }

    /** permet de recuperer une saison à partir d'un id
     * @param int $id
     * @return TvShow
     */
    public static function findById(int $id): TvShow
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, originaName, homepage, overview, posterId
            FROM tvshow
            WHERE id = :id
        SQL
        );
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if (!($show = $stmt->fetchObject(TvShow::class))) {
            throw new EntityNotFoundException();
        } else {
            return $show;
        }
    }

    /** modifie l'id
     * @param int $id
     */
    public function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    public function delete(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            DELETE FROM tvshow
            WHERE id=:id
SQL
        );
        $stmt->bindValue(':id', $this->getId());
        $stmt->execute();
        return $this->setId(null);

    }
}
