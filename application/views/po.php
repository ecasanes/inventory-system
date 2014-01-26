<?php include('includes/views-config.php'); ?>

            <div class="row">
                <div class="col-sm-12">
                    
                    <form>
                    <div  class="select-container boxed-red pull-left">
                        <label>Status</label>
                        <select id="select-po-status" name="status_selector">
                        	<option class="status-val" value="">Select Status</option>
                            <option class="status-val" value="completed">Completed</option>
                            <option class="status-val" value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    </form>


                    <div id="add-new-product" class="pull-right boxed-red">
                        <a class="btn boxed-red bold" href="<?php echo $new_po; ?>"><span>New Purchase Order</span></a>
                    </div>

                    <table class="boxed-table">
                        <thead class="boxed-red">
                            <tr>
                                <th>ID</th>
                                <th>Purchaser Name</th>
                                <th>Assigned User</th>
                                <th>Transaction Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                                foreach($products as $product){

                                    $id = $product['id'];
                                    $remarks = $product['remarks'];
                                    $status = $product['status'];
                                    $total_bill_paid = $product['total_bill_paid'];
                                    $total_price_paid = $product['total_price_paid'];
                                    $purchaser_name = $product['purchaser_name'];
                                    $purchaser_address = $product['purchaser_address'];
                                    $user_id = $product['user_id'];
                                    $date_created = $product['date_created'];
                                    
                            ?>
                            <tr>
                                <td class="number"><?php echo $id; ?></td>
                                <td><?php echo $purchaser_name; ?></td>
                                <td class="number">
                                    <?php echo $user_id; ?>
                                </td>
                                <td class="price"><span><?php echo $date_created; ?><span></td>
                                <td class="price"><span><?php echo $status; ?><span></td>
                                <td class="options">
                                    <a class="btn btn-blue btn-icon-right btn-arrow-right" href="<?php echo $view_po . '/' . $id; ?>"><span>View Full Info</span></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                   
                </div>
            </div>