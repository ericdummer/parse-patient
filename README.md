# Parse Patient
Written for a job interview in September of 2018

#Notes:

1. to run using the provided files: `php run.php`
2. to run using a new file `./parse-patient json mypatient.json`
2. I started the application at a position where all of the files and their types have been identified. 
3. I used a factory pattern with inheritance and polymorphism principles. 
4. I used an abstract class that has some shared function in it. It also defines multiple methods that must be implemented in the child classes.
5. Although, I have not included unit tests, I've focused on structuring the classes in a testable way. 
6. With the exception of getPatientData (XmlExtract|JsonExtract) all methods are testable without providing test files or mocking the file system. This allows for the maximum code coverage without maintaining test files.
