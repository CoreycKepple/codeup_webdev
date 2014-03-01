<?php

require_once('filestore.php');

class TodoData extends Filestore {

	public function read_todo() {

		return $this->read_lines();

	}

	public function save_todo($array) {

		return $this->write_lines($array);
	}

}