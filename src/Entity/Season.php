<?php

declare(strict_types=1);

namespace Entity;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /** renvoie l'id de la saison
     * @return int
     */
    public function getId(): int
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

    /** renvoie l'id du poster
     * @return null|int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }



}
