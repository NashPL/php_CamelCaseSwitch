<?php 
namespace Text;

class TextMangler
{
    private $string;
    public function __construct($text)
    {
        $this->string = strtolower($text);
    }

    public function getString() : string
    {
        return $this->string;
    }

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

    public function getNoneAlphanumericCount() : array
    {
        $string = preg_replace("/[A-Za-z0-9]/", '', $this->string);
        $ret = array();
        $ret['count'] = $this->doCharCount($string);
        $ret['percent'] = $this->doPercentCount($ret['count']);
        return $ret;
    }

    private function doPercentCount($count) : array
    {
        $total = array_sum($count);
        $percent = array();
        foreach ($count as $k => $v) {
            $percent[$k] = ($v/$total*100);
        }
        return $percent;
    }

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