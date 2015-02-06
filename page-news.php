<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();

 	/// Featured News and Updates 
	$newsContext['spark_class'] = 	'featured-news';
	$newsContext['header'] 		= 	'News & Updates';

	/// Category List
	$catContext['categories']	=	Timber::get_terms('category');
	$newsContext['categories'] 	= 	Timber::compile('/views/components/category_selector.html.twig', $catContext);
	
	/// Featured Post
	$featureContextArgs 		= 	array( 
									'showposts'		=> '1',
									'category_name'	=> 'news-feature'
								);
	$featureContext['feed'] 	= 	Timber::get_posts($featureContextArgs);
	Theme_Theme::processPosts($featureContext['feed']);

	$featureContext['slide_template'] = '/views/content/featured_news_slide.html.twig';
 	$context['feature'] 		= Timber::compile('/views/components/static_feed.html.twig', $featureContext);


 	/// News Feed
	$newsContextArgs 			= 	array( 
									'showposts'			=> '3'
									// ,'category__not_in'	=> ''//TODO: Add News Feature and In the Media ids
								);
	$newsContext['feed'] 		= 	Timber::get_posts($newsContextArgs);
	Theme_Theme::processPosts($newsContext['feed']);

	$newsContext['slide_template'] = '/views/content/news_post.html.twig';
 	$context['feature'] 		= Timber::compile('/views/components/static_feed.html.twig', $newsContext);


 	/// In the Media Feed
	$mediaContextArgs 			= 	array( 
									'showposts'			=> '3',
									'category_name'		=> 'in-the-media'
								);
	$mediaContext['feed'] 		= 	Timber::get_posts($mediaContextArgs);
	Theme_Theme::processPosts($mediaContext['feed']);	

	$mediaContext['slide_template'] = '/views/content/news_post.html.twig';
 	$context['feed'] 		= Timber::compile('/views/components/static_feed.html.twig', $mediaContext);


 	/// Malika Blog
	$malikaContextArgs 			= 	array( 
									'showposts'			=> '1',
									'category_name'		=> 'malikas-blog'
								);
	$malikaContext['feed'] 		= 	Timber::get_posts($malikaContextArgs);
	Theme_Theme::processPosts($malikaContext['feed']);

	$malikaContext['slide_template'] = '/views/content/malika_slide.html.twig';
 	$context['malika'] = Timber::compile('/views/components/static_feed.html.twig', $malikaContext);
	

	//Display Page using news template 
	Timber::render('/views/pages/news.html.twig', $context);

	get_footer();
?>