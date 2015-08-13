<script type="text/javascript"><!--
	
	
	(function(jQuery){
		function initFlyouts(){
			initPublishedFlyoutMenus(
				[{"id":"695504650311740868","title":"Events","url":"index.html","target":""},{"id":"816082638693586883","title":"About ","url":"about.html","target":""},{"id":"767616320288829704","title":"Buzz","url":"buzz.html","target":""},{"id":"571607432916306143","title":"Venue Consulting","url":"venue-consulting.html","target":""},{"id":"586004458198545890","title":"Contact ","url":"contact.html","target":""}],
				"617672315450377345",
				"<li class=\"wsite-menu-item-wrap\"><a href=\"#\" data-membership-required=\"\" class=\"wsite-menu-item\">{{title}}<\/a><\/li>",
				'{{id}}',
				false,
				{"menu\/submenu-main":"<div class=\"wsite-menu-wrap\" style=\"display:none\">{{! Designer note: \"wsite-menu-wrap\" required on submenu wrapper }}\n\t<ul class=\"wsite-menu\">{{! Designer note: \"wsite-menu\" required on submenu element }}\n\t\t{{#children}}{{> menu\/submenu-item}}{{\/children}}\n\t<\/ul>\n<\/div>\n","menu\/submenu-item":"<li{{#id}} id=\"{{id}}\"{{\/id}} class=\"wsite-menu-subitem-wrap{{#current_page}} wsite-nav-current{{\/current_page}}\">{{! Designer note: id required & \"wsite-menu-subitem-wrap\" required on the item wrap }}\n\t<a href=\"{{itemlink}}\"{{#target}} target=\"{{target}}\"{{\/target}} class=\"wsite-menu-subitem\">{{! Designer note: \"wsite-menu-subitem\" required on the item link }}\n\t\t<span class=\"wsite-menu-title\">\n\t\t\t{{{itemtitle}}}\n\t\t<\/span>{{#has_children}}<span class=\"wsite-menu-arrow\">&gt;<\/span>{{\/has_children}}\n\t<\/a>\n\t{{#has_children}}{{> menu\/submenu-main}}{{\/has_children}}\n<\/li>\n","menu\/main":"<ul class=\"wsite-menu-default\">{{> menu\/main-without-wrap}}<\/ul>{{! Designer note: \"wsite-menu-default\" required on menu element }}\n","menu\/main-without-wrap":"{{#links}}{{!\n}}{{#current_page}}{{> menu\/item-current}}{{\/current_page}}{{!\n}}{{^current_page}}{{> menu\/item}}{{\/current_page}}{{!\n}}{{\/links}}\n","menu\/item-current":"<li{{#id}} id=\"{{id}}\"{{\/id}} class=\"wsite-menu-item-wrap\">{{! Designer note: id required & \"wsite-menu-item-wrap\" required on the item wrapper }}\n\t<a href=\"{{itemlink}}\"{{#target}} target=\"{{target}}\"{{\/target}} class=\"wsite-menu-item\">{{! Designer note: \"wsite-menu-item\" required on the item link }}\n\t\t{{{itemtitle}}}\n\t<\/a>\n\t{{#has_children}}{{> menu\/submenu-main}}{{\/has_children}}\n<\/li>\n","menu\/item":"<li{{#id}} id=\"{{id}}\"{{\/id}} class=\"wsite-menu-item-wrap\">{{! Designer note: id required & \"wsite-menu-item-wrap\" required on the item wrapper }}\n\t<a href=\"{{itemlink}}\" data-membership-required=\"{{membership-required}}\"{{#target}} target=\"{{target}}\"{{\/target}} class=\"wsite-menu-item\">{{! Designer note: \"wsite-menu-item\" required on the item link }}\n\t\t{{{itemtitle}}}\n\t<\/a>\n\t{{#has_children}}{{> menu\/submenu-main}}{{\/has_children}}\n<\/li>\n"}
			)
		}
		if (jQuery) {
			jQuery(document).ready(function() { jQuery(initFlyouts); });
		}else{
			if (Prototype.Browser.IE) window.onload = initFlyouts;
			else document.observe('dom:loaded', initFlyouts);
		}
	})(window._W && _W.jQuery)
//-->
</script>