<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function index()
	{
		$this->dashboard();
	}


	//reports dashboard
	public function dashboard(){

		$data = array(
			'title' => 'Choose A Report',
          	'main_group' => '',
          	'description' => ''
        );
		$this->load->view('includes/header', $data);
		$this->load->view('report');
		$this->load->view('includes/footer');

	}


	public function out_of_stock(){

		$search_category = $this->input->post('category_selector');
		$search_product_key = $this->input->post('product_name');

		if($search_category == 'all'){
			$search_category = '';
		}

		$this->load->library('table');
		$this->load->library("pagination");
		$this->load->model('ProductModel');

		$product_model = new ProductModel();

		$data = array(
			'title' => 'Reports - Out of Stock Products',
          	'main_group' => '',
          	'description' => ''
        );


		$config = array();
		$config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url('product/view-all');
        $config["total_rows"] = $product_model->row_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['first_link'] = 'first';
        $config['first_tag_open'] = '<a class="page-numbers"';
        $config['first_tag_close'] = '</a>';
        $config['last_link'] = 'last';
        $config['last_tag_open'] = '<a class="page-numbers"';
        $config['last_tag_close'] = '</a>';
        $config['next_link'] = '<span>&rsaquo;</span>';
        $config['next_tag_open'] = '<a class="page-numbers"';
        $config['next_tag_close'] = '</a>';
        $config['prev_link'] = '<span>&lsaquo;</span>';
        $config['prev_tag_open'] = '<a class="page-numbers"';
        $config['prev_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<a class="page-numbers page_current">';
        $config['cur_tag_close'] = '</a>';
        $config['num_tag_open'] = '<a class="page-numbers"';
        $config['num_tag_close'] = '</a>';
 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query_products = array();
		$products = $product_model->get_out_of_stock_products($config["per_page"], $page, $search_category, $search_product_key);
		foreach($products as $product){
			$query_products[] = array(
				'id' => $product->id, 
				'code' => $product->code,
				'name' => $product->name,
				'stocks' => $product->stocks,
				'price' => $product->price,
				'date_created' => $product->date_created,
				'subcategory_id' => $product->subcategory_id,
			);
		}

		//$markup_delete = $this->has_permission(true, 'records/delete');

		$model_data = array(
        	'products' => $query_products,
        	'limit' => $config["per_page"],
        	'offset' => $page 
        	//'markup_delete' => $markup_delete
        );

        $model_data["results"] = $products;
        $model_data["links"] = $this->pagination->create_links();
        $model_data['categories_select'] = $this->get_categories_select(null,true);
        //$config['anchor_class'] = '';

		
		$this->load->view('includes/header', $data);
		$this->load->view('out-of-stock', $model_data);
		$this->load->view('includes/footer');

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