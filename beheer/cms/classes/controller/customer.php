<?php

include ('generator.php');

class Controller_Customer extends Controller_Application
{
	public function action_index()
	{
		$data['customers'] = Model_Customer::find('all');
		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/index', $data);
	}

	public function action_view($id = null)
	{
		$data['customer'] = Model_Customer::find($id);
		$this->template->title = "Customer";
		$this->template->content = View::forge('customer/view', $data);
	}

	public function action_create($id = null)
	{
		$errors = array();

		try
		{
			Auth::create_user(Input::post('company_name'), Input::post('password'), Input::post('email'), 1);
		}
		catch(SimpleUserUpdateException $e)
		{
			switch($e->getMessage())
			{
				case 'Username already exists':
					array_push($errors, 'Bedrijfsnaam reeds in gebruik.');
				break;
				case 'Email address already exists':
					array_push($errors, 'Emailadres reeds in gebruik.');
				break;
			}
		}

		if (Input::method() == 'POST' && count($errors) == 0)
		{
			$val = Model_Customer::validate('create');
				
			if ($val->run())
			{
				
				$user = Model_User::find('last');	

				$customer = Model_Customer::forge(array(
					'company_name' => Input::post('company_name'),
					'first_name' => Input::post('first_name'),
					'last_name' => Input::post('last_name'),
					'email' => Input::post('email'),
					'phone' => Input::post('phone'),
					'street' => Input::post('street'),
					'street_number' => Input::post('street_number'),
					'zip' => Input::post('zip'),
					'city' => Input::post('city'),
					'country' => Input::post('country'),
					'user_id' => $user->id,
				));

				//create user
			
				

				//email klant
				if(Input::post('emailClient'))
				{	
					$data = array(

						'name' => Input::post('company_name'),
						'password' => Input::post('password'),
						'title' => 'Account creation',
						'content' => 'Thank you for choosing Co/motion clippings. An account has been created for you. To log in and start using our service click',
					);

					$email = Email::forge();
					$email->from('info@comotion.nl', 'Comotion');
					$email->to(Input::post('email'), Input::post('company_name'));
					$email->subject('Welkom to Comotion Clippings');
					$email->attach(DOCROOT.'cms/assets/img/mail/spacer.gif', true, 'cid:spacer');
					$email->attach(DOCROOT.'cms/assets/img/mail/widget-logo4.png', true, 'cid:logo');
					$email->attach(DOCROOT.'cms/assets/img/mail/widget-hero3.png', true, 'cid:header');
					$email->html_body(\View::forge('email/template', $data), true, false);
					//$email->body('Welkom bij Comotion Clippings. U kunt inloggen op blablab.com met '. $name. ' en '. $password);	
					$email->send();	

				}

				if ($customer and $customer->save())
				{
					Session::set_flash('success', 'Added customer #'.$customer->id.'.');

					Response::redirect('customer');
				}

				else
				{
					Session::set_flash('error', 'Could not save customer.');
				}
			}
			else
			{
				Session::set_flash('error', $val->show_errors());
			}
		}

		$data['errors'] = $errors;
		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/create', $data);

	}

	public function action_edit($id = null)
	{
		$customer = Model_Customer::find($id);
		$val = Model_Customer::validate('edit');

		if ($val->run())
		{
			$customer->company_name = Input::post('company_name');
			$customer->first_name = Input::post('first_name');
			$customer->last_name = Input::post('last_name');
			$customer->email = Input::post('email');
			$customer->phone = Input::post('phone');
			$customer->street = Input::post('street');
			$customer->street_number = Input::post('street_number');
			$customer->zip = Input::post('zip');
			$customer->city = Input::post('city');
			$customer->country = Input::post('country');

			if ($customer->save())
			{
				Session::set_flash('success', 'Updated customer #' . $id);

				Response::redirect('customer');
			}

			else
			{
				Session::set_flash('error', 'Could not update customer #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$customer->company_name = $val->validated('company_name');
				$customer->first_name = $val->validated('first_name');
				$customer->last_name = $val->validated('last_name');
				$customer->email = $val->validated('email');
				$customer->phone = $val->validated('phone');
				$customer->street = $val->validated('street');
				$customer->street_number = $val->validated('street_number');
				$customer->zip = $val->validated('zip');
				$customer->city = $val->validated('city');
				$customer->country = $val->validated('country');

				Session::set_flash('error', $val->show_errors());
			}
			
			$this->template->set_global('customer', $customer, false);
		}
		
		$data['labels'] = Model_Label::find('all');
		$this->template->title = "Customers";
		$this->template->content = View::forge('customer/edit', $data);

	}

	public function action_delete($id = null)
	{
		$customer = Model_Customer::find($id);
		$user = Model_User::find($customer->user_id);
		$customer->delete();
		$user->delete();

		Response::redirect('customer');

	}
	
	public function action_deleteLabel($customer_id, $label_id)
	{
		$customer = Model_Customer::find($customer_id);		
		unset($customer->labels[$label_id]);
		$customer->save();

		$clippings = Model_Clipping::find('all', array(
		    'where' => array(
		        array('customer_id', $customer_id),
		        array('label_id', $label_id),
		    ),
		));

		foreach ($clippings as $clipping) 
		{
			$clipping->delete();	
		}	

		Response::redirect('customer/edit/' . $customer_id);
	}
	
	public function action_setLabel()
	{
		$label = Input::post('label');
		$labelFromList = Input::post('labelFromList');
		$customer_id = Input::post('customer_id');
		
		if(!empty($label))
		{
			$labelModel = new Model_Label();
			$labelModel->name = $label;
			$labelModel->save();
			
			$customerModel = Model_Customer::find($customer_id);
			$customerModel->labels[] = $labelModel;
			$customerModel->save();
		}
		else
		{
			$labelModel = Model_Label::find($labelFromList);
			$customerModel = Model_Customer::find($customer_id);
			$customerModel->labels[] = $labelModel;
			$customerModel->save();
		}
		
		Response::redirect('customer/edit/' . $customer_id);
	}
	
	public function action_setClipping()
	{	
		if (Upload::is_valid())
		{	

		  	Upload::save();
			$uploadInfo = Upload::get_files();

			$labelModel = Model_Label::find(Input::post('clippingLabel'));
			$customer_id = Input::post('customer_id');
			
			$publicationdate = Input::post('publicationdate');
			list($month, $day, $year) = explode('/', $publicationdate);
			$publicationStamp = mktime(0, 0, 0, $month, $day, $year);

			$clipping = new Model_Clipping();
			$clipping->name = Input::post('name');
			$clipping->publicationdate = $publicationStamp;
			$clipping->label = $labelModel;
			$clipping->description = Input::post('description');
			$clipping->customer_id = $customer_id;
			$clipping->pdf_url = '';
			$clipping->thumb = '';
			$clipping->save();

			$generator = new Generator($clipping->id, $uploadInfo[0]['saved_as']);

			$pdfModel = new Model_Pdf();
			$pdfModel->clipping_id = $clipping->id;
			$pdfModel->url = $generator->pdfUrl;
			$pdfModel->save();

			$imgArray = $generator->imgArr;
			
			for($i=0; $i < count($imgArray); $i++)
			{
				$imageModel = new Model_Image();
				$imageModel->clipping_id = $clipping->id;
				$imageModel->url = $imgArray[$i];
				$imageModel->save();

				if($i == 0)
				{
					Image::load(FILEPATH . 'clippings/' . $clipping->id . '/' .  $imageModel->url)
						->crop_resize(200, 300)
						->save(FILEPATH . 'clippings/' . $clipping->id . '/' . 'thumb.jpg');
				}
			}

			$clipping->thumb = 'thumb.jpg';
			$clipping->pdf_url = $generator->pdfUrl;
			$clipping->save();
		}

		

		Response::redirect('customer/edit/' . $customer_id);
		#$this->template->content = View::forge('customer/imgloader');
	}
	
	public function action_deleteClipping($customer_id, $clipping_id)
	{
		$clipping = Model_Clipping::find($clipping_id);
		$clipping->delete();
		
		try{
			File::delete_dir(FILEPATH.'clippings/' .$clipping_id);
		}catch(InvalidPathException $e){

		};
		

		Response::redirect('customer/edit/' . $customer_id);
	}

	public function action_resetPassword()
	{
		$name = Input::post('company_name');
		$emailRecipent = Input::post('email');
		$password = Input::post('password');
		$emailClient = Input::post('emailClient');
		$customer_id = Input::post('customer_id');


		$userSelected = Model_User::find('all', array('where' => array('email' => $emailRecipent)));
		$user = array_shift($userSelected);

		$user->password = Auth::instance()->hash_password($password);
		$user->save();



		if($emailClient)
		{
			$data = array(

				'name' => $name,
				'password' => $password,
				'title' => 'Password reset',
				'content' => 'You have reset your password. Please conserve this email as it holds your new credentials.',
			);

			$email = Email::forge();
			$email->from('info@comotion.nl', 'Comotion');
			$email->to($emailRecipent, $name);
			$email->subject('Welcome at Comotion Clippings');
			$email->attach(DOCROOT.'cms/assets/img/mail/spacer.gif', true, 'cid:spacer');
			$email->attach(DOCROOT.'cms/assets/img/mail/widget-logo4.png', true, 'cid:logo');
			$email->attach(DOCROOT.'cms/assets/img/mail/widget-hero3.png', true, 'cid:header');
			$email->html_body(\View::forge('email/template', $data), true, false);
			//$email->body('Welkom bij Comotion Clippings. U kunt inloggen op blablab.com met '. $name. ' en '. $password);	
			$email->send();	
		}

		Response::redirect('customer/edit/' . $customer_id);
	}

	public function action_sendClippingMail()
	{
		$customer_id = Input::post('customer_id');

		if(isset($customer_id))
		{
			$user = Model_Customer::find($customer_id);
			$data = array(

				'name' => $user->company_name,
				'username' => $user->first_name . " " . $user->last_name,
				'title' => 'We wanted to let you know that there are new clippings available.',
				'content' => 'To view them just click this link and login',
			);
			$email = Email::forge();
			$email->from('info@comotion.nl', 'Comotion');
			$email->to($user->email, $user->company_name);
			$email->subject('New clippings available');
			$email->attach(DOCROOT.'cms/assets/img/mail/spacer.gif', true, 'cid:spacer');
			$email->attach(DOCROOT.'cms/assets/img/mail/widget-logo4.png', true, 'cid:logo');
			$email->attach(DOCROOT.'cms/assets/img/mail/widget-hero3.png', true, 'cid:header');
			$email->html_body(\View::forge('email/call-to-action', $data), true, false);
			//$email->body('Welkom bij Comotion Clippings. U kunt inloggen op blablab.com met '. $name. ' en '. $password);	
			$email->send();
		}

		Response::redirect('customer/edit/' . $customer_id);
	}
}