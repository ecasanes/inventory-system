<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class MY_Controller extends CI_Controller 
	{
	    public function __construct()
	    {
	        parent::__construct(); 
	        $this->is_logged_in();
	        //$this->has_permission();
	    }

	    public function is_logged_in(){

	        $user = $this->session->userdata('is_logged_in');
	        if(!$user){
	        	redirect('login');
	        }

	    }



	    public function check_duplicate($column_name, $value, $ajax = false, $data_type = 'string'){

	        $this->load->model('Account');

	    	$account = new Account();

	    	$result  = $account->check_duplicate($column_name, $value, $data_type);

	    	if($result){
	    		return $result;
	    	}
	        
	        
	    }


	    /*public function markup_permission(){

	    	$this->load->helper('url');
	    	$this->load->model('Account');

	    	$current_page = $this->uri->segment(1).'/'.$this->uri->segment(2);
	    	$role = $this->session->userdata('ilo_session_role');

	    	$account = new Account();

	    	if($account->has_permission($role, $current_page)){
	            return 'hidden';
	        }
	    }*/


	    public function has_permission($markup = false, $markup_uri = ''){

	    	$this->load->helper('url');
	    	$this->load->model('Account');

	    	$current_page = $this->uri->segment(1).'/'.$this->uri->segment(2);
	    	$role = $this->session->userdata('ilo_session_role');

	    	$account = new Account();

	    	if($markup){

    			if($account->has_permission($role, $markup_uri)){
    				return 'hidden';
	       		}

    		}else{

    			if($account->has_permission($role, $current_page)){
    				redirect('page/no-permission');
	       		}

    		}

	    	
	    }
		
		public function searchterm_handler($searchterm){
			if($searchterm)
			{
				$this->session->set_userdata('searchterm', $searchterm);
				return $searchterm;
			}
			elseif($this->session->userdata('searchterm'))
			{
				$searchterm = $this->session->userdata('searchterm');
				return $searchterm;
			}
			else
			{
				$searchterm ="";
				return $searchterm;
			}
		}
		
		
		
		
	}

?>