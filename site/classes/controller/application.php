<?php

class Controller_Application extends Controller_Login {

	public $template = 'template';
	public $view_data = array();

	public function set_data($arr)
	{
		$this->view_data = $arr;
	}

	public function get_data()
	{
		return $this->view_data;
	}

}