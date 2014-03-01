<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') {
        if (!empty($filename)) {
       	 $this->filename = $filename;
        }else {
        	return;
        }
    }

    function read_lines() {
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

    function write_lines($array) {
    	$handle=fopen($this->filename, 'w');
        $string=implode("\n", $array);
        fwrite($handle, $string);
        fclose($handle);
    }

    function read_csv()	{
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
    
    function write_csv($array) {
    	$handle = fopen($this->filename, 'w');
		foreach ($array as $fields) {
			if($fields != '');
	    	fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}