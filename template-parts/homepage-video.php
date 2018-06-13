<div class="fullscreen-video hide-for-small-only">
	<div class="responsive-embed panorama">
		<!--Advanced Custom Fields must be enabled!-->
	    <video loop muted autoplay poster="<?php the_field( 'video_poster' ); ?>" class="hero-video">
	        <source src="<?php the_field( 'source_mp4' ); ?>" type="video/mp4">
	        <source src="<?php the_field( 'source_webm' ); ?>" type="video/webm">
	        <source src="<?php the_field( 'source_ogg' ); ?>" type="video/ogg">
	    </video>
	</div>
</div>