<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	public $uploads_directory = 'uploads';
	public $age_bracket_array = array();
	
	public function __construct()
	    {
	        parent::__construct(); 
			
	    }

	public function index(){
		
		$this->view_all();	
	}



	public function ajax_search(){

		$search_key = $this->input->post('key');

		$this->load->model('ProductModel');
		$productmodel = new ProductModel();

		$data = array(
			'title' => 'Product Search',
          	'main_group' => '',
          	'description' => ''
        );
 
        

        $query_products = array();

		$products = $productmodel->get_products_by_name($search_key);

		$product_count = count($products);


		$model_data = array();
		$model_data["product_count"] = $product_count;
        $model_data["results"] = $products;
        

		
		$this->load->view('ajax-simple-product-search', $model_data);
	}




	public function view_all(){

		$search_category = $this->input->post('category_selector');
		$search_product_key = $this->input->post('product_name');

		if($search_category == 'all'){
			$search_category = '';
		}

		$this->load->library('table');
		$this->load->library("pagination");
		$this->load->model('ProductModel');

		$data = array(
			'title' => 'Products',
          	'main_group' => '',
          	'description' => ''
        );


		$config = array();
		$config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url('product/view-all');
        $config["total_rows"] = $this->ProductModel->row_count();
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
		$products = $this->ProductModel->get_products($config["per_page"], $page, $search_category, $search_product_key);
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
		$this->load->view('products', $model_data);
		$this->load->view('includes/footer');
	}

	public function save($action = 'add', $id = false){

		$uploads_path = $this->uploads_directory;

		$config['upload_path'] = './'.$uploads_path.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1920';
		$config['max_height']  = '1080';

		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		$this->load->model('ProductModel');
		$product = new ProductModel();


		$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		$this->form_validation->set_rules('stocks', 'Stocks', 'required');

		

		if($this->form_validation->run())
		{
			$product_name = $this->input->post('product_name');
			$price = $this->input->post('price');
			$stocks = $this->input->post('stocks');
			$category_select = $this->input->post('category');
			$category_new = $this->input->post('category_new');
			$subcategory_select = $this->input->post('subcategory');
			$subcategory_new = $this->input->post('subcategory_new');

			date_default_timezone_set('Asia/Singapore');
			$datetime = strtotime(Date('Y-m-d H:i:s'));
			$date = date('Y-m-d H:i:s',$datetime);

			
			if($category_new != '' || !empty($category_new)){
				$category = $category_new;
				$description = 'Added as main category for ' . $product_name;
				$category_id = $product->add_category($category, $description, $date);
			}else{
				$category_id = $category_select;
				if($category_id == '' || empty($category_id)){
					$category_id = 'null';
				}
			}

			if($subcategory_new != '' || !empty($subcategory_new)){
				$subcategory = $subcategory_new;
				$description = 'Added as subcategory for ' . $product_name;
				$subcategory_id = $product->add_subcategory($category_id, $subcategory, $description, $date);
				
			}else{
				if($subcategory_select == '' || empty($subcategory_select)){
					$subcategory_id = 'null';
				}else{
					$subcategory_id = $subcategory_select;
				}
				
			}


			if($action == 'edit'){
				$product_info = $product->get_product($id);
				$product_image_name = $product_info['product_image_name'];
				$product_image_path = base_url().$uploads_path.'/'.$product_image_name;
			}else{
				$product_image_name = '';
				$product_image_path = '';
			}
			


			if($this->upload->do_upload()){
				$upload_data = $this->upload->data();
				$product_image_name = $upload_data['file_name'];
				$product_image_path = base_url().$uploads_path.'/'.$product_image_name;
			}
			
			
			if($action == 'add'){
				$last_insert_id = $product->add($product_name, $price, $stocks, $category_id, $subcategory_id, $date, $product_image_name, $product_image_path);
				redirect('product/edit/'.$last_insert_id.'/success_add');
			}else{
				$product->update($id, $product_name, $price, $stocks, $category_id, $subcategory_id, $date, $product_image_name, $product_image_path);
				redirect('product/edit/'.$id.'/success_edit');
			}
			
			
		}else{

			if(!$this->upload->do_upload()){

				$upload_error = $this->upload->display_errors();

				$additional_model_data = array();
				$additional_model_data['upload_error'] = $upload_error;

				if($action == 'add'){
					$this->add('error', $additional_model_data);
				}else{
					$this->edit($id);
				}

			}else{

				if($action == 'add'){
					$this->add();
				}else{
					$this->edit($id);
				}

			}

			
			
		}
	}



	public function add($outcome = '', $additional_model_data = array()){
		
		$this->load->model('ProductModel');

		$data = array(
			'title' => 'Add New Product',
          	'main_group' => '',
          	'description' => ''
        );

        

        $categories_select = $this->get_categories_select();
		
		$model_data = array(
			'categories_select' => $categories_select,
			'product_name' => '',
			'price' => '',
			'stocks' => '',
			'category' => '',
			'subcategory' => '',
			'action' => base_url('product/save/add'),
			'reset' => base_url('product/add'),
			'current_product_count' => $this->ProductModel->row_count(),
			'submit_value' => 'Add Now',
			'table_class' => '',
			'head_color' => 'boxed-dark-yellow',
			'upload_error' => '',
			'product_image_path' => ''
		);

		if($outcome == 'error'){
        	$model_data = array_merge($model_data, $additional_model_data);
        }

		
		$this->load->view('includes/header', $data);
		$this->load->view('submit-product', $model_data);
		$this->load->view('includes/footer');
	}

	public function edit($id, $outcome = ''){

		$uploads_path = $this->uploads_directory;
		$this->load->model('ProductModel');
		$product = new ProductModel();

		$product_info = $product->get_product($id);
		
		
		$code = $product_info['code'];
		$name = $product_info['name'];
		$price = $product_info['price'];
		$stocks = $product_info['stocks'];
		$subcategory_id = $product_info['subcategory_id'];
		$category_id = $product_info['category_id'];
		$date_created = $product_info['date_created'];
		$product_image_name = $product_info['product_image_name'];
		$product_image_path = base_url().$uploads_path.'/'.$product_image_name;


		$categories_select = $this->get_categories_select($category_id);
		if($subcategory_id == null || $subcategory_id == 0){
			$subcategories_select = '';
		}else{
			$subcategories_select = $this->get_subcategories_select($subcategory_id);
		}
		
		

		$data = array(
			'title' => 'Edit Product',
          	'main_group' => '',
          	'description' => ''
        );
		
		$model_data = array(
			'product' => $product_info,
			'categories_select' => $categories_select,
			'product_name' => $name,
			'price' => $price,
			'stocks' => $stocks,
			'category' => $category_id,
			'subcategory' => $subcategories_select,
			'action' => base_url('product/save/edit/'.$id),
			'reset' => base_url('product/edit/'.$id),
			'current_product_count' => $this->ProductModel->row_count(),
			'submit_value' => 'Update',
			'table_class' => 'edit',
			'head_color' => 'boxed-turquoise',
			'upload_error' => '',
			'product_image_path' => $product_image_path
		);

		if($outcome == 'success_edit'){
			$model_data['success_edit'] = true;
		}else{
			$model_data['success_add'] = false;
			$model_data['success_edit'] = false;
		}

		
		$model_data['success_add'] = false;
		$model_data['last_insert_id'] = '';
		
		$this->load->view('includes/header', $data);
		$this->load->view('submit-product', $model_data);
		$this->load->view('includes/footer');
	}

	public function delete($id, $redirect = ''){
		
		$this->load->model('ProductModel');
		$record = new Record();
		
		$record->delete($id);	

		$redirect_base = 'records';

		redirect($redirect_base.'/'.$redirect);		
	}
	
	



	
	
	public function get_categories_select($id=null, $search = false){
		
		$this->load->model('ProductModel');
		$product = new ProductModel();
		
		$categories = $product->get_categories();


		$result = '';

		

		
		if($search){
			$result .= "<option value='all'>ALL CATEGORIES</option>";
		}else{
			if($id != null){
				$category_name = $product->get_category_name($id);
				$result .= "<option value='".$id."'>".$category_name."</option>";
			}else{
				$result .= "<option value=''>SELECT CATEGORY</option>";
			}
			
		}

		

		foreach($categories as $category){
			$category_name = $category->name;
			$category_id = $category->id;
			$result .= "<option value='{$category_id}'>{$category_name}</option>";
		}
		
		return $result;
	}



	public function get_subcategories_select($subcat_id = null){
	
		$this->load->model('ProductModel');
		$product = new ProductModel();

		if($subcat_id != null){
			$id = $product->get_main_category($subcat_id);
			$subcategory_name = $product->get_subcategory_name($subcat_id);
			$result = '<option value="'.$id.'">'.$subcategory_name.'</option>';
		}else{
			$id = $this->input->post('id'); // category_id
			$result = '<option value="">SELECT SUBCATEGORY</option>';
		}
	
		
		$subcategories = $product->get_subcategories($id);

		
		foreach($subcategories as $subcategory){
			$subcategory_id 	= $subcategory->id;
			$subcategory_name	= $subcategory->name;
			$result .= '<option value="'.$subcategory_id.'">'.$subcategory_name.'</option>';
		}
		
		if($subcat_id != null){
			return $result;
		}else{
			echo $result;
		}	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */