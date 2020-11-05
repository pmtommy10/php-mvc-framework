<?php

namespace App\Core;

class Translate
{
    static function get(string $text)
    {
        foreach (TRANSLATE as $key => $arr) {
            if ($key === $text) {
                if ('th' === lang) return $key;
                return !empty($arr[lang]) ? $arr[lang] : $key;
            }
        }
        return $text;
    }

    static function getAll(bool $returnJson = true) {
        if ($returnJson) {
            echo json_encode(TRANSLATE);
            return;
        }
        return TRANSLATE;
    }
}