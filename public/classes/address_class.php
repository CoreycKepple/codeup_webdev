<?php 

require_once('filestore.php');

class AddressDataStore extends Filestore {

	function __constructor(){
		
	}

    function read_address_book()
    {
        return $this->read_csv();
    }

    function write_address_book($addresses_array) 
    {
        return $this->write_csv($addresses_array);
    }

}