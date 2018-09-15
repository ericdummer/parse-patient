<?php
/**
 * Created by PhpStorm.
 * User: ericdummer
 * Date: 9/12/18
 * Time: 8:48 PM
 *
 */

abstract class ExtractAbstract {

    /**
     * @var String
     */
    protected $_patientData = null;

    /**
     * @param $data
     * For this implementation this is a TEST ONLY method used to facilitate unit testing. Separating the code that has external
     * dependencies like the file system allows for higher code coverage with out extensive mocking.
     *
     * I also wanted to call out how the typ of this data is inconsistent in the child classes.
     * Something I realized latter but for this exercise I felt it was negligible
     */
    function setPatientData($data)
    {
        $this->_patientData = $data;
    }

    /**
     * @param $newFilePath String
     */
    function setFilePath($newFilePath)
    {
        $this->_filePath = $newFilePath;
    }

    /**
     * @return false|string
     */
    function extract()
    {
        return json_encode([
            "first_name" => $this->getFirstName(),
            "last_name" => $this->getLastName(),
            "external_id" => $this->getExternalId(),
            "date_of_birth" => $this->getDataOfBirth()
        ], JSON_PRETTY_PRINT);
    }

    function getFirstName(){}
    function getLastName(){}
    function getExternalId(){}
    function getDataOfBirth(){}

    /**
     * @param $utc
     * @return null|string
     */
    function formatUTCString($utc) {
        $date = date_parse($utc);
        if (isset($date["year"], $date["year"], $date["day"])) {
            return join("-", [$date["year"],$date["month"], $date["day"]]);
        } else {
            /* explicitly return */
            return null;
        }
    }
}