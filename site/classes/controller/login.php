<?php

class Controller_Login extends Controller_Base {

	public $template = 'template';

	public function before()
	{
		parent::before();

		if ( ! Auth::member(1) and Request::active()->action != 'login')
		{
			Response::redirect('login');
		}
		
	}
	
	public function action_login()
	{

		// Already logged in
		//Auth::check() and Response::redirect('overview/index');

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
					Response::redirect('overview');
				}
				else
				{
					$this->template->set_global('login_error', 'Check your username or password');
				}
			}
		}
		
		$this->template->title = 'Login';
		$this->template->content = View::forge('login/index', array('val' => $val));
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
		Response::redirect('login');
	}

	/**
	 * The index action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		Response::redirect('overview');
	}

}

/* End of file admin.php */