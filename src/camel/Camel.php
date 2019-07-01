<?php

namespace Text;

/**
 * A class to transform a text character cases between lower and upper. 
 */
class Camel
{
    private $originalText;
    public function __construct($text) {
        if (is_null($text) || $text === '' || empty($text)) {
            throw new \InvalidArgumentException('Only Accepts Strings value longer than 1 character. Input was: '. $text);
        }

        if (!is_string($text)) {
            throw new \InvalidArgumentException('Only Accepts string type input. Provided: ' . gettype($text));
        }

        $this->originalText = $text;
    }

    /**
     *  A function to switch text from upper to lower and vice versa
     *  @return String A transformed text
     */
    public function switchCase() : string
    {
        $strArray = str_split($this->originalText);
        foreach ($strArray as $k => $v) {
            $strArray[$k] = (ctype_upper($v)) ? strtolower($v) : strtoupper($v);
        }
        return join($strArray);
    }

    /**
     *  A function to switch text from upper to lower and vice versa but every n character in the string
     *  @param Int a iteration of which n character has to be switched.
     *  @return String A transformed text. 
     * 
     */
    public function switchNToCase($n = 2) : string
    {
        if($n === 0) { return $this->originalText; } // If N is 0 then we do not transform
        if($n < 0 || is_null($n) || empty($n)) { throw New \InvalidArgumentException('Please provide only positive numbers. Provided: '. $n); }
        $strArray = str_split($this->originalText);
        array_unshift($strArray, "");
        unset($strArray[0]);
        for ($i = 0; $i <= count($strArray); $i = $i + $n) {
            if(!empty($strArray[$i])){
                $strArray[$i] = (ctype_upper($strArray[$i])) ? strtolower($strArray[$i]) : strtoupper($strArray[$i]);
            }
        }
        return join($strArray);
    }

    public function getOriginalText()
    {
        return $this->originalText;
    }
}