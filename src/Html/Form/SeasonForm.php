<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Season;
use Html\StringEscaper\StringEscaper;

class SeasonForm
{
    use StringEscaper;

    private ?Season $season;

    /** Constructeur du TvShowForm
     * @param Season|null $season
     */
    public function __construct(?Season $season = null)
    {
        $this->season = $season;
    }

    /** retourne la saison de la série
     * @return Season|null
     */
    public function getSeason(): ?Season
    {
        return $this->season;
    }

}
