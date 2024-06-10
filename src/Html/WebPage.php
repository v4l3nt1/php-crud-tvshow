<?php

namespace Html;

class WebPage
{
    private string $head;
    private string $body;
    private string $title;

    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getHead(): string
    {
        return $this->head;
    }

    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    public function appendCss(string $css): void
    {
        $this->head .= "<style>$css</style>\n";
    }

    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link href=$url rel='stylesheet'/>\n";
    }

    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src=$url></script> \n";
    }

    public function appendJs(string $js): void
    {
        $this->head .= "<script>$js </script>";
    }

    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
            $this->head
            <title>$this->title</title>
        </head>
        <body>
            $this->body
        </body>        
        </html>
        HTML;
    }

    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5);
    }

    public static function getLastModification(): string
    {
        return date("F d Y H:i:s.", getlastmod());
    }
}
