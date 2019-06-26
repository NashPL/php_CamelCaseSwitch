<?php

$text = $argv[1];
require_once('src/camel/Camel.php');

$text = new Text\Camel($text);
print_r($text->switchCamel());
print("\n");
print_r($text->nToCamel(5));
print("\n");