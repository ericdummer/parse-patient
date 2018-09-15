## Project
MedBridge wants to build a system to accept and store a many different types of patient records. A system exists to store the expected patient data but we must transform the different inputs to fit our expected data model. Create a system which accepts the two example patient records provided and return the data formatted as described below. One goal of the system is to allow for the addition of new formats of input easily.

# Expected data
MedBridge's storage service expects a JSON object with the list of fields:
{
    "first_name":"Steve", // Patient's first name stored as a string
    "last_name":"Test", // Patient's last name stored as a string
    "external_id":"123", // Unique ID of the patient provided by the EMR
    "date_of_birth":"2000-01-31" // Patient's date of birth
}
