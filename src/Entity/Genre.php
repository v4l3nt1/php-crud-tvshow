<?php

namespace Entity;

class Genre
{
    private int $id;
    private string $name;

    /** permet d'obtenir l'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** permet d'obtenir le nom
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
