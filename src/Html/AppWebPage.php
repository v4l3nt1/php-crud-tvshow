<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    private array $menu;

    /** Getter de l'attribut menu
    * @return array
    */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /** à partir d'un chemin et d'un nom, ajoute un bouton à la liste de boutons du menu
    * @param string $path
    * @param string $name
    * @return void
    */
    public function appendToMenu(string $path, string $name): void
    {
        $this->menu[$name] = $path;
    }



    /** Constructeur de la classe AppWebPage
    * @param string $title
    */
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->menu = [];
        parent::appendCssUrl("/css/style.css");
    }

    /** Crée la page html complète (head, body, menu, ...)
    * @return string
    */
    public function toHTML(): string
    {
        $title = $this->getTitle();
        $head = $this->getHead();
        $body = $this->getBody();
        $menu = $this->getMenu();
        $lastMod = self::getLastModification();

        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
            $head
            <title>$title</title>
        </head>
        <body>
            <div class="header">
                <h1>$title</h1>
            </div>\n
        HTML;

        if ($menu != []) {
            $html .= '<div class="menu">';
            foreach ($menu as $name => $path) {
                $html .= "<a href=$path>$name</a>";
            }
            $html .= '</div>';
        }

        $html .= <<<HTML
            <div class="content">
                $body
            </div>
            <div class="footer">
                <p>Dernière modificaton : $lastMod</p>
            </div>
        </body>        
        </html>
        HTML;

        return $html;
    }
}
