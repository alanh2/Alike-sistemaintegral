<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_logged_in()
    {
		if($this->session->userdata('logged_in'))
		{
			//$session_data = $this->session->userdata('logged_in');
			//$data['username'] = $session_data['username'];
			//$this->load->view('home_view', $data);
		}
		else
		{
			//If no session, redirect to login page
			//redirect('login', 'refresh');
		}
    }
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}
}

?>