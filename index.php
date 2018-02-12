<?php
require_once 'vendor/autoload.php';
require_once 'Converter.php';

$config = array(
    'templateDir'   => __DIR__.'/files/template',
    'dataDir'       => __DIR__.'/files/template/data',
    'resultDir'     => __DIR__.'/files/build',
    'base_url'      => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'files/template/',
);

$convert = new Converter($config);

//$convert->asHtml('example.html', 'example.json');
//$convert->asPdf('example.html', 'example.json');
