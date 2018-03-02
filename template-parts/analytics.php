<?php $theme_option = flagship_sub_get_global_options(); 
      $analytics_id = $theme_option['flagship_sub_google_analytics']; ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', '<?php echo $analytics_id; ?>', 'jhu.edu');
	ga('create', 'UA-40512757-1', {'name': 'globalKSAS'});
	ga('send', 'pageview');
	ga('globalKSAS.send', 'pageview');

</script>

<!-- End Google Analytics -->

<script async type="text/javascript">
/*<![CDATA[*/
(function() {
var sz = document.createElement('script'); sz.type = 'text/javascript'; sz.async = true;
sz.src = '//siteimproveanalytics.com/js/siteanalyze_11464.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sz, s);
})();
/*]]>*/
</script>

<script async>
function _gaLt(t){for(var e=t.srcElement||t.target;e&&("undefined"==typeof e.tagName||"a"!=e.tagName.toLowerCase()||!e.href);)e=e.parentNode;if(e&&e.href){var a=e.href;if(-1==a.indexOf(location.host)&&!a.match(/^javascript\:/i)){var n=function(t,e){e?window.open(t,e):window.location.href=t},o=e.target&&!e.target.match(/^_(self|parent|top)$/i)?e.target:!1;ga("send","event","Outgoing Links",a,document.location.pathname+document.location.search,{hitCallback:n(a,o)}),t.preventDefault?t.preventDefault():t.returnValue=!1}}}var w=window;w.addEventListener?w.addEventListener("load",function(){document.body.addEventListener("click",_gaLt,!1)},!1):w.attachEvent&&w.attachEvent("onload",function(){document.body.attachEvent("onclick",_gaLt)});
</script>