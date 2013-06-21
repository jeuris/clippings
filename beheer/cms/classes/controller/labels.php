<?php
class Controller_Labels extends Controller_Application
{

	public function action_index()
	{
		$data['labels'] = Model_Label::find('all');
		$this->template->title = "Labels";
		$this->template->content = View::forge('labels/index', $data);
	}

	public function action_view($id = null)
	{
		$data['label'] = Model_Label::find($id);

		$this->template->title = "Label";
		$this->template->content = View::forge('labels/view', $data);
	}

	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Label::validate('create');
			
			if ($val->run())
			{
				$label = Model_Label::forge(array(
					'name' => Input::post('name'),
				));

				if ($label and $label->save())
				{
					Session::set_flash('success', 'Added label #'.$label->id.'.');

					Response::redirect('labels');
				}

				else
				{
					Session::set_flash('error', 'Could not save label.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$this->template->title = "Labels";
		$this->template->content = View::forge('labels/create');

	}

	public function action_edit($id = null)
	{
		$label = Model_Label::find($id);
		$val = Model_Label::validate('edit');

		if ($val->run())
		{
			$label->name = Input::post('name');

			if ($label->save())
			{
				Session::set_flash('success', 'Updated label #' . $id);

				Response::redirect('labels');
			}
			else
			{
				Session::set_flash('error', 'Could not update label #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$label->name = $val->validated('name');

				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('label', $label, false);
		}

		$this->template->title = "Labels";
		$this->template->content = View::forge('labels/edit');

	}

	public function action_delete($id = null)
	{
		if ($label = Model_Label::find($id))
		{
			$label->delete();

			Session::set_flash('success', 'Deleted label #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete label #'.$id);
		}

		Response::redirect('labels');

	}


}