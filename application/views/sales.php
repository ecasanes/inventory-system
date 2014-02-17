<?php include('includes/views-config.php'); ?>

            <div class="row">
                <div class="col-sm-12">
                    
                    <form name="search_product" method="post" action="">
                    <div class="select-container boxed-turquoise pull-left">
                        <label>Category</label>
                        <select name="category_selector">
                            <?php echo $categories_select; ?>
                        </select>
                    </div>

                    <div class="select-container boxed-turquoise pull-left">
                        <label>Product Name</label>
                        <input type="text" name="product_name"  />
                        <input class="boxed-yellow" name="search" type="submit" value="Search" />
                    </div>
                    </form>


                    <div id="add-new-product" class="pull-right">
                        <a class="btn boxed-turquoise bold" href="<?php echo $add_new_product; ?>"><span>Add New Product</span></a>
                    </div>

                    <table class="boxed-table">
                        <thead class="boxed-dark-green">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total Stocks Sold</th>
                                <th>Average Price</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                                foreach($products as $product){
                                    $id = $product['item_id'];
                                    $name = $product['item_name'];
                                    $date_created = $product['date_created'];
                                    $stocks = $product['total_sale_stocks'];
                                    $price = $product['average_sale_price'];
                                    $sales = $product['total_sales'];
                                    
                            ?>
                            <tr>
                                <td class="number"><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td class="number">
                                    <?php echo $stocks; ?>
                                </td>
                                <td class="price"><span><?php echo $price; ?> PHP<span></td>
                                <td class="price"><span><?php echo $sales; ?> PHP<span></td>
                                <!--<td class="options">
                                    <a class="btn btn-blue btn-icon-right btn-arrow-right" href="<?php echo $edit_product . '/' . $id; ?>"><span>Calculate Average Sales</span></a>
                                </td>-->
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- tf pagination -->
                            <div class="tf_pagination style3">
                                <div class="inner">
                                    <!--<a class="page_prev" href="#"><span>&lsaquo;</span></a>

                                    <span class="page-numbers page_current">1</span>
                                    <a href="#" class="page-numbers page_current">2</a>
                                    <a href="#" class="page-numbers">2</a>
                                    <a href="#" class="page-numbers">3</a>

                                    <a class="page_next" href="#"><span>&rsaquo;</span></a>-->
                                    <?php echo $links; ?>
                                </div>
                                
                            </div>

                            
                           
                            <!--/ tf pagination -->
                </div>
            </div>