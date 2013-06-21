<?php

class Controller_Detail extends Controller_Application
{
	public function before()
	{
		parent::before();
	}

	public function action_index($id)
	{
		$this->id = $id;

		$this->current_user->id;

		$customer = Model_Customer::find()
			->where('user_id', '=', $this->current_user->id)
			->get_one();

		$this->customerId = $customer->id;


		$data['clippings'] = Model_Clipping::find('all', array('where' => array('id' => $id)));

		if(!$data['clippings'])	\Response::redirect('/');

		$data['images'] = Model_Image::find('all', array('where' => array('clipping_id' => $id)));
		$data['customer'] = $this->customerId;


		$this->template->title = "detail";
		$this->template->content = view::forge('detail/index', $data);
	}

}