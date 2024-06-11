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

    /** Produit le code html du formulaire SeasonForm
     * @param string $action
     * @return string
     */
    public function getHtmlForm(string $action): string
    {
        $id = $this->season?->getId() ?? '';
        $tvShowId = $this->escapeString($this->season?->getTvShowId() ?? '');
        $name = $this->escapeString($this->season?->getName() ?? '');
        $seasonNumber = $this->escapeString($this->season?->getSeasonNumber() ?? '');
        $posterId = $this->season?->getPosterId() ?? '';

        $html = <<<HTML
        <form method="post" action="$action">
            <input type="hidden" name="id" value="$id">
            <input type="hidden" name="tvShowId" value="$tvShowId">
            
            <label for="name">Nom</label>
            <input type="text" name="name" value="$name" required>
            
            <label for="seasonNumber">Numéro de saison</label>
            <input type="number" name="seasonNumber" value="$seasonNumber" required>
            
            <button type="submit">Enregistrer</button>
        </form>
        HTML;
        return $html;
    }
}
