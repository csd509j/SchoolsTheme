jQuery((function(e){var a=e("#search-toggle i"),t=e("#search-bar"),r=e("#search-text");e("#search-toggle").on("click",(function(s){s.preventDefault(),"search-toggle"===e(this).attr("id")&&(t.is(":visible")?a.removeClass("fa-search-minus").addClass("fa-search"):a.removeClass("fa-search").addClass("fa-search-minus"),t.slideToggle(250,(function(){r.focus()})))})),e("#searchform").submit((function(e){e.preventDefault()}));var s=["csd509j.net","https://teachcorvallis.org"];e('a[href^="http"]').on("click",(function(a){var t=e(this).attr("href");void 0===s.find((function(e){var a=new RegExp(e);return null!==t.match(a)}))&&(a.preventDefault(),e("#externalLink").attr("href",e(this).attr("href")),e("#modalNotification").modal("show"))}))}));