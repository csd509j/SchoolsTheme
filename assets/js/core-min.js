jQuery(function($){var e=$("#search-toggle i"),s=$("#search-bar"),a=$("#search-text");$("#search-toggle").on("click",function(r){r.preventDefault(),"search-toggle"===$(this).attr("id")&&(s.is(":visible")?e.removeClass("fa-search-minus").addClass("fa-search"):e.removeClass("fa-search").addClass("fa-search-minus"),s.slideToggle(250,function(){a.focus()}))}),$("#searchform").submit(function(e){e.preventDefault()})});