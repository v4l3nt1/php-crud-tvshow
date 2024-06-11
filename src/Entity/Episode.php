<?php

declare(strict_types=1);

namespace Entity;

class Episode
{
    private int $id;
    private int $seasonId;
    private string $name;
    private string $overview;
    private int $episodeNumber;

    /** getter de l'id de l'épisode
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** getter de l'id de la saison
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /** getter du nom de l'épisode
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /** getter de la description de l'épisode
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /** getter du numéro de l'épisode
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }
}
