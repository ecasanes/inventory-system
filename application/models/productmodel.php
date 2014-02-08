<?php

class ProductModel extends MY_Model {

    const DB_TABLE = 'product';
    const DB_TABLE_PK = 'id';

    public function add_stock($id, $stock){

    	$sql = "UPDATE product SET stocks = stocks + $stock WHERE id = $id";
											
		$query = $this->db->query($sql);
    }

    public function remove_stock($id, $stock){

    	$sql = "UPDATE product SET stocks = stocks - $stock WHERE id = $id";
											
		$query = $this->db->query($sql);
    }

    public function get_products($limit, $offset, $category = '', $product_search_key = ''){

    	$db_table = ProductModel::DB_TABLE;
		$db_primary = ProductModel::DB_TABLE_PK;

		if($category != ''){
			if($product_search_key != ''){
				$sql = "SELECT * FROM {$db_table} WHERE category_id = $category AND name LIKE '%$product_search_key%' LIMIT $offset, $limit";
			}else{
				$sql = "SELECT * FROM {$db_table} WHERE category_id = $category LIMIT $offset, $limit";
			}
		}else{
			if($product_search_key != ''){
				$sql = "SELECT * FROM {$db_table} WHERE name LIKE '%$product_search_key%' LIMIT $offset, $limit";
			}else{
				$sql = "SELECT * FROM {$db_table} LIMIT $offset, $limit";
			}
		}
    	
											
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;
    }

    public function get_products_by_name($search_key){

    	$db_table = ProductModel::DB_TABLE;
		$db_primary = ProductModel::DB_TABLE_PK;

		$sql = "SELECT * FROM {$db_table} WHERE name LIKE '%$search_key%' LIMIT 15";
		
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;
    }

    public function add($product_name, $price, $stocks, $category_id, $subcategory_id = null, $date_created = '', $product_image_name, $product_image_path, $code = ''){

		$sql = "INSERT INTO product ( id, code, name, stocks, price, date_created, subcategory_id, category_id, product_image_name, product_image_path) 
					VALUES ('', '$code', '$product_name', $stocks, $price, '$date_created', $subcategory_id, $category_id, '$product_image_name', '$product_image_path')";
											
		$query = $this->db->query($sql);

		$last_insert_id = $this->db->insert_id();

		return $last_insert_id;	
	}

	public function update($id, $product_name, $price, $stocks, $category_id, $subcategory_id, $date, $product_image_name, $product_image_path, $code = ''){

		$sql = "UPDATE product SET code = '$code', name = '$product_name', stocks = $stocks, price = $price, date_created = '$date_created', subcategory_id = $subcategory_id, category_id = $category_id, product_image_name = '$product_image_name', product_image_path = '$product_image_path' WHERE id = $id";
											
		$query = $this->db->query($sql);
	}

	public function delete($id){
		$this->db->delete(ProductModel::DB_TABLE, array(ProductModel::DB_TABLE_PK => $id)); 
	}

	public function get_product($id){

		$db_table = ProductModel::DB_TABLE;
		$db_primary = ProductModel::DB_TABLE_PK;

		$sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = $id";
		$query = $this->db->query($sql);

		$record = $query->row_array();

		return $record;
	}

	public function get_category_name($id){

		$sql = "SELECT name FROM category WHERE id = $id";
		$query = $this->db->query($sql);
		
		$result = $query->row()->name;
		
		return $result;
	}

	public function get_main_category($id){

		$sql = "SELECT category_id FROM subcategory WHERE id = $id";
		$query = $this->db->query($sql);
		
		$result = $query->row()->category_id;
		
		return $result;
	}

	public function get_subcategory_name($id){

		$sql = "SELECT name FROM subcategory WHERE id = $id";
		$query = $this->db->query($sql);
		
		$result = $query->row()->name;
		
		return $result;
	}

	public function get_categories(){
	
		$sql = "SELECT name, id FROM category";
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}

	public function get_subcategories($id = ''){
	
		if($id != ''){
			$sql="SELECT name, id FROM subcategory WHERE category_id = $id";
		}else{
			$sql="SELECT name, id FROM subcategory";
		}
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}

	public function add_category($name, $description, $date_created, $code = ''){

		$sql = "INSERT INTO category ( id, code, name, description, date_created) 
					VALUES ('', '$code', '$name', '$description', '$date_created')";
											
		$query = $this->db->query($sql);

		$last_insert_id = $this->db->insert_id();

		return $last_insert_id;
	}

	public function add_subcategory($category_id, $name, $description, $date_created, $code = ''){

		$sql = "INSERT INTO subcategory ( id, code, name, description, date_created, category_id) 
					VALUES ('', '$code', '$name', '$description', '$date_created', $category_id)";
											
		$query = $this->db->query($sql);

		$last_insert_id = $this->db->insert_id();

		return $last_insert_id;
	}

	public function get_out_of_stock_products($limit, $offset, $category = '', $product_search_key = ''){

    	$db_table = ProductModel::DB_TABLE;
		$db_primary = ProductModel::DB_TABLE_PK;

		if($category != ''){
			if($product_search_key != ''){
				$sql = "SELECT * FROM {$db_table} WHERE stocks = 0 AND category_id = $category AND name LIKE '%$product_search_key%' LIMIT $offset, $limit";
			}else{
				$sql = "SELECT * FROM {$db_table} WHERE stocks = 0 AND category_id = $category LIMIT $offset, $limit";
			}
		}else{
			if($product_search_key != ''){
				$sql = "SELECT * FROM {$db_table} WHERE stocks = 0 AND name LIKE '%$product_search_key%' LIMIT $offset, $limit";
			}else{
				$sql = "SELECT * FROM {$db_table} WHERE stocks = 0 LIMIT $offset, $limit";
			}
		}
    	
											
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;
    }

}

?>