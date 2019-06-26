<?php

namespace text;
class Camel
{
    private $originalText;
    public function __construct($text) {
        $this->originalText = $text;
    }

    public function switchCamel()
    {
        $strArray = str_split($this->originalText);
        foreach ($strArray as $k => $v) {
            if (ctype_upper($v)) {
                $strArray[$k] = strtolower($v);
            } else {
                $strArray[$k] = strtoupper($v);
            }

        }
        return join($strArray);
    }
}