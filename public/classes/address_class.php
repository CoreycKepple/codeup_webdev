<?php 

require_once('filestore.php');

class EmptyException extends Exception{}

class LongException extends Exception {}

class AddressDataStore extends Filestore {

	function __constructor() {

        $this->strtolower(filename);
        parent:: __contructor();
		
	}

    function read_address_book() {

        return $this->read();
    }

    function write_address_book($addresses_array)  {

        return $this->write($addresses_array);
    }

    function validate($string) {
        if (empty($string)) {
            try{
            throw new EmptyException("You did not enter required information. Please enter missing information.");
            }catch (EmptyException $e) {
                return $error = 'Error: ' . $e->getMessage();

            }
        }elseif (strlen($string) > 124) {
            try{
            throw new LongException('Input field was greater than 124 characters');
            }catch (LongException $e) {
                return $error = 'Error: ' . $e->getMessage();
            }
        }
    }
    
}