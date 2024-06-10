<?php

declare(strict_types=1);

namespace src\Entity;

use Database\MyPdo;
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
}