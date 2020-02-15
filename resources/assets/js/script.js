
/*!

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2018 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
"use strict";var map,lat,lng,Datepicker=function(){var e=$(".datepicker");e.length&&e.each(function(){!function(e){e.datepicker({disableTouchKeyboard:!0,autoclose:!1})}($(this))})}(),CopyIcon=function(){var e,a=".btn-icon-clipboard",t=$(a);t.length&&((e=t).tooltip().on("mouseleave",function(){e.tooltip("hide")}),new ClipboardJS(a).on("success",function(e){$(e.trigger).attr("title","Copied!").tooltip("_fixTitle").tooltip("show").attr("title","Copy to clipboard").tooltip("_fixTitle"),e.clearSelection()}))}(),FormControl=function(){var e=$(".form-control");e.length&&e.on("focus blur",function(e){$(this).parents(".form-group").toggleClass("focused","focus"===e.type||0<this.value.length)}).trigger("blur")}(),$map=$("#map-canvas"),color="#5e72e4";function initMap(){map=document.getElementById("map-canvas"),lat=map.getAttribute("data-lat"),lng=map.getAttribute("data-lng");var e=new google.maps.LatLng(lat,lng),a={zoom:12,scrollwheel:!1,center:e,mapTypeId:google.maps.MapTypeId.ROADMAP,styles:[{featureType:"administrative",elementType:"labels.text.fill",stylers:[{color:"#444444"}]},{featureType:"landscape",elementType:"all",stylers:[{color:"#f2f2f2"}]},{featureType:"poi",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"all",stylers:[{saturation:-100},{lightness:45}]},{featureType:"road.highway",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.arterial",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{color:color},{visibility:"on"}]}]};map=new google.maps.Map(map,a);var t=new google.maps.Marker({position:e,map:map,animation:google.maps.Animation.DROP,title:"Hello World!"}),o=new google.maps.InfoWindow({content:'<div class="info-window-content"><h2>Argon Dashboard</h2><p>A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</p></div>'});google.maps.event.addListener(t,"click",function(){o.open(map,t)})}$map.length&&google.maps.event.addDomListener(window,"load",initMap);var Navbar=function(){var a=$(".navbar-nav, .navbar-nav .nav"),t=$(".navbar .collapse"),e=$(".navbar .dropdown");t.on({"show.bs.collapse":function(){!function(e){e.closest(a).find(t).not(e).collapse("hide")}($(this))}}),e.on({"hide.bs.dropdown":function(){!function(e){var a=e.find(".dropdown-menu");a.addClass("close"),setTimeout(function(){a.removeClass("close")},200)}($(this))}})}(),NavbarCollapse=function(){$(".navbar-nav");var e=$(".navbar .collapse");e.length&&(e.on({"hide.bs.collapse":function(){!function(e){e.addClass("collapsing-out")}(e)}}),e.on({"hidden.bs.collapse":function(){!function(e){e.removeClass("collapsing-out")}(e)}}))}(),noUiSlider=function(){if($(".input-slider-container")[0]&&$(".input-slider-container").each(function(){var e=$(this).find(".input-slider"),a=e.attr("id"),t=e.data("range-value-min"),o=e.data("range-value-max"),n=$(this).find(".range-slider-value"),r=n.attr("id"),l=n.data("range-value-low"),i=document.getElementById(a),s=document.getElementById(r);noUiSlider.create(i,{start:[parseInt(l)],connect:[!0,!1],range:{min:[parseInt(t)],max:[parseInt(o)]}}),i.noUiSlider.on("update",function(e,a){s.textContent=e[a]})}),$("#input-slider-range")[0]){var e=document.getElementById("input-slider-range"),a=document.getElementById("input-slider-range-value-low"),t=document.getElementById("input-slider-range-value-high"),o=[a,t];noUiSlider.create(e,{start:[parseInt(a.getAttribute("data-range-value-low")),parseInt(t.getAttribute("data-range-value-high"))],connect:!0,range:{min:parseInt(e.getAttribute("data-range-value-min")),max:parseInt(e.getAttribute("data-range-value-max"))}}),e.noUiSlider.on("update",function(e,a){o[a].textContent=e[a]})}}(),Popover=function(){var e=$('[data-toggle="popover"]'),t="";e.length&&e.each(function(){!function(e){e.data("color")&&(t="popover-"+e.data("color"));var a={trigger:"focus",template:'<div class="popover '+t+'" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'};e.popover(a)}($(this))})}(),ScrollTo=function(){var e=$(".scroll-me, [data-scroll-to], .toc-entry a");e.length&&e.on("click",function(){!function(e){var a=e.attr("href"),t=e.data("scroll-to-offset")?e.data("scroll-to-offset"):0,o={scrollTop:$(a).offset().top-t};$("html, body").stop(!0,!0).animate(o,600),event.preventDefault()}($(this))})}(),Tooltip=function(){var e=$('[data-toggle="tooltip"]');e.length&&e.tooltip()}(),Charts=function(){var e,a=$('[data-toggle="chart"]'),t="light",o={base:"Open Sans"},n={gray:{100:"#f6f9fc",200:"#e9ecef",300:"#dee2e6",400:"#ced4da",500:"#adb5bd",600:"#8898aa",700:"#525f7f",800:"#32325d",900:"#212529"},theme:{default:"#172b4d",primary:"#5e72e4",secondary:"#f4f5f7",info:"#11cdef",success:"#2dce89",danger:"#f5365c",warning:"#fb6340"},black:"#12263F",white:"#FFFFFF",transparent:"transparent"};function r(e,a){for(var t in a)"object"!=typeof a[t]?e[t]=a[t]:r(e[t],a[t])}function l(e){var a=e.data("add"),t=$(e.data("target")).data("chart");e.is(":checked")?function e(a,t){for(var o in t)Array.isArray(t[o])?t[o].forEach(function(e){a[o].push(e)}):e(a[o],t[o])}(t,a):function e(a,t){for(var o in t)Array.isArray(t[o])?t[o].forEach(function(){a[o].pop()}):e(a[o],t[o])}(t,a),t.update()}function i(e){var a=e.data("update"),t=$(e.data("target")).data("chart");r(t,a),function(e,a){if(void 0!==e.data("prefix")||void 0!==e.data("prefix")){var r=e.data("prefix")?e.data("prefix"):"",l=e.data("suffix")?e.data("suffix"):"";a.options.scales.yAxes[0].ticks.callback=function(e){if(!(e%10))return r+e+l},a.options.tooltips.callbacks.label=function(e,a){var t=a.datasets[e.datasetIndex].label||"",o=e.yLabel,n="";return 1<a.datasets.length&&(n+='<span class="popover-body-label mr-auto">'+t+"</span>"),n+='<span class="popover-body-value">'+r+o+l+"</span>"}}}(e,t),t.update()}return window.Chart&&r(Chart,(e={defaults:{global:{responsive:!0,maintainAspectRatio:!1,defaultColor:n.gray[600],defaultFontColor:n.gray[600],defaultFontFamily:o.base,defaultFontSize:13,layout:{padding:0},legend:{display:!1,position:"bottom",labels:{usePointStyle:!0,padding:16}},elements:{point:{radius:0,backgroundColor:n.theme.primary},line:{tension:.4,borderWidth:4,borderColor:n.theme.primary,backgroundColor:n.transparent,borderCapStyle:"rounded"},rectangle:{backgroundColor:n.theme.warning},arc:{backgroundColor:n.theme.primary,borderColor:n.white,borderWidth:4}},tooltips:{enabled:!1,mode:"index",intersect:!1,custom:function(o){var e=$("#chart-tooltip");if(e.length||(e=$('<div id="chart-tooltip" class="popover bs-popover-top" role="tooltip"></div>'),$("body").append(e)),0!==o.opacity){if(o.body){var a=o.title||[],n=o.body.map(function(e){return e.lines}),r="";r+='<div class="arrow"></div>',a.forEach(function(e){r+='<h3 class="popover-header text-center">'+e+"</h3>"}),n.forEach(function(e,a){o.labelColors[a].backgroundColor;var t=1<n.length?"justify-content-left":"justify-content-center";r+='<div class="popover-body d-flex align-items-center '+t+'"><span class="badge badge-dot"><i class="bg-primary"></i></span>'+e+"</div>"}),e.html(r)}var t=$(this._chart.canvas),l=(t.outerWidth(),t.outerHeight(),t.offset().top),i=t.offset().left,s=e.outerWidth(),d=e.outerHeight(),c=l+o.caretY-d-16,p=i+o.caretX-s/2;e.css({top:c+"px",left:p+"px",display:"block","z-index":"100"})}else e.css("display","none")},callbacks:{label:function(e,a){var t=a.datasets[e.datasetIndex].label||"",o=e.yLabel,n="";return 1<a.datasets.length&&(n+='<span class="badge badge-primary mr-auto">'+t+"</span>"),n+='<span class="popover-body-value">'+o+"</span>"}}}},doughnut:{cutoutPercentage:83,tooltips:{callbacks:{title:function(e,a){return a.labels[e[0].index]},label:function(e,a){var t="";return t+='<span class="popover-body-value">'+a.datasets[0].data[e.index]+"</span>"}}},legendCallback:function(e){var o=e.data,n="";return o.labels.forEach(function(e,a){var t=o.datasets[0].backgroundColor[a];n+='<span class="chart-legend-item">',n+='<i class="chart-legend-indicator" style="background-color: '+t+'"></i>',n+=e,n+="</span>"}),n}}}},Chart.scaleService.updateScaleDefaults("linear",{gridLines:{borderDash:[2],borderDashOffset:[2],color:n.gray[300],drawBorder:!1,drawTicks:!1,lineWidth:0,zeroLineWidth:0,zeroLineColor:n.gray[300],zeroLineBorderDash:[2],zeroLineBorderDashOffset:[2]},ticks:{beginAtZero:!0,padding:10,callback:function(e){if(!(e%10))return e}}}),Chart.scaleService.updateScaleDefaults("category",{gridLines:{drawBorder:!1,drawOnChartArea:!1,drawTicks:!1},ticks:{padding:20},maxBarThickness:10}),e)),a.on({change:function(){var e=$(this);e.is("[data-add]")&&l(e)},click:function(){var e=$(this);e.is("[data-update]")&&i(e)}}),{colors:n,fonts:o,mode:t}}(),OrdersChart=function(){var e,a,t=$("#chart-orders");$('[name="ordersSelect"]');t.length&&(e=t,a=new Chart(e,{type:"bar",options:{scales:{yAxes:[{gridLines:{lineWidth:1,color:"#dfe2e6",zeroLineColor:"#dfe2e6"},ticks:{callback:function(e){if(!(e%10))return e}}}]},tooltips:{callbacks:{label:function(e,a){var t=a.datasets[e.datasetIndex].label||"",o=e.yLabel,n="";return 1<a.datasets.length&&(n+='<span class="popover-body-label mr-auto">'+t+"</span>"),n+='<span class="popover-body-value">'+o+"</span>"}}}},data:{labels:["Jul","Aug","Sep","Oct","Nov","Dec"],datasets:[{label:"Sales",data:[25,20,30,22,17,29]}]}}),e.data("chart",a))}(),SalesChart=function(){var e,a,t=$("#chart-sales");t.length&&(e=t,a=new Chart(e,{type:"line",options:{scales:{yAxes:[{gridLines:{lineWidth:1,color:Charts.colors.gray[900],zeroLineColor:Charts.colors.gray[900]},ticks:{callback:function(e){if(!(e%10))return"$"+e+"k"}}}]},tooltips:{callbacks:{label:function(e,a){var t=a.datasets[e.datasetIndex].label||"",o=e.yLabel,n="";return 1<a.datasets.length&&(n+='<span class="popover-body-label mr-auto">'+t+"</span>"),n+='<span class="popover-body-value">$'+o+"k</span>"}}}},data:{labels:["May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],datasets:[{label:"Performance",data:[0,20,10,30,15,40,20,60,60]}]}}),e.data("chart",a))}();


$(document).ready(function() {
    var btn = $("button[type='submit']");

    $("#form").submit(function() {
        btn.attr('disabled', true);
        btn.html('<i class="fa fa-spin fa-spinner"></i> Please wait...')
    });


  $(window).on('scroll', function (event) {
      var scrollValue = $(window).scrollTop();
          if (scrollValue > 262 ) {
              $('.affixed').addClass('affix');
          } else{
              $('.affixed').removeClass('affix');
          }
  });
})



  $(window).on('load', function(e) {
      e.preventDefault()

      let url = window.location.href.split('#');

      if(url[1]) {
          $('html, body').animate(
          {
              scrollTop: $(`#comment-${url[1]}`).offset().top,
          },
          500,
          'linear'
      )
      }

  })

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
  }

//# sourceMappingURL=_site_dashboard_free/assets/js/dashboard-free.js.map
