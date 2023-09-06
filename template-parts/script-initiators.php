<?php
/**
 * These conditionals run on specific single custom post types or page templates
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<?php
if ( is_page_template( 'page-templates/courses-undergrad.php' ) || is_page_template( 'page-templates/courses-graduate.php' ) ) :

	wp_enqueue_style( 'data-tables', '//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css', array(), true );

	wp_enqueue_script( 'data-tables', '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array(), '1.13.4', false );
	wp_script_add_data( 'data-tables', 'defer', true );
	?>

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

<?php
if ( is_page_template( 'page-templates/courses-undergrad-all.php' ) ) :

	wp_enqueue_style( 'data-tables', '//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css', array(), true );
	wp_enqueue_style( 'data-tables-searchpanes', '//cdn.datatables.net/searchpanes/2.1.1/css/searchPanes.dataTables.min.css', array(), true );

	wp_enqueue_script( 'data-tables', '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array(), '1.13.4', false );
	wp_script_add_data( 'data-tables', 'defer', true );

	wp_enqueue_script( 'data-tables-searchpanes', '//cdn.datatables.net/searchpanes/2.1.1/js/dataTables.searchPanes.min.js', array(), '2.1.1', false );
	wp_script_add_data( 'data-tables-searchpanes', 'defer', true );

	wp_enqueue_script( 'data-tables-select', '//cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js', array(), '1.4.0', false );
	wp_script_add_data( 'data-tables-select', 'defer', true );
	?>

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
			searchPanes: {
					preSelect: [{
						rows:['Fall 2023'],
						column: 5
					}],
				},
			columnDefs: [
			{
				//This hides all but Term pane from search/filter
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
