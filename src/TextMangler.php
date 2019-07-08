<?php 
namespace Text;

/**
 * A class to get simple counts on a provided string.
 * 
 */
class TextMangler
{
    private $string;
    public function __construct($text)
    {
        if (is_null($text) || $text === '' || empty($text)) {
            throw new \InvalidArgumentException('Only Accepts Strings value longer than 1 character. Input was: '. $text);
        }

        if (!is_string($text)) {
            throw new \InvalidArgumentException('Only Accepts string type input. Provided: ' . gettype($text));
        }
        $this->string = strtolower($text);
    }

    /**
     * Gets provided string
     * @return String
     */
    public function getString() : string
    {
        return $this->string;
    }

    /**
     * Function to get Count on a string.
     * @param Bool Check if includes none Alphanumeric characters in the count
     * @return Array Returns array with the count and percentage count. 
     */
    public function getSymbolCount($withPunctuation = false) : array
    {
        if ($withPunctuation == false) {
            $string = preg_replace("/[^A-Za-z0-9]/", '', $this->string);
        } else {
            $string = preg_replace("/[ ]/", '', $this->string);
        }

        $ret = array();
        $ret['count'] = $this->doCharCount($string);
        $ret['percent'] = $this->doPercentCount($ret['count']);
        return $ret;
      
    }

    /**
     * Function to get Count of a none Alphanumeric Characters from a string.
     * @return Array Returns array with the count and percentage count. 
     */
    public function getNoneAlphanumericCount() : array
    {
        $string = preg_replace("/[A-Za-z0-9]/", '', $this->string);
        $ret = array();
        $ret['count'] = $this->doCharCount($string);
        $ret['percent'] = $this->doPercentCount($ret['count']);
        return $ret;
    }

    /**
     * Private function counts percentage of a provided array
     * @param Array A set of Key Value pairs with a numeric count
     * @return Array A set of Key Value pairs with percentage count. 
     */
    private function doPercentCount($count) : array
    {
        $total = array_sum($count);
        $percent = array();
        foreach ($count as $k => $v) {
            $percent[$k] = ($v/$total*100);
        }
        return $percent;
    }

    /**
     * A function which counts characters in the string.
     * @param String String value.
     * @return Array A Count of characters in the String.
     */
    private function doCharCount($string) : array
    {
        $strArray = str_split($string);
        $procString = array();

        foreach ($strArray as $v) {
            (isset($procString[$v])) ? $procString[$v]++ : $procString[$v] = 1;
        }

        ksort($procString);
        return $procString;
    }

}