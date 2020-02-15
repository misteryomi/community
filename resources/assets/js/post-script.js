
$(document).ready(function() {

  $('#submit-comment').click(function(e) {
    e.preventDefault();

    let comment = editor.getData();

    $("input[name=comment]").val(comment);

    $('#comment-form').submit();

    return false;
  })


    $("a > .like").click(function(e) {
        e.preventDefault();

        if(!loggedIn) {
            $('#auth-modal').modal('show');

        } else {
            $(this).shake();

            if($(this).hasClass('liked')) {
                $(this).removeClass('liked fa-thumbs-up').addClass('fa-thumbs-o-up');
                $('.likes-count').text(  parseInt($('.likes-count').text()) - 1)
                $.post( slug + "/unlike")
            } else {
                $(this).removeClass('fa-thumbs-o-up').addClass('liked fa-thumbs-up');
                $('.likes-count').text(  parseInt($('.likes-count').text()) + 1)
                $.post( slug + "/like")

            }

        }



        return false;
    });


    $("a.comment-like").click(function(e) {
        e.preventDefault();

        var el = $(this).find('i.fa');
        var id = $(this).attr('data-id');

        var likesEl =  $(".comment-likes-count[data-id="+ id +"]");
        $(this).shake();

        if($(this).hasClass('liked')) {
            $(el).removeClass('liked fa-thumbs-up').addClass('fa-thumbs-o-up');
            likesEl.text(  parseInt(likesEl.text()) - 1)
            $.post( `comment/${id}/unlike`)

        } else {
            $(el).removeClass('fa-thumbs-o-up').addClass('liked fa-thumbs-up');
            likesEl.text(  parseInt(likesEl.text()) + 1)
            $.post( `comment/${id}/unlike`)
        }

        return false;
    });

    $("a.bookmark").click(function(e) {
        e.preventDefault();


        if($(this).hasClass('bookmarked')) {
                $(this).removeAttr('data-original-title').attr({
                    // 'title' : 'Remove from Saved',
                    'data-original-title' : 'Remove from Saved'
                    });
                $('a.bookmark > i').addClass('fa-bookmark-o').removeClass('fa-bookmark');
                $(this).removeClass('bookmarked')
                $('[data-toggle="tooltip"]').tooltip("hide");

            $.post( slug + "/remove-bookmark")

        } else {
                $(this).removeAttr('data-original-title').attr({
                    // 'title' : 'Save for later',
                    'data-original-title' : 'Save for later'
                    });
                $(this).addClass('bookmarked')
                $('a.bookmark > i').addClass('fa-bookmark').removeClass('fa-bookmark-o');
                $('[data-toggle="tooltip"]').tooltip("hide");

            $.post( slug + "/bookmark");
        }

        return false;
    });

    jQuery.fn.shake = function() {
        // this.each(function(i) {
        for (var x = 1; x <= 3; x++) {
                $(this).animate({ marginLeft: 2 }, 10).animate({ marginLeft: -2 }, 50)
            }
        // });
        return this;
    }




function getId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 'error';
    }
}


function replaceOEmbed() {
    let url = $('figure.media oembed').attr('url')

    var videoId = getId(url);

    var iframeMarkup = '<iframe width="560" height="315" src="//www.youtube.com/embed/'
    + videoId + '" frameborder="0" allowfullscreen></iframe>';
    $('figure.media').html(iframeMarkup);

}

replaceOEmbed()

})
