# php_CamelCaseSwitch

php_CamelCaseSwitch is a PhP Library to manipulate text and generate simple text analysis numbers.

## Installation

Simply just download the library and iniatlise it in your project. 

## Usage

```PHP
include_once('src/Camel.php');
include_once('src/TextMangler.php');

use Text\TextMangler;
use Text\Camel;

$txtMangler = new TextMangler("This is a String!"); //Initialize the object
$camel = new Camel("This is a String!"); //Initialize the object

$result = $txtMangler->getSymbolCount(false); //Preforms text analysis passing a true variable will include symbols.
$result = $txtMangler->getNoneAlphanumericCount(); // Gets analysis of symbols in the string.

$result = $camel->switchCase(); // Switches lower to upper and upper to lower case in the string
$result = $camel->switchNtoCase(2); //Switches lower to upper and upper to lower case in the string every N character. 
...
```

## Contributing
This is a closed project as part of personal portfolio.

## License
[MIT](https://choosealicense.com/licenses/mit/)