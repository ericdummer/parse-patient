<?php
/**
 * Created by PhpStorm.
 * User: ericdummer
 * Date: 9/12/18
 * Time: 8:29 PM
 */
include_once  __DIR__ . "/ExtractAbstract.php";

class JsonExtract extends extractAbstract
{
    /** @var string Local path of the file to parse */
    protected $_filePath = "";
    protected $_patientData = null;

    /**
     * This is and example of what I call a lazy loading function. Every function that calling this function can be
     * sure that the data will be loaded. However it it only loaded once.
     *
     * @return array|mixed|null
     */
    function getPatientData()
    {
        if (is_null($this->_patientData)) {
            if (file_exists($this->_filePath)) {
                try {
                    $fp = fopen($this->_filePath, 'r');
                    $fileData = fread($fp, 4096);
                    if ($fileData !== false) {
                        $this->_patientData = json_decode($fileData);
                    } else {
                        $this->_patientData = [];
                    }
                } catch (Exception $e) {
                    error_log("ERROR Reading file: " . $this->_filePath);
                    echo $e->getMessage() . "\n";
                }
            } else {
                return [];
            }
        }
        return $this->_patientData;
    }


    function getFirstName()
    {
        $patientData = $this->getPatientData();
        /**
         * If starting from scratch, I like to code with NOTICES turned on (error_reporting = E_ALL)
         * isset prevents a Notice if there is no "firstName" property
         * avoid warnings and notices
         */
        return isset($patientData->firstName) ? $patientData->firstName : null;
    }

    function getLastName()
    {
        $patientData = $this->getPatientData();
        /* avoid warnings and notices */
        return isset($patientData->lastName) ? $patientData->lastName : null;
    }

    function getExternalId()
    {
        $patientData = $this->getPatientData();
        /* avoid warnings and notices */
        return isset($patientData->patientUid) ? $patientData->patientUid : null;
    }

    function getDataOfBirth()
    {
        $patientData = $this->getPatientData();
        try{
            $bd = isset($patientData->dateOfBirth) ? $patientData->dateOfBirth : null;
            return $this->formatUTCString($bd);
        } catch(Exception $e) {
            $recordAsString = substr(var_export($patientData, true), 0, 20);
            $message = "Could not parse UTC for patient - patient record: " . $recordAsString;
            error_log($message);
            /**
             * Depending on how you want to handle errors you could throw the exception again.
             * I find it best to attempt to log some identifier for the record so debugging is easier
             */
            /* explicitly return */
            return null;
        }
    }

}