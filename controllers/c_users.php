<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 


	
    public function calendar() {
        $this->template->content = View::instance('v_users_calendar');
		$this->template->title   = "Calendar";
		
		echo $this->template;
    }
	
	
	
    public function tablesorter() {
        $this->template->content = View::instance('v_users_tablesorter');
		$this->template->title   = "Info";
		
		echo $this->template;
    }

	
	
    public function tabsheet() {
        $this->template->content = View::instance('v_users_tabsheet');
		$this->template->title   = "Tabs";
		
		echo $this->template;
    }
	

	
    public function signup() {
        $this->template->content = View::instance('v_users_signup');
		$this->template->title   = "Sign Up";
		
		echo $this->template;
    }



    public function p_signup()  {
	
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
		echo 'You\'re signed up';
    }
	
	
	public function login($error = NULL) {


		$this->template->content = View::instance('v_users_login');
		$this->template->content->error = $error;


        echo $this->template;

	}
	
	public function p_login() {

		$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";

		$token = DB::instance(DB_NAME)->select_field($q);

		if(!$token) {

			Router::redirect("/users/login/error");

		} else {


			setcookie("token", $token, strtotime('+2 weeks'), '/');

			Router::redirect("/");

		}

	}
	
	public function profile() {

		if(!$this->user) {
			Router::redirect('/users/login');
		}

		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of".$this->user->first_name;

		echo $this->template;
	}
	
	public function logout() {

		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

		$data = Array("token" => $new_token);

		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

		setcookie("token", "", strtotime('-1 year'), '/');

		Router::redirect("/");

	}

	
	

} # end of the class
