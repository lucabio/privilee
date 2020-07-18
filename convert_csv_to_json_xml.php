<?php

echo "File in input $argv[1]\n";

require __DIR__ . '/vendor/autoload.php';
use CsvConverter\csvJsonXmlConverter;

$converter = new csvJsonXmlConverter($argv);
$converter->generateJSONfile("privileeOffers");
$converter->generateXMLfile("privileeOffers");


?>