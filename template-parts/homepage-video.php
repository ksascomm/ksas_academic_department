<div class="fullscreen-video hide-for-small-only">
	<div class="responsive-embed panorama jquery-background-video-wrapper">
		<!--Advanced Custom Fields must be enabled!-->
		<video loop muted poster="<?php the_field( 'video_poster' ); ?>" class="jquery-background-video" aria-describedby="video-summary" data-bgvideo="true">
			<source src="<?php the_field( 'source_mp4' ); ?>" type="video/mp4">
			<source src="<?php the_field( 'source_webm' ); ?>" type="video/webm">
			<source src="<?php the_field( 'source_ogg' ); ?>" type="video/ogg">
		</video>
		<div class="controls">
			<button class="caption" data-tooltip title="<?php the_field( 'video_caption_summary' ); ?>">
				<span class="fa-solid fa-circle-info"></span>
			</button>
			<div class="screen-reader-text" id="video-summary">
				<p>Montage of Video Clips:<?php the_field( 'video_caption_summary' ); ?></p>
			</div>
		</div>    
	</div>
</div>
