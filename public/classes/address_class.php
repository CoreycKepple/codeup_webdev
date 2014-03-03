<?php 

require_once('filestore.php');

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

    function validate($input,$name){
    if ((empty($input))  || (strlen($input) > 124)) {
        if (empty($input)) {
            $error = 'You did not enter Recipients "{$name}". Please enter missing information.';    
        }elseif (strlen($input) > 124) {
                throw new Exception('Post was greater than 124 characters');
        }
    }
    }
}