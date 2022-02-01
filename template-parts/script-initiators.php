<?php
/**
 * These conditionals run on specific single custom post types or page templates
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<?php if ( is_page_template( 'page-templates/courses-undergrad.php' ) || is_page_template( 'page-templates/courses-graduate.php' ) ) : ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css/>
	<script type="text/javascript" defer src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
		} );

		$('table.course-table').DataTable( {
			"order": [[ 0, "asc" ]],
			"lengthMenu": [[15, 30, -1],[15, 30, "All"]],
			"dom": '<"top"f>ilrt<"bottom"p><"clear">',
			"language": {
				"emptyTable": "Courses have a status of Closed, or are unavailable at this time. Please try again later."
			}
		} );
	} );
	</script>
<?php endif; ?>

<?php if ( is_page_template( 'page-templates/courses-undergrad-all.php' ) ) : ?>
	<link rel="stylesheet" type="text/css" href="hhttps://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
		} );

		$('table.course-table').DataTable( {
			"order": [[ 0, "asc" ]],
			"lengthMenu": [[15, 30, -1],[15, 30, "All"]],
			"dom": 'Plfrtip',
			"language": {
				"emptyTable": "Courses have a status of Closed, or are unavailable at this time. Please try again later."
			},
			columnDefs: [
			{
				searchPanes: {
					show: true,
					preSelect: ['Fall 2021']
				},
				targets: [5]
			},
			{
				searchPanes: {
					show: false
				},
				targets: [0,1,2,3,4,6]
			}
		]
		} );
	} );
	</script>
<?php endif; ?>

<?php if ( is_singular( 'post' ) ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-label="About"]').addClass('current_page_parent current_page_ancestor');
	});
	</script>
<?php elseif ( is_singular( 'bulletinboard' ) ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-label="Undergraduate"]').addClass('current_page_parent current_page_ancestor');
		$('a[aria-label="Opportunities"]').addClass('current_page_parent current_page_ancestor');
	});
	</script>

<?php elseif ( is_singular( 'tribe_events' ) ) : ?>
	<script>
	jQuery(document).ready( function($) {
	$('a[aria-label="Events"]').addClass('current_page_parent current_page_ancestor');
	$('li.cpt-parent').addClass('current_page_parent current_page_ancestor');
	});
	</script>

<?php elseif ( is_singular( 'ksasexhibits' ) ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('li.custom-post-type').addClass('current_page_parent current_page_ancestor');
	});
	</script>
<?php elseif ( is_singular( 'people' ) ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-label="People"]').addClass('current_page_item current_page_parent current_page_ancestor');
	});
	</script>
<?php endif; ?>
