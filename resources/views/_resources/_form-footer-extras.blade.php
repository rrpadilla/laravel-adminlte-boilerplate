<script type="text/javascript">
    $(function () {
        <!-- MULTIPLES IMAGES -->
        //remove images js
        $('#imagesContainer').on('click', '.remove-image', function(e) {
            e.preventDefault();
            //fadeout animation and remove....
            $(this).parent('.wrap-img').fadeOut('100', function(){
                $(this).remove();
            });
        });
    });
</script>
