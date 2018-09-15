<?php
/**
 * Created by PhpStorm.
 * User: ericdummer
 * Date: 9/12/18
 * Time: 7:47 PM
 */


/**
 *  Normally I would rely on some autoloaders
 */

include __DIR__ . "/extractors/Factory.php";
include __DIR__ . "/extractors/JsonExtract.php";
include __DIR__ . "/extractors/XmlExtract.php";

$testData= [
    [
        "type" => "json",
        "filePath" =>  __DIR__ . "/SDE Project/example_data/patient2.json"
    ],
    [
        "type" => "xml",
        "filePath" => __DIR__ . "/SDE Project/example_data/patient1.xml"
    ]
];

foreach ($testData as $test) {

    $extractor = Factory::getByType($test["type"]);
    $extractor->setFilePath($test["filePath"]);
    $result = $extractor->extract();
    print_r("Results for format: " . $test["type"] . "\n");
    print_r($result);
    echo "\n";
}




