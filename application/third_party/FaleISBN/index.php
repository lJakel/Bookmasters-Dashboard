<?php

require_once 'Isbn.php';
require_once 'Check.php';
require_once 'CheckDigit.php';
require_once 'Hyphens.php';
require_once 'Translate.php';
require_once 'Validation.php';


$isbn = new Isbn\Isbn();

$array = [
'978-1-04-623095-8',
'978-1-04-458132-8',
'978-1-08-458132-6'


];
foreach ($array as $value) {
   $value = $isbn->hyphens->removeHyphens($value);
   echo $isbn->hyphens->addHyphens($value) . "<br>";
   //$isbnNew = $isbn->hyphens->addHyphens($value);
   //echo $isbn->translate->to10($isbnNew). "<br>";
}
