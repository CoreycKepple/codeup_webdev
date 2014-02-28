<?php 
class AddressStore {
	public $filename = '';
	
	public function __construct($filename = ''){
        $this->filename = $filename;
    }
	
	public function openFile(){
		$handle = fopen($this->filename, 'r');
		if (!empty($this->filename) && filesize($this->filename) > 10) {
			while(($data = fgetcsv($handle)) !== FALSE) {
				$address_book[] = $data;
			}
		}else {
			$address_book=[];
		}
		fclose($handle);
		return $address_book;
	}

	public function saveFile($address_book){
		$handle = fopen($this->filename, 'w');
		foreach ($address_book as $fields) {
			if($fields != '');
	    	fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}