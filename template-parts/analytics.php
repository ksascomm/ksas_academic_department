<?php
/**
 * Analytics Scripts
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<?php
$theme_option     = flagship_sub_get_global_options();
	$analytics_id = $theme_option['flagship_sub_google_analytics'];
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40512757-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-40512757-1');
	gtag('config', '<?php echo $analytics_id; ?>');
</script>
<!-- End Google Analytics -->

<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PSQVBF6');</script>
<!-- End Google Tag Manager -->

<meta name="facebook-domain-verification" content="s1lj448peh4wqw24bgcc5f2t6n23tc" />
