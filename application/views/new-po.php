
    <script type="text/javascript">

        base_url = "<?php echo base_url(); ?>";

        $(document).ready(function(){

            $('#new-category-link').click(function(){
                $('#category-select').val('');
                $('#subcategory-select').html('');
                $('#category-select, #subcategory-select, #new-category-link').hide();
                $('#category-new, #subcategory-new, #select-category-link').show();
                
            });

            $('#select-category-link').click(function(){
                $('#category-new, #subcategory-new').val('');
                $('#category-select, #subcategory-select, #new-category-link').show();
                $('#category-new, #subcategory-new, #select-category-link').hide();
                
            });


            $('#category-select').change(function(){
                if($('#subcategory-select').css('display') == 'none'){
                    $('#new-subcategory-link').hide();
                    $('#select-subcategory-link').show();
                }else{
                    $('#new-subcategory-link').show();
                    $('#select-subcategory-link').hide();
                }
                
            });


            $('#new-subcategory-link').click(function(){
                $('#subcategory-select').val('');
                $(' #subcategory-select, #new-subcategory-link').hide();
                $(' #subcategory-new, #select-subcategory-link').show();
                
            });

            $('#select-subcategory-link').click(function(){
                $('#subcategory-new').val('');
                $(' #subcategory-select, #new-subcategory-link').show();
                $(' #subcategory-new, #select-subcategory-link').hide();
                
            });


            ajax_html_get("category-select", "product/get-subcategories-select", "subcategory-select");

        });


        function ajax_html_get(change_id, function_url, output_id){

            if($("#"+change_id).length){

                $("#"+change_id).change(function(){
                
                    var id=$(this).val();
                    var dataString = 'id='+ id;
                    var ajax_url = base_url+function_url;


                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: dataString,
                        dataType: "html",
                        success: function(data)
                        {
                            //alert(data);
                            $("#"+output_id).html(data);
                        } 
                    });

                });
            }
        }
        

    </script>

<?php include('includes/views-config.php'); ?>

    <div class="row">
        <div class="col-sm-8">
                <form name="submit-product" id="submit-product" action='<?php echo $action; ?>' method='POST'>
                <table class="boxed-table <?php echo $table_class; ?>">
                    <thead class="<?php echo $head_color; ?>">
                        <tr>
                            <th id="test-title" colspan="2"><?php echo $title; ?></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td>
                                <input type="text" value="" name="customer_name" />
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Address</td>
                            <td>
                                <input type="text" value="" name="customer_address" />
                            </td>
                        </tr>
                        <tr>
                            <td>Total Bill</td>
                            <td>
                                <input type="text" value="" name="total_bill" />
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
                                        <!--<tr class="product-row">
                                            <td>
                                                <a class="badge remove-badge badge-error">x</a>
                                                Product 1</td>
                                            <td>
                                                <span class="symbol">x</span>
                                                <input class="input-small" type="text" value="" name="stocks" />
                                                <span class="symbol">=</span>
                                                <span class="sub-price">100.00 PHP</span>

                                            </td>
                                        </tr>-->
                                       
                                </table>

                            </td>
                            

                        </tr>



                         <tr>
                            <td></td>
                            <td>
                                <span class="main-price pull-left"> Total:</span>
                                <span class="main-price"><strong id="main-total"></strong> PHP</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Remarks</td>
                            <td>
                                <input type="hidden" class="main-total" name="main_total" value="" />
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                                <textarea name="remarks" id="" rows="4"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a class="btn-submit boxed-green" href="<?php echo $reset; ?>">Reset</a>
                                <input type="submit" class="btn-submit boxed-turquoise" value="<?php echo $submit_value; ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>

        </div>

        <div class="col-sm-4">
            <?php include('widgets/search-widget.php'); ?>
        </div>
    </div>