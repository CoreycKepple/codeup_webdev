<?php

class Filestore {

    public $filename = '';

    private $is_csv = FALSE;

    public function __construct($filename = '') {
        if (!empty($filename)) {
       	 $this->filename = $filename;
       		if (substr($filename, -3) == 'csv') {
       	 		$this->is_csv = TRUE;
       	 	}	
   		 }
   	}

    public function read(){
    	if ($this->is_csv == TRUE) {
    		return $this->read_csv();
    	}else {
    		return $this->read_lines();
    	}
    }

    public function write($array){
    	if ($this->is_csv == TRUE) {
    		return $this->write_csv($array);
    	}else {
    		return $this->write_lines($array);
    	}
    }

    private function read_lines() {
    	$items = [];
    	if (filesize($this->filename) > 0) {
	    	$handle=fopen($this->filename, 'r');
	    	$contents=fread($handle, filesize($this->filename));
		    fclose($handle);
		    $array = explode("\n", $contents);
		    foreach ($array as $value) {
		    	array_push($items, $value);
		    }
   		} return $items;
	}

    private function write_lines($array) {
    	$handle=fopen($this->filename, 'w');
        $string=implode("\n", $array);
        fwrite($handle, $string);
        fclose($handle);
    }

    private function read_csv()	{
    	$address_book = [];
		if (filesize($this->filename) > 0) {
    	$handle = fopen($this->filename, 'r');
			while(($data = fgetcsv($handle)) !== FALSE) {
				$address_book[] = $data;
			}
		fclose($handle);
		}else {
			$address_book=[];
		}
		return $address_book;
	}
    
    private function write_csv($array) {
    	$handle = fopen($this->filename, 'w');
		foreach ($array as $fields) {
			if($fields != '');
	    	fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}