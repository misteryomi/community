!function(t) {
    var e = {};
    function a(o) {
        if (e[o])
            return e[o].exports;
        var r = e[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return t[o].call(r.exports, r, r.exports, a),
        r.l = !0,
        r.exports
    }
    a.m = t,
    a.c = e,
    a.d = function(t, e, o) {
        a.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: o
        })
    }
    ,
    a.r = function(t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }),
        Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }
    ,
    a.t = function(t, e) {
        if (1 & e && (t = a(t)),
        8 & e)
            return t;
        if (4 & e && "object" == typeof t && t && t.__esModule)
            return t;
        var o = Object.create(null);
        if (a.r(o),
        Object.defineProperty(o, "default", {
            enumerable: !0,
            value: t
        }),
        2 & e && "string" != typeof t)
            for (var r in t)
                a.d(o, r, function(e) {
                    return t[e]
                }
                .bind(null, r));
        return o
    }
    ,
    a.n = function(t) {
        var e = t && t.__esModule ? function() {
            return t.default
        }
        : function() {
            return t
        }
        ;
        return a.d(e, "a", e),
        e
    }
    ,
    a.o = function(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }
    ,
    a.p = "/",
    a(a.s = 2)
}([, , function(t, e, a) {
    t.exports = a(3)
}
, function(t, e) {
    $(document).ready((function() {
        var t, e, a;
        $("#submit-comment").click((function(t) {
            t.preventDefault();
            var e = editor.getData();
            return $("input[name=comment]").val(e),
            $("#comment-form").submit(),
            !1
        }
        )),
        $("a.like").click((function(t) {
            // console.log($(this))
            return t.preventDefault(),
            loggedIn ? ($(this).shake(),
            $(this).hasClass("liked") ? ($(this).removeClass("liked").addClass("liked"),
            $(".likes-count").text(parseInt($(".likes-count").text()) - 1),
            $.post(slug + "/unlike")) : ($(this).removeClass("fa-thumbs-o-up").addClass("liked fa-thumbs-up"),
            $(".likes-count").text(parseInt($(".likes-count").text()) + 1),
            $.post(slug + "/like"))) : $("#auth-modal").modal("show"),
            !1
        }
        )),
        $("a.comment-like").click((function(t) {
            t.preventDefault();
            var e = $(this).find("i.fa")
              , a = $(this).attr("data-id")
              , o = $(".comment-likes-count[data-id=" + a + "]");
            return $(this).shake(),
            $(this).hasClass("liked") ? ($(e).removeClass("liked fa-thumbs-up").addClass("fa-thumbs-o-up"),
            o.text(parseInt(o.text()) - 1),
            $.post("comment/".concat(a, "/unlike"))) : ($(e).removeClass("fa-thumbs-o-up").addClass("liked fa-thumbs-up"),
            o.text(parseInt(o.text()) + 1),
            $.post("comment/".concat(a, "/unlike"))),
            !1
        }
        )),
        $("a.bookmark").click((function(t) {
            return t.preventDefault(),
            $(this).hasClass("bookmarked") ? ($(this).removeAttr("data-original-title").attr({
                "data-original-title": "Remove from Saved"
            }),
            $("a.bookmark > i").addClass("fa-bookmark-o").removeClass("fa-bookmark"),
            $(this).removeClass("bookmarked"),
            $('[data-toggle="tooltip"]').tooltip("hide"),
            $.post(slug + "/remove-bookmark")) : ($(this).removeAttr("data-original-title").attr({
                "data-original-title": "Save for later"
            }),
            $(this).addClass("bookmarked"),
            $("a.bookmark > i").addClass("fa-bookmark").removeClass("fa-bookmark-o"),
            $('[data-toggle="tooltip"]').tooltip("hide"),
            $.post(slug + "/bookmark")),
            !1
        }
        )),
        jQuery.fn.shake = function() {
            for (var t = 1; t <= 3; t++)
                $(this).animate({
                    marginLeft: 2
                }, 10).animate({
                    marginLeft: -2
                }, 50);
            return this
        }
        ,
        a = '<iframe width="560" height="315" src="//www.youtube.com/embed/' + (t = $("figure.media oembed").attr("url"),
        (e = t.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/)) && 11 == e[2].length ? e[2] : "error") + '" frameborder="0" allowfullscreen></iframe>',
        $("figure.media").html(a)
    }
    ))
}
]);
