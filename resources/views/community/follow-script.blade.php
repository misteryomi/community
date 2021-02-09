<script>

    $("a.follow").click(function(e) {

        e.preventDefault();
        let slug = $(this).data('slug');


 

        if($(this).hasClass("following")) {
            $.post('community/'+ slug + "/api-unfollow");
            $(this).removeClass('following secondary').addClass('outline-light');
            $(this).text('Follow')
            
        } else {
            $.post('community/' + slug + "/api-follow");
            $(this).addClass('following secondary').removeClass('outline-light');
            $(this).text('Unfollow')
        }
    });    
</script>