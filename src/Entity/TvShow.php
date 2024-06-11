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

    /**
     * sert à créer l'instance pour la fonction create
     */
    private function __construct()
    {
    }

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

    /** modifie l'id
     * @param int $id
     */
    public function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    /** modifie le nom
     * @param $name
     * @return TvShow
     */
    private function setName($name): TvShow
    {
        $this->name = $name;
        return $this;
    }

    /** modifie le nom original de la série
     * @param string $originalName
     * @return TvShow
     */
    public function setOriginalName(string $originalName): TvShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    /** modifie le site de la série
     * @param string $homepage
     * @return TvShow
     */
    public function setHomepage(string $homepage): TvShow
    {
        $this->homepage = $homepage;
        return $this;
    }

    /** modifie la description)
     * @param string $overview
     * @return TvShow
     */
    public function setOverview(string $overview): TvShow
    {
        $this->overview = $overview;
        return $this;
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
            SELECT id, name, originalName, homepage, overview, posterId
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

    /** supprimer une serie de la base de données et met son id a null
     * @return $this
     */
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

    /** met a jour dans la base de données la série à partir du nom de l'id de l'instance
     * @return $this
     */
    public function update(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            UPDATE tvshow
            SET name:=name
            WHERE id=:id
SQL
        );
        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':name', $this->getName());

        $stmt->execute();

        return $this;
    }

    /** creer une série
     * @param string $name
     * @param int|null $id
     * @return TvShow
     */
    public static function create(int $id = null, string $name, string $ogName, string $homepage, string $overview): TvShow
    {
        $tvShow = new TvShow();
        $tvShow->setId($id);
        $tvShow->setName($name);
        $tvShow->setOriginalName($ogName);
        $tvShow->setHomepage($homepage);
        $tvShow->setOverview($overview);
        return $tvShow;
    }

    /** ajouter à la base de données
     * @return $this
     */
    private function insert()
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            insert into tvshow (name,originalName,homepage,overview,posterId)
            VALUES (:name,:originalname,:homepage,:overview,:posterid)
SQL
        );
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':originalName', $this->getOriginalName());
        $stmt->bindValue(':homepage', $this->getHomepage());
        $stmt->bindValue(':overview', $this->getOverview());
        $stmt->bindValue(':posterId', $this->getPosterId());

        $stmt->execute();

        $this->setId((int) MyPdo::getInstance()->lastInsertId());

        return $this;
    }

    /** sauvegarde la série dans la base de données
     * @return $this
     */
    public function save()
    {
        if ($this->getId() == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

}
