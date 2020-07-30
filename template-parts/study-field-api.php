<?php
/**
* The default template for displaying studyfields data via the krieger.jhu.edu's api
*
* @package FoundationPress
* @since FoundationPress 1.0.0
*/
?>
<?php 
	$studyfieldacf = get_field( 'studyfield' );
	$studyfield_url = 'https://krieger.jhu.edu/wp-json/wp/v2/studyfields?slug='. $studyfieldacf;

	if ( WP_DEBUG or false === ( $studyfield = get_transient( 'studyfield_api_query' ) ) ) {
		$studyfield = wp_remote_get($studyfield_url);
		set_transient( 'studyfield_api_query', $studyfield, 2419200 ); 
	}		

	// Display a error nothing is returned.
	if ( is_wp_error( $studyfield ) ) {
		$error_string = $studyfield->get_error_message();
		echo '<script>console.log("Error:' . $error_string . '")</script>';

	}
	// Get the body.		
	$studyfield_response = json_decode( wp_remote_retrieve_body( $studyfield ) );

	// Display a warning nothing is returned.
	if ( empty( $studyfield_response ) ) {
		echo '<script>console.log("Error: There is no API Response")</script>';
	}

	if ( ! empty( $studyfield_response ) ) :?>
	<div class="caption">
	<?php foreach($studyfield_response as $studyfield_data):?>

		<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_headline[0] ) ) :?>
			<h1>
				<?php echo $studyfield_data->post_meta_fields->ecpt_headline[0];?>	
			</h1>
		<?php endif;?>	
		<ul>
			<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_degreesoffered[0] ) ) :?>
				<li>Degrees Offered: <?php echo $studyfield_data->post_meta_fields->ecpt_degreesoffered[0];?></li>
			<?php endif;?>
			<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_majors[0] ) ) :?>
				<li>Majors: <?php echo $studyfield_data->post_meta_fields->ecpt_majors[0];?></li>
			<?php endif;?>
			<?php if ( ! empty( $studyfield_data->post_meta_fields->ecpt_minors[0] ) ) :?>
				<li>Minors: <?php echo $studyfield_data->post_meta_fields->ecpt_minors[0];?></li>
			<?php endif;?>
		</ul>
	<?php endforeach;?>
	</div>
<?php endif;?>