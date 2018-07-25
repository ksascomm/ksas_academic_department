<div class="fullscreen-video hide-for-small-only">
	<div class="responsive-embed panorama jquery-background-video-wrapper">
		<!--Advanced Custom Fields must be enabled!-->
	    <video loop muted autoplay poster="<?php the_field( 'video_poster' ); ?>" class="jquery-background-video" aria-describedby="video-summary" data-bgvideo="true">
	        <source src="<?php the_field( 'source_mp4' ); ?>" type="video/mp4">
	        <source src="<?php the_field( 'source_webm' ); ?>" type="video/webm">
	        <source src="<?php the_field( 'source_ogg' ); ?>" type="video/ogg">
	    </video>
		<div class="controls">
			<!--<button id="playback-button" class="toggle-playback" onclick="playPause()">
				<span class="fas fa-pause-circle"></span>
			</button>-->
			<button class="caption" data-tooltip tabindex="1" title="<?php the_field( 'video_caption_summary' ); ?>">
				<span class="fas fa-info-circle"></span>
			</button>
			<div class="screen-reader-text" id="video-summary">
				<p>Montage of Video Clips:<?php the_field( 'video_caption_summary' ); ?></p>
			</div>
		</div>    
	</div>
</div>

<!--<script defer>
	var video = document.getElementById("homepage-hero-video");
	var isPlaying = false;

	// Get the button
	var btn = document.getElementById("playback-button");

	// Pause and play the video, and change the button text
	function playPause() {
	    if (video.paused) {
	        video.play();
	        btn.innerHTML = "<span class='fas fa-pause-circle'></span>";
	    } else {
	        video.pause();
	        btn.innerHTML = "<span class='fas fa-play-circle'></span>";
	    }
	    isPlaying = !isPlaying;
}

  //$( ".toggle-playback" ).click(function() {
    //$( ".toggle-playback" ).css('background', 'rgba(255,255,255, 0.3)');
  //});
</script>-->