<?php
/**
 * Created by PhpStorm.
 * User: ericdummer
 * Date: 9/12/18
 * Time: 8:29 PM
 */
include_once  __DIR__ . "/ExtractAbstract.php";

class XmlExtract extends extractAbstract
{
    protected $_filePath = "";
    protected $_patientData = null;

    function getPatientData()
    {
        if (is_null($this->_patientData)) {
            if (file_exists($this->_filePath)) {
                try {
                    $this->_patientData = simplexml_load_file($this->_filePath);
                } catch (Exception $e) {
                    error_log("ERROR Reading file");
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
        return isset($patientData->PatientDemographics->FirstName) ?
            $patientData->PatientDemographics->FirstName->__toString()
            : null;

    }

    function getLastName()
    {
        $patientData = $this->getPatientData();
        return isset($patientData->PatientDemographics->LastName) ?
            $patientData->PatientDemographics->LastName->__toString()
            : null;
    }

    function getExternalId()
    {
        $patientData = $this->getPatientData();
        return isset($patientData->UniqueIdentifiers->MasterPatient->MasterPatientID) ?
            $patientData->UniqueIdentifiers->MasterPatient->MasterPatientID->__toString()
            : null;

    }

    function getDataOfBirth()
    {
        $patientData = $this->getPatientData();

        try{
            $dob = isset($patientData->PatientDemographics->DOB) ?
                $patientData->PatientDemographics->DOB->__toString()
                : null;
            return $this->formatUTCString($dob);
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