<?php
/**
* The default template for displaying news via the hub's api
*
* @package FoundationPress
* @since FoundationPress 1.0.0
*/
?>
<?php
$theme_option = flagship_sub_get_global_options();
$selection = $theme_option['flagship_sub_hub_topic_keyword'];
if ('keyword' === $selection ) {
	$keywords = $theme_option['flagship_sub_hub_keywords'];
	$hub_url = 'https://api.hub.jhu.edu/articles?v=1&key=bed3238d428c2c710a65d813ebfb2baa664a2fef&tags=' . $keywords . '&per_page=3';
} elseif ('topic' === $selection ) {
	$topic = $theme_option['flagship_sub_hub_topic'];
	$topics = array(
		'arts-culture' => 32,
		'at-work' => 3158,
		'athletics' => 34,
		'health' => 31,
		'politics-society' => 167,
		'science-technology' => 33,
		'student-life' => 36,
		'university-news' => 35,
		'voices-opinion' => 37
		);
	$topic_slug = $theme_option['flagship_sub_hub_topic'];
	$hub_url = 'https://api.hub.jhu.edu/topics/' . $topics[$topic_slug] . '/articles?v=1&key=bed3238d428c2c710a65d813ebfb2baa664a2fef&per_page=3&source=all';
	}
	$hub_call = wp_remote_get($hub_url);
	if (is_array($hub_call) && ! empty($hub_call['body']) ) {
	$hub_results = json_decode($hub_call['body'], true);
	} else {
	return false; // wp_remote_get failed somehow
	}
	$hub_articles = $hub_results['_embedded'];
	if (is_array($hub_articles)) {
	foreach ($hub_articles['articles'] as $hub_article ) {
?>
<article class="post-listing hub-article" aria-labelledby="post-<?php echo $hub_article['id']; ?>">
	<header>
		<?php
		$date = $hub_article['publish_date'];
		// $dt = new DateTime("@$date");
		?>
		<time class="updated" datetime="<?php echo $hub_article['publish_date']; ?>"><?php echo date('F d, Y', $date); ?></time>
		<h2><a href="<?php echo $hub_article['url']; ?>" id="post-<?php echo $hub_article['id']; ?>"><?php echo $hub_article['headline']; ?></a></h2>
	</header>
	<div class="entry-content">
		<div class="grid-x">
			<div class="small-6 large-4 cell">
				<img class="news-thumb" src="<?php echo $hub_article['_embedded']['image_thumbnail'][0]['sizes']['thumbnail']; ?>" alt="From The Hub: <?php echo $hub_article['headline']; ?>" />
			</div>
			<div class="small-6 large-8 cell">
				<summary>
				<p>
					<?php
					echo $hub_article['subheadline'];
					if (empty($hub_article['subheadline']) ) {
						echo $hub_article['excerpt'];
						}
					?>
				</p>
				</summary>
			</div>
		</div>
	</div>
</article>
<?php } } ?>