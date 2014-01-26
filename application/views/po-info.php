


<?php include('includes/views-config.php'); ?>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
                <form name="submit-product" id="submit-product" action='<?php echo $action; ?>' method='POST'>
                <table class="boxed-table">
                    <thead class="boxed-green">
                        <tr>
                            <th id="test-title" colspan="2"><?php echo $title; ?> <?php if($status == 'cancelled'){ echo '[CANCELLED]'; } ?></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td>
                                <?php echo $purchaser_name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Address</td>
                            <td>
                                <?php echo $purchaser_address; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Bill</td>
                            <td>
                                <?php echo $total_bill_paid; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="main-price pull-left">Products</span></td>
                            <td>
                                
                            </td>
                        </tr>



                        <tr>
                            
                            <td colspan="2">
                                
                                <table id="products-start" class="boxed-table"> 
                                    <?php
                                        foreach($purchased_items as $item){

                                            $item_id = $item['item_id'];
                                            $item_purchase_price = $item['item_purchase_price'];
                                            $item_purchase_stock = $item['item_purchase_stock'];
                                            $item_subtotal = $item['item_subtotal'];
                                            $item_name = $item['item_name'];

                                    ?>
                                    <tr>
                                        <td><?php echo $item_name; ?></td>
                                        <td><span class="original-price"><?php echo $item_purchase_price; ?></span><span class="symbol">x</span><?php echo $item_purchase_stock; ?><span class="symbol">=</span><span class="sub-price"><?php echo $item_subtotal; ?></span></td>
                                    </tr>
                                    <?php } ?>
                                       
                                </table>

                            </td>
                            

                        </tr>



                         <tr>
                            <td></td>
                            <td>
                                
                                <span class="main-price"><strong id="main-total">Total: <?php echo $total_price_paid; ?></strong> PHP</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Remarks</td>
                            <td>
                                <?php echo $remarks; ?>
                            </td>
                        </tr>
                        <tr class="hidden-print">
                            <td></td>
                            <td>
                                <?php if($status == 'completed'){ ?>
                                <a class="btn-submit boxed-red" href="<?php echo $cancel_action; ?>">Cancel This Purchase Order</a>
                                <?php } ?>
                                <a id="print" class="btn-submit boxed-blue" href="#">Print</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>

        </div>

    </div>