<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_Order extends MY_Controller {
	
	public function __construct()
	    {
	        parent::__construct(); 
			
	    }

	public function index(){
		
		$this->view_all();	
	}


	public function completed(){
		$this->view_all('completed');
	}


	public function cancelled(){
		$this->view_all('cancelled');
	}


	public function cancel($po_id){

		$this->load->model('PO_Model');
		$this->load->model('ProductModel');

		$po = new PO_Model();
		$product = new ProductModel();

		$po->cancel($po_id);
		$purchased_items = $po->get_po_purchased_items($po_id);

		foreach($purchased_items as $item){
			$item_id = $item->item_id;
			$item_stock = $item->po_stock;

			$product->add_stock($item_id, $item_stock);
		}
		
		redirect('purchase-order/view/'.$po_id);


	}



	public function view($id){

		$this->load->model('PO_Model');
		$this->load->model('ProductModel');

		$data = array(
			'title' => 'Purchase Order Info',
          	'main_group' => '',
          	'description' => ''
        );


		$purchase_order_info = $this->PO_Model->get_po($id);
		$purchased_items = $this->PO_Model->get_po_purchased_items($id);

		foreach($purchase_order_info as $order){
			$po_id = $order->id;
			$purchaser_name = $order->purchaser_name;
			$purchaser_address = $order->purchaser_address;
			$total_bill_paid = $order->total_bill_paid;
			$total_price_paid = $order->total_price_paid;
			$remarks = $order->remarks;
			$date_created = $order->date_created;
			$user_id = $order->user_id;
			$status = $order->status;
		}


		$purchased_items_array = array();
		foreach($purchased_items as $item){
			$item_id = $item->item_id;
			$item_purchase_price = $item->po_price;
			$item_purchase_stock = $item->po_stock;
			$item_subtotal = $item_purchase_stock * $item_purchase_price;
			$item_info = $this->ProductModel->get_product($item_id);
			$item_name = $item_info['name'];

			$purchased_items_array[] = array(
				'item_id' => $item_id,
				'item_purchase_price' => $item_purchase_price,
				'item_purchase_stock' => $item_purchase_stock,
				'item_subtotal' => number_format($item_subtotal, 2, '.', ','),
				'item_name' => $item_name
			);
		}
		

		$model_data = array(
			'po_id' => $po_id,
			'status' => $status,
        	'purchaser_name' => $purchaser_name,
        	'purchaser_address' => $purchaser_address,
        	'total_bill_paid' => $total_bill_paid,
        	'total_price_paid' => $total_price_paid,
        	'remarks' => $remarks,
        	'date_created' => $date_created,
        	'user_id' => $user_id,
        	'purchased_items' => $purchased_items_array,
        	'cancel_action' => base_url('purchase-order/cancel/'.$po_id)
        );
        

		
		$this->load->view('includes/header', $data);
		$this->load->view('po-info', $model_data);
		$this->load->view('includes/footer');
	}


	


	public function view_all($status = ''){
		$this->load->model('PO_Model');

		$data = array(
			'title' => 'Purchase Order List',
          	'main_group' => '',
          	'description' => ''
        );


		

        $query_products = array();
		$products = $this->PO_Model->get_all_po(100, 'DESC', $status);
		foreach($products as $product){
			$query_products[] = array(
				'id' => $product->id, 
				'remarks' => $product->remarks,
				'status' => $product->status,
				'total_bill_paid' => $product->total_bill_paid,
				'total_price_paid' => $product->total_price_paid,
				'purchaser_name' => $product->purchaser_name,
				'purchaser_address' => $product->purchaser_address,
				'user_id' => $product->user_id,
				'date_created' => $product->date_created
			);
		}

		//$markup_delete = $this->has_permission(true, 'records/delete');

		$model_data = array(
        	'products' => $query_products
        	//'markup_delete' => $markup_delete
        );
        
        //$config['anchor_class'] = '';

		
		$this->load->view('includes/header', $data);
		$this->load->view('po', $model_data);
		$this->load->view('includes/footer');
	}

	public function save($action = 'add', $id = false){

		$this->load->library('form_validation');
		$this->load->model('ProductModel');
		$this->load->model('PO_Model');
		$po = new PO_Model();
		$product_model = new ProductModel();


		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		//$this->form_validation->set_rules('price', 'Price', 'required');
		//$this->form_validation->set_rules('stocks', 'Stocks', 'required');
		

		if($this->form_validation->run())
		{
		
			$customer_name = $this->input->post('customer_name');
			$customer_address = $this->input->post('customer_address');
			$total_bill = $this->input->post('total_bill');
			$main_total = $this->input->post('main_total');
			$product_row_id = $this->input->post('product_row_id');
			$product_row_price = $this->input->post('product_row_price');
			$product_row_stocks = $this->input->post('product_row_stocks');
			$remarks = $this->input->post('remarks');
			$user_id = $this->input->post('user_id');
			$status = 'completed';

			date_default_timezone_set('Asia/Singapore');
			$datetime = strtotime(Date('Y-m-d H:i:s'));
			$date = date('Y-m-d H:i:s',$datetime);
			
			
			if($action == 'add'){
				$last_insert_id = $po->add($remarks, $status, $total_bill, $main_total, $customer_name, $customer_address, $date, $user_id);

				$product_counter = 0;

				foreach($product_row_id as $product){

					$item_id = $product;
					$po_price = $product_row_price[$product_counter];
					$po_stock = $product_row_stocks[$product_counter];

					$po->add_purchased_item($item_id, $last_insert_id, $po_price, $po_stock);
					$product_model->remove_stock($item_id, $po_stock);

					$product_counter++;
				}

				redirect('purchase-order/view/'.$last_insert_id);
			}

			//else{
			//	$product->update($id, $product_name, $price, $stocks, $category_id, $subcategory_id, $date);
			//	redirect('product/edit/'.$id.'/success_edit');
			//}
			
		}else{
			if($action == 'add'){
				$this->add();
			}else{
				$this->edit($id);
			}
		}
	}



	public function add($outcome = '', $last_insert_id = ''){
		
		$this->load->model('PO_Model');

		$data = array(
			'title' => 'New Purchase Order',
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
			'action' => base_url('purchase-order/save/add'),
			'reset' => base_url('purchase-order/add'),
			'current_product_count' => $this->ProductModel->row_count(),
			'submit_value' => 'Add Now',
			'table_class' => '',
			'head_color' => 'boxed-dark-yellow'
		);

		if($outcome == 'success_add'){
			$model_data['success_add'] = true;
			$model_data['last_insert_id'] = $last_insert_id;
			$model_data['success_edit'] = false;
		}else{
			$model_data['success_add'] = false;
			$model_data['success_edit'] = false;
			$model_data['last_insert_id'] = $last_insert_id;
		}
		
		$this->load->view('includes/header', $data);
		$this->load->view('new-po', $model_data);
		$this->load->view('includes/footer');
	}

	public function edit($id, $outcome = ''){

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
			'head_color' => 'boxed-turquoise'
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