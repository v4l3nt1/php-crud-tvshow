<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\TvShow;
use Exception\ParameterException;
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


    /** Produit le code html du formulaire TvShowForm
     * @param string $action
     * @return string
     */
    public function getHtmlForm(string $action): string
    {
        $id = $this->tvShow?->getId() ?? '';
        $name = $this->escapeString($this->tvShow?->getName() ?? '');
        $originalName = $this->escapeString($this->tvShow?->getOriginalName() ?? '');
        $homepage = $this->escapeString($this->tvShow?->getHomepage() ?? '');
        $overview = $this->escapeString($this->tvShow?->getOverview() ?? '');
        $posterId = $this->tvShow?->getPosterId() ?? '';

        $html = <<<HTML
        <form method="post" action="$action">
            <input type="hidden" name="id" value="$id">
            
            <label for="name">Nom</label>
            <input type="text" name="name" value="$name" required>
            
            <label for="originalName">Nom Original</label>
            <input type="text" name="originalName" value="$originalName" required>
            
            <label for="homepage">Site Internet</label>
            <input type="text" name="homepage" value="$homepage" required>
            
            <label for="overview">Description</label>
            <input type="text" name="overview" value="$overview" required>
            
            <button type="submit">Enregistrer</button>
        </form>
        HTML;
        return $html;
    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        if (!isset($_POST["id"]) || !ctype_digit($_POST["id"])) {
            $id = null;
        } else {
            $id = (int) $_POST["id"];
        }
        if (!isset($_POST["name"]) || $_POST["name"] == '') {
            throw new ParameterException();
        } else {
            $name = $this->stripTagsAndTrim($_POST["name"]);
        }
        if (!isset($_POST["originalName"]) || $_POST["originalName"] == '') {
            throw new ParameterException();
        } else {
            $originalName = $this->stripTagsAndTrim($_POST["originalName"]);
        }
        if (!isset($_POST["homepage"]) || $_POST["homepage"] == '') {
            throw new ParameterException();
        } else {
            $homepage = $this->stripTagsAndTrim($_POST["homepage"]);
        }
        if (!isset($_POST["overview"]) || $_POST["overview"] == '') {
            throw new ParameterException();
        } else {
            $overview = $this->stripTagsAndTrim($_POST["overview"]);
        }
        $this->tvShow = TvShow::create($id, $name, $originalName, $homepage, $overview);
    }

}
