<?php

class Controller_Admin extends Controller_Base {

	public $template = 'admin/template';

	public function before()
	{
		parent::before();

		//File::delete_dir(FILEPATH.'collections');
		//exit;

		if ( ! Auth::member(100) and Request::active()->action != 'login')
		{
			Response::redirect('login');
		}
	}
	
	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('customer');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				$auth = Auth::instance();
				
				// check the credentials. This assumes that you have the previous table created
				if (Auth::check() or $auth->login(Input::post('email'), Input::post('password')))
				{
					// credentials ok, go right in
					Session::set_flash('notice', 'Welcome, '.$current_user->username);
					Response::redirect('admin');
				}
				else
				{
					$this->template->set_global('login_error', 'Verkeerde gebruikersnaam / wachtwoord');
				}
			}
		}

		$this->template->title = 'Login';
		$this->template->content = View::forge('admin/login', array('val' => $val));
	}
	
	/**
	 * The logout action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{		
		Auth::logout();
		Response::redirect('admin');
	}

	/**
	 * The index action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		Response::redirect('customer');
	}

}

/* End of file admin.php */