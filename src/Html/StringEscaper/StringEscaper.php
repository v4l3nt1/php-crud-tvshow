<?php

declare(strict_types=1);

namespace Html\StringEscaper;

trait StringEscaper
{
    public function escapeString(?string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5) ?? '';
    }

    public function stripTagsAndTrim(?string $text): string
    {
        return trim(strip_tags($text)) ?? '';
    }
}
