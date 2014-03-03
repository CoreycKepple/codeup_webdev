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

}