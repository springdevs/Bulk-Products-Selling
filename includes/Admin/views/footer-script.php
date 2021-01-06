<script type='text/javascript'>
    jQuery(document).ready(function() {
        //for Price tab
        jQuery('#general_product_data .pricing').addClass('show_if_bulk');

        <?php if ($is_bulk) { ?>
            jQuery('#general_product_data .pricing').show();
        <?php } ?>
    });
</script>