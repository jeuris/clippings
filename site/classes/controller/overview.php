<?php

class Controller_Overview extends Controller_Application
{
	private $id;
	public $sorted_array = array();

	public function action_index()
	{

		$this->id = $this->current_user->id;

		$customer = Model_Customer::find()
			->where('user_id', '=', $this->id)
			->get_one();
			
		$this->customerId = $customer->id;
		
		$data = Model_Clipping::find('all', array('where' => array('customer_id' => $customer->id)));

		if(count($data) > 0)
		{
			$data = Arr::sort($data, 'label');
			$this->get_labels($data);

			$data['clippings'] = $this->sorted_array;
			//$this->view_data = $this->sorted_array;
			parent::set_data($this->sorted_array);
		}

		$this->template->title = "overview";
		$this->template->content = view::forge('overview/index', $data);
	}

	private function get_labels($data)
	{
		
		$key = '';
		$array = array();
		
		foreach ($data as $clipping)
		{
			if($clipping->label->name != $key)
			{
				
				$this->sorted_array[$clipping->label->name] = array();
				$key = $clipping->label->name;
				array_push($this->sorted_array[$clipping->label->name], $clipping);

			} else {
				array_push($this->sorted_array[$clipping->label->name], $clipping);
			}
		}
		
	}
}