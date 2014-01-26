<!-- main JS libs -->
<script src="<?php echo base_url('js/libs/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('js/libs/jquery-1.10.0.js'); ?>"></script>
<script src="<?php echo base_url('js/libs/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/libs/bootstrap.min.js'); ?>"></script>

<!-- general -->
<script src="<?php echo base_url('js/general.js'); ?>"></script>

<!-- custom input -->
<script src="<?php echo base_url('js/jquery.customInput.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/custom.js'); ?>"></script>
<!-- Placeholders -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.powerful-placeholder.min.js'); ?>"></script>
<!-- prettyPhoto -->
<script src="<?php echo base_url('js/jquery.prettyPhoto.js'); ?>"></script>
<!-- CarouFredSel  -->
<script src="<?php echo base_url('js/jquery.carouFredSel-6.2.1-packed.js'); ?>"></script>
<script>
    jQuery(document).ready(function($) {

        $('#carouFredsel-1').carouFredSel({
            next : "#carousel-next-1",
            prev : "#carousel-prev-1",
            auto: true,
            scroll: {items : 1}
        });

        $(window).resize(function() {

            $('#carouFredsel-1').carouFredSel({
                next : "#carousel-next-1",
                prev : "#carousel-prev-1",
                auto: true,
                scroll: {items : 1}
            });
        })
    });
</script>

<!-- Progress Bars -->
<script src="<?php echo base_url('js/progressbar.js'); ?>"></script>
<!-- Calendar -->
<script src="<?php echo base_url('js/jquery-ui.multidatespicker.js'); ?>"></script>
<!-- range sliders -->
<script src="<?php echo base_url('js/jquery.slider.bundle.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.slider.js'); ?>"></script>

<!-- Video Player -->

<script src="<?php echo base_url('js/video.js'); ?>"></script>

<!-- Scroll Bars -->
<script src="<?php echo base_url('js/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.jscrollpane.min.js'); ?>"></script>
<script type="text/javascript">
    jQuery(function()
    {
    	//alert('test');
        jQuery('.scrollbar').jScrollPane({
            verticalDragMaxHeight: 18,
            verticalDragMinHeight:18
        });

        jQuery('.scrollbar.style2').jScrollPane({
            verticalDragMaxHeight: 28,
            verticalDragMinHeight:28
        });

        jQuery('.scrollbar.style3').jScrollPane({
            verticalDragMaxHeight: 38,
            verticalDragMinHeight:38
        });

        jQuery('.scrollbar.style4').jScrollPane({
            verticalDragMaxHeight: 38,
            verticalDragMinHeight:38
        });
    });
</script>

<!--[if lt IE 9]><script src="js/respond.min.js"></script><![endif]-->


<script type="text/javascript">

base_url = "<?php echo base_url(); ?>";




$(document).ready(function(){


    $('#print').click(function(){
        window.print();
    });

    ajax_search('.menu-search-field', 'product/ajax-search', 'search-results')

    $('#select-po-status').change(function(){
        new_location = $(this).val();
        path = base_url+'purchase-order/'+new_location;
        window.location = path;
    });


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


    ajax_select("category-select", "product/get-subcategories-select", "subcategory-select");

});


function ajax_search(search_field, function_url, output_id){

    if($(search_field).length){

        $(search_field).keyup(function(){
        
            var key=$(this).val();
            var dataString = 'key='+ key;
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


function ajax_select(change_id, function_url, output_id){

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


