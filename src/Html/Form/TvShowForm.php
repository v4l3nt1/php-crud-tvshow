<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\TvShow;
use Html\StringEscaper\StringEscaper;

class TvShowForm
{
    use StringEscaper;
    private ?TvShow $tvShow;

    /** Constructeur du TvShowForm
     * @param TvShow|null $tvShow
     */
    public function __construct(?TvShow $tvShow = null)
    {
        $this->tvShow = $tvShow;
    }

    /** retourne la série tv
     * @return TvShow|null
     */
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

}
