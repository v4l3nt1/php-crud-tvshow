<?php

declare(strict_types=1);

namespace Entity;

class Poster{

    private int $id;
    private string $jpeg;

    public function getId(){
        return $this->id;
    }

    public function getJpeg(){
        return $this->jpeg;
    }

}