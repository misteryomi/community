/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/post-script.js":
/*!********************************************!*\
  !*** ./resources/assets/js/post-script.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#submit-comment').click(function (e) {
    e.preventDefault();
    var comment = editor.getData();
    $("input[name=comment]").val(comment);
    $('#comment-form').submit();
    return false;
  });
  $("a > .like").click(function (e) {
    e.preventDefault();

    if (!loggedIn) {
      $('#auth-modal').modal('show');
    } else {
      $(this).shake();

      if ($(this).hasClass('liked')) {
        $(this).removeClass('liked fa-thumbs-up').addClass('fa-thumbs-o-up');
        $('.likes-count').text(parseInt($('.likes-count').text()) - 1);
        $.post(slug + "/unlike");
      } else {
        $(this).removeClass('fa-thumbs-o-up').addClass('liked fa-thumbs-up');
        $('.likes-count').text(parseInt($('.likes-count').text()) + 1);
        $.post(slug + "/like");
      }
    }

    return false;
  });
  $("a.comment-like").click(function (e) {
    e.preventDefault();
    var el = $(this).find('i.fa');
    var id = $(this).attr('data-id');
    var likesEl = $(".comment-likes-count[data-id=" + id + "]");
    $(this).shake();

    if ($(this).hasClass('liked')) {
      $(el).removeClass('liked fa-thumbs-up').addClass('fa-thumbs-o-up');
      likesEl.text(parseInt(likesEl.text()) - 1);
      $.post("comment/".concat(id, "/unlike"));
    } else {
      $(el).removeClass('fa-thumbs-o-up').addClass('liked fa-thumbs-up');
      likesEl.text(parseInt(likesEl.text()) + 1);
      $.post("comment/".concat(id, "/unlike"));
    }

    return false;
  });
  $("a.bookmark").click(function (e) {
    e.preventDefault();

    if ($(this).hasClass('bookmarked')) {
      $(this).removeAttr('data-original-title').attr({
        // 'title' : 'Remove from Saved',
        'data-original-title': 'Remove from Saved'
      });
      $('a.bookmark > i').addClass('fa-bookmark-o').removeClass('fa-bookmark');
      $(this).removeClass('bookmarked');
      $('[data-toggle="tooltip"]').tooltip("hide");
      $.post(slug + "/remove-bookmark");
    } else {
      $(this).removeAttr('data-original-title').attr({
        // 'title' : 'Save for later',
        'data-original-title': 'Save for later'
      });
      $(this).addClass('bookmarked');
      $('a.bookmark > i').addClass('fa-bookmark').removeClass('fa-bookmark-o');
      $('[data-toggle="tooltip"]').tooltip("hide");
      $.post(slug + "/bookmark");
    }

    return false;
  });

  jQuery.fn.shake = function () {
    // this.each(function(i) {
    for (var x = 1; x <= 3; x++) {
      $(this).animate({
        marginLeft: 2
      }, 10).animate({
        marginLeft: -2
      }, 50);
    } // });


    return this;
  };

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
    var url = $('figure.media oembed').attr('url');
    var videoId = getId(url);
    var iframeMarkup = '<iframe width="560" height="315" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';
    $('figure.media').html(iframeMarkup);
  }

  replaceOEmbed();
});

/***/ }),

/***/ 1:
/*!**************************************************!*\
  !*** multi ./resources/assets/js/post-script.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\yarnable\resources\assets\js\post-script.js */"./resources/assets/js/post-script.js");


/***/ })

/******/ });