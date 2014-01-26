<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function index()
	{
		$this->dashboard();
	}


	//reports dashboard
	public function dashboard(){

		$data = array(
			'title' => 'Reports Dashboard',
          	'main_group' => '',
          	'description' => ''
        );
		$this->load->view('bootstrap/header', $data);
		$this->load->view('reports-dashboard');
		$this->load->view('bootstrap/footer');

	}
	
	public function bar_charts(){

		$this->load->model('Record');
		$record = new Record();
		
		$model_data = array(
			'widget_status' => '',
			'widget_arrow' => 'up',
			'gender' => '',
			'status' => '',
			'occupation' => '',
			'property' => '',
			'tragedy' => '',
			'bar_chart_type' => ''
		);


		$age_bracket_array[0] = array(15,25);
		$age_bracket_array[1] = array(26,35);
		$age_bracket_array[2] = array(36,45);
		$age_bracket_array[3] = array(46,55);
		$age_bracket_array[4] = array(56,65);
		$age_bracket_array[5] = array(66,75);
		
		

		$gender = $this->input->post('gender');
		$status = $this->input->post('status');
		$occupation = $this->input->post('employment');
		$property = $this->input->post('damage');
		$tragedy = $this->input->post('tragedy');
		$bar_chart_type = $this->input->post('bar_chart_type');
		
			

		if($gender){

			$this->session->unset_userdata('bar_chart');

			$stat_bar_chart_array = $record->get_stat_bar_chart_info($gender, $status, $occupation, $property, $tragedy, $bar_chart_type, $age_bracket_array);

			$session_data = array(
				'gender' => $gender,
				'status' => $status,
				'occupation' => $occupation,
				'property' => $property,
				'tragedy' => $tragedy,
				'bar_chart_type' => $bar_chart_type
			);

			$this->session->set_userdata(array('bar_chart' => $session_data));
			
			$model_data = array(
				'stat_bar_chart_array' => $stat_bar_chart_array,
				'widget_status' => 'collapsed',
				'widget_arrow' => 'down',
				'gender' => $gender,
				'status' => $status,
				'occupation' => $occupation,
				'property' => $property,
				'tragedy' => $tragedy,
				'bar_chart_type' => $bar_chart_type
			);

		}else{

			$bar_chart_session = $this->session->userdata('bar_chart');
			
			if($bar_chart_session){
				$gender = $bar_chart_session['gender'];
				$status = $bar_chart_session['status'];
				$occupation = $bar_chart_session['occupation'];
				$property = $bar_chart_session['property'];
				$tragedy = $bar_chart_session['tragedy'];
				$bar_chart_type = $bar_chart_session['bar_chart_type'];

				$stat_bar_chart_array = $record->get_stat_bar_chart_info($gender, $status, $occupation, $property, $tragedy, $bar_chart_type, $age_bracket_array);
			
				$model_data = array(
					'stat_bar_chart_array' => $stat_bar_chart_array,
					'widget_status' => 'collapsed',
					'widget_arrow' => 'down',
					'gender' => $gender,
					'status' => $status,
					'occupation' => $occupation,
					'property' => $property,
					'tragedy' => $tragedy,
					'bar_chart_type' => $bar_chart_type
				);

			}
			

		}

		$data = array(
			'title' => 'Bar Charts',
          	'main_group' => '',
          	'description' => 'The options below will help you plot your desired bar chart'
        );

		$this->load->view('bootstrap/header', $data);
		$this->load->view('bar-charts', $model_data);
		$this->load->view('bootstrap/footer');
	}

	
	public function pie_charts(){

		$this->load->model('Record');
		$record = new Record();
		
		$model_data = array(
			'widget_status' => '',
			'widget_arrow' => 'up',
			'age_bracket' => '',
			'gender' => '',
			'status' => '',
			'occupation' => '',
			'pie_chart_type' => ''
		);
	
		$age_bracket = $this->input->post('age_bracket');
		$gender = $this->input->post('gender');
		$status = $this->input->post('status');
		$occupation = $this->input->post('employment');
		$pie_chart_type = $this->input->post('pie_chart_type');


		if($age_bracket){

			$this->session->unset_userdata('bar_chart');

			$pie_chart_array = $record->get_pie_chart_info($age_bracket, $gender, $status, $occupation, $pie_chart_type);

			$session_data = array(
				'age_bracket' => $age_bracket,
				'gender' => $gender,
				'status' => $status,
				'occupation' => $occupation,
				'pie_chart_type' => $pie_chart_type
			);

			$this->session->set_userdata(array('pie_chart' => $session_data));

			$model_data = array(
				'stat_pie_chart_array' => $pie_chart_array,
				'widget_status' => 'collapsed',
				'widget_arrow' => 'down',
				'age_bracket' => $age_bracket,
				'gender' => $gender,
				'status' => $status,
				'occupation' => $occupation,
				'pie_chart_type' => $pie_chart_type
			);

		}else{

			$pie_chart_session = $this->session->userdata('pie_chart');

			if($pie_chart_session){
				$age_bracket = $pie_chart_session['age_bracket'];
				$gender = $pie_chart_session['gender'];
				$status = $pie_chart_session['status'];
				$occupation = $pie_chart_session['occupation'];
				$pie_chart_type = $pie_chart_session['pie_chart_type'];

				$pie_chart_array = $record->get_pie_chart_info($age_bracket, $gender, $status, $occupation, $pie_chart_type);
			
				$model_data = array(
					'stat_pie_chart_array' => $pie_chart_array,
					'widget_status' => 'collapsed',
					'widget_arrow' => 'down',
					'age_bracket' => $age_bracket,
					'gender' => $gender,
					'status' => $status,
					'occupation' => $occupation,
					'pie_chart_type' => $pie_chart_type
				);
			}

		}
		
		$data = array(
			'title' => 'Pie Charts',
          	'main_group' => '',
          	'description' => 'The options below will help you plot your desired pie chart'
        );
		$this->load->view('bootstrap/header', $data);
		$this->load->view('pie-charts', $model_data);
		$this->load->view('bootstrap/footer');
	}
	
	
	public function line_charts(){
		$data = array(
			'title' => 'Line Charts',
          	'main_group' => '',
          	'description' => 'Please select what kind of report you want to plot using line chart'
        );
		$this->load->view('bootstrap/header', $data);
		$this->load->view('line-charts');
		$this->load->view('bootstrap/footer');
	}
	
	
	public function submit_bar_chart_options(){
		
		
		$data = array(
			'title' => 'Bar Charts',
          	'main_group' => '',
          	'description' => 'Please select what kind of report you want to plot using bar chart',
			'stat_bar_chart_array' => $stat_bar_chart_array
        );
		
		$this->load->view('bootstrap/header', $data);
		$this->load->view('bar-charts', $data);
		$this->load->view('bootstrap/footer');
		
		
	
	}
	
	
	public function submit_pie_chart_options(){
		
		
		$data = array(
			'title' => 'Bar Charts',
          	'main_group' => '',
          	'description' => 'Please select what kind of report you want to plot using bar chart',
			'stat_pie_chart_array' => $pie_chart_array
        );
		
		$this->load->view('bootstrap/header', $data);
		$this->load->view('pie-charts', $data);
		$this->load->view('bootstrap/footer');
		
		
	
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */