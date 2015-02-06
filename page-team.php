<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();


	///Me
	$missionContext['spark_class'] = 'featured-news';
	$missionContext['header'] = 'Featured News & Updates';
	$missionContextArgs = 	array( 
							'showposts'		=> '3',
							'post_type'		=> 'team'
						);
	$context['our_team'] = Timber::compile('/views/components/scrolling_tabs.html.twig', $missionContext);

	/// Mission Statement
	$missionContext['spark_class'] = 'our-mission';
	$missionContext['text'] = get_post_meta( get_the_ID(), 'mission_statement', true );
	
	$context['mission'] = Timber::compile('/views/components/text_block.html.twig', $missionContext);

	
	/// Why It Matters
	$mattersContext['spark_class'] = 'why-it-matters';
	$mattersContext['header'] = get_post_meta( get_the_ID(), 'wim_header', true );
	$mattersContext['feed'] = get_field('wim_content');
	$mattersContext['slide_template'] = '/views/content/wim_slide.html.twig';
 	
 	$context['wim'] = Timber::compile('/views/components/gallery.html.twig', $mattersContext); 


 	/// Call To Action
 	$callToActionContext['spark_class'] = "call-to-action";
 	$callToActionContext['menu'] = new TimberMenu('call to action');
 	
 	$context['call_to_action'] = Timber::compile('/views/content/call-to-action.html.twig', $callToActionContext);


 	/// Featured News and Updates 
	$newsContext['spark_class'] = 'featured-news';
	$newsContext['header'] = 'Featured News & Updates';
	$newsContextArgs = 	array( 
							'showposts'		=> '3',
							'category_name'	=> 'featured'
						);
	$newsContext['feed'] = Timber::get_posts($newsContextArgs);
	Theme_Theme::processPosts($newsContext['feed']);

	$newsContext['slide_template'] = '/views/content/featured_news_slide.html.twig';
 	$context['news'] = Timber::compile('/views/components/static_feed.html.twig', $newsContext);
	

	//Display Page using home template 
	Timber::render('/views/pages/home.html.twig', $context);

	get_footer();
?>