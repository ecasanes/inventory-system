<?php

class PO_Model extends MY_Model {

    const DB_TABLE = 'purchase_order';
    const DB_TABLE_PK = 'id';

    public function cancel($id){

    	$sql = "UPDATE purchase_order SET status = 'cancelled' WHERE id = $id ";

    	$query = $this->db->query($sql);
    }


    public function add_purchased_item($item_id, $po_id, $po_price, $po_stock){

    	$sql = "INSERT INTO purchased_item ( id, item_id, po_id, po_price, po_stock) 
					VALUES ('', $item_id, $po_id, $po_price, $po_stock)";
											
		$query = $this->db->query($sql);

		$last_insert_id = $this->db->insert_id();

		return $last_insert_id;

    }


    public function add($remarks, $status, $total_bill_paid, $total_price_paid, $purchaser_name, $purchaser_address, $date_created, $user_id){

		$sql = "INSERT INTO purchase_order ( id, remarks, status, total_bill_paid, total_price_paid, purchaser_name, purchaser_address, date_created, user_id) 
					VALUES ('', '$remarks', '$status', $total_bill_paid, $total_price_paid, '$purchaser_name', '$purchaser_address', '$date_created', $user_id )";
											
		$query = $this->db->query($sql);

		$last_insert_id = $this->db->insert_id();

		return $last_insert_id;
		
	}



	public function update($id, $remarks, $status, $total_bill_paid, $total_price_paid, $purchaser_name, $purchaser_address, $date_created, $user_id){

		$sql = "UPDATE purchase_order SET remarks = '$remarks', status = '$status', total_bill_paid = $total_bill_paid, total_price_paid = $total_price_paid, purchaser_name = '$purchaser_name', purchaser_address = '$purchaser_address', date_created = '$date_created', user_id = $user_id WHERE id = $id";
											
		$query = $this->db->query($sql);

	}

	public function get_po($id){

		$db_table = PO_Model::DB_TABLE;
		$db_primary = PO_Model::DB_TABLE_PK;

		$sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = $id";
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;

	}


	public function get_po_purchased_items($po_id){


		$sql = "SELECT * FROM purchased_item WHERE po_id = $po_id";
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;

	}


	public function get_all_po($limit = 1, $order = 'DESC', $status = ''){

		$db_table = PO_Model::DB_TABLE;
		$db_primary = PO_Model::DB_TABLE_PK;

		if($status != ''){
			$sql = "SELECT * FROM {$db_table} WHERE status = '$status' ORDER BY id {$order} LIMIT {$limit}";
		}else{
			$sql = "SELECT * FROM {$db_table} ORDER BY id {$order} LIMIT {$limit}";
		}

		
		$query = $this->db->query($sql);

		$result = $query->result();

		return $result;

	}


	



}

?>