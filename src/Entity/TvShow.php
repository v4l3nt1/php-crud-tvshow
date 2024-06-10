<?php

declare(strict_types=1);

namespace src\Entity;

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
}