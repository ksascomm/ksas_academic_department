jQuery(document).ready( function($) {
	$('ul.sub-menu.submenu.is-drilldown-submenu.invisible').attr('aria-label', 'Quicklinks');
	$('.mobile-off-canvas-menu ul li').removeAttr('role', 'treeitem');
	$('.mobile-off-canvas-menu ul li').attr('role', 'menuitem');
});