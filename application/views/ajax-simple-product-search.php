<script type="text/javascript">
    
    
/*
$('.product-row').each(function(){
orig_price = $(this).find('.original-price').text();
quantity = $(this).find('input.product-row-stocks').val();
new_total = parseInt(orig_price,10) + parseInt(quantity,10);
$(this).find('.sub-price').text(new_total);
});
*/

function parseDecimal(number){

    result = parseFloat(number).toFixed(2);

    return result;
}


    $(document).ready(function(){

        $('.product-add').click(function(){
            add_id_raw = $(this).attr('id');
            add_id = $(this).attr('id').split('-');
            product_id = add_id[2];
            product_name = $('#product-info-'+product_id+' td.product-name').text();
            stocks = $('#product-info-'+product_id+' td.stocks').text();
            price = $('#product-info-'+product_id+' td.price').text();
            existing_main_total = $('#main-total').text();

            if(parseFloat(stocks) <= 0){
                stock_warning = 'danger';
            }else{
                stock_warning = '';
            }

            //check if there is already element that is the same as this
            if($('#product-row-'+product_id).length == 0){

                new_row = "<tr id='product-row-"+product_id+"' class='product-row "+stock_warning+"'><td>";
                new_row += '<a id="product-row-remove-'+product_id+'" class="badge remove-badge badge-error">x</a>';
                new_row += product_name + "</td>";
                new_row += '<td><span class="original-price">'+price+'</span><span class="symbol">x</span>';
                new_row += '<input type="hidden" value="'+product_id+'" name="product_row_id[]" >';
                new_row += '<input type="hidden" value="'+price+'" name="product_row_price[]" >';
                new_row += '<input class="input-small product-row-stocks" type="text" value="'+1+'" name="product_row_stocks[]" >';
                new_row += '<span class="symbol">=</span>';
                new_row += '<span class="sub-price">'+price+'</span></td></tr>';

                $('#products-start').append(new_row);

                
                if(existing_main_total == '' || existing_main_total == null){
                    new_main_total = price;
                }else{
                    new_main_total = parseFloat(existing_main_total) + parseFloat(price);
                }
                

                $('#main-total').text(new_main_total);
                $('.main-total').val(new_main_total);
                //$('#product-info-'+product_id).hide();

            }else{
                existing_price = $('#product-row-'+product_id+' .sub-price').text();
                existing_qty = $('#product-row-'+product_id+' .product-row-stocks').val();
                new_qty = parseInt(existing_qty,10)+1;
                new_subtotal = price * new_qty;
                main_total_addition = parseFloat(new_subtotal) - parseFloat(existing_price);
                $('#product-row-'+product_id+' .product-row-stocks').val(new_qty);
                $('#product-row-'+product_id+' .sub-price').text(parseDecimal(new_subtotal));

                new_main_total = parseFloat(main_total_addition) + parseFloat(existing_main_total);

                $('#main-total').text(new_main_total);
                $('.main-total').val(new_main_total);


                
            }

            

        });


        $(document).on('click','.remove-badge',function(){
            event.preventDefault();
            badge_id = $(this).attr('id');
            row_id = badge_id.split('-');
            product_id = row_id[3];
            $('#product-row-'+product_id).remove();
        });
    });


    

</script>

<table class="boxed-table">
    <?php if($product_count > 0): ?>
    <thead class="boxed-red">
        <tr>
            <th colspan="4">Select Product Here</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>qty</th>
            <th>Price</th>
            <th></th>
        </tr>
    </thead>
    <?php else: ?>
     <thead class="boxed-blue">
        <tr>
            <th colspan="4">No Products Found.</th>
        </tr>
    </thead>
    <?php endif; ?>
    <tbody>
        <?php
        foreach($results as $product){
            $product_name = $product->name;
            $stocks = $product->stocks;
            $price = $product->price;
            $product_id = $product->id;

            if($stocks <= 0){
                $stock_warning = 'text-danger';
            }else{
                $stock_warning = '';
            }
        
        ?>

         <tr id="product-info-<?php echo $product_id; ?>" class="<?php echo $stock_warning; ?>">
            <td class="product-name <?php echo $stock_warning; ?>"><?php echo $product_name; ?></td>
            <td class="stocks <?php echo $stock_warning; ?>"><?php echo $stocks; ?></td>
            <td class="price <?php echo $stock_warning; ?>"><?php echo $price; ?></td>
            <td>
                <?php if($stock_warning == ''): ?>
                    <a id="product-add-<?php echo $product_id; ?>" class="badge add-badge product-add">+</a>
                <?php endif; ?>
            </td>
        </tr>




        <?php } ?>
    </tbody>
</table>