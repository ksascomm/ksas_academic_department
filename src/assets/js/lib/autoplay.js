$(document).ready(function(){
  var screenWidth = $(window).width();
  // if window width is smaller than 640 when page loads remove the autoplay attribute
  // from the video
  if (screenWidth < 640){
        $('video.hero-video').removeAttr('autoplay');
  } else {
    $('video.hero-video').attr('autoplay');
  }
});