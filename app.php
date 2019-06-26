<?php

$text = $argv[1];
$type = (isset($argv[2])) ? $argv[2] : "switch";

require_once('src/camel/Camel.php');

$text = new text\Camel($text);
print_r($text->switchCamel());
print("\n");
print_r($text->nToCamel(5));
print("\n");