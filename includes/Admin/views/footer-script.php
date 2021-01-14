<script type='text/javascript'>
    jQuery(document).ready(function() {
        //for Price tab
        jQuery('#general_product_data .pricing').addClass('show_if_bulk');
        jQuery('.inventory_options').addClass('show_if_custom').show();
        jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_bulk').show();
        jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_bulk').show();

        <?php if ($is_bulk) { ?>
            jQuery('#general_product_data .pricing').show();
            jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_bulk').show();
            jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_bulk').show();
        <?php } ?>
    });
</script>