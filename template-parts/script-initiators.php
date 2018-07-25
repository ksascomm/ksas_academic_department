<?php
/**
 * These conditionals run on specific single custom post types or page templates
 */

?>

<?php if (is_page_template('page-templates/courses-undergrad.php') || is_page_template('page-templates/courses-graduate.php') ) : ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.16/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.16/datatables.min.js"></script>
  <script>
    jQuery(document).ready( function($) {
      $('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
          $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
      } );
    
      $('table.course-table').DataTable( {
          "order": [[ 0, "asc" ]],
          "lengthMenu": [[15, 30, -1],[15, 30, "All"]],
          "dom": '<"top"f>ilrt<"bottom"p><"clear">'
      } );
  } );
  </script>
<?php endif; ?>


<?php if ( is_singular('post') ) : ?>
  <script>
    jQuery(document).ready( function($) {
      $('li[aria-label="About"]').addClass('current_page_parent current_page_ancestor');
    });
  </script>
<?php elseif (is_singular('bulletinboard') ) : ?>
  <script>
    jQuery(document).ready( function($) {
      $('li[aria-label="Undergraduate"]').addClass('current_page_parent current_page_ancestor');
      $('li[aria-label="Opportunities"]').addClass('current_page_parent current_page_ancestor');
    });
  </script>

<?php elseif (is_singular('ai1ec_event') ) : ?>
  <script>
    jQuery(document).ready( function($) {
      $('li[aria-label="Events"]').addClass('current_page_parent current_page_ancestor');
    });
  </script>

<?php elseif (is_singular('ksasexhibits') ) : ?>
  <script>
    jQuery(document).ready( function($) {
      $('li[aria-label="Exhibits & Projects"]').addClass('current_page_parent current_page_ancestor');
    });
  </script>
<?php elseif (is_singular('people') ) : ?>
  <script>
    jQuery(document).ready( function($) {
      $('li[aria-label="People"]').addClass('current_page_item current_page_parent current_page_ancestor');
    });
  </script>
<?php endif; ?>