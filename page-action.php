<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();
	
	///Page Feature
	$featureContext	= Timber::get_context();
	$featureContext['heading'] = get_field( 'feature_heading', get_the_ID());
	$featureContext['text'] = get_field( 'feature_text', get_the_ID());
	$featureContext['link'] = get_field( 'feature_link', get_the_ID()); 
	$featureContext['link_text'] = get_field( 'feature_link_text', get_the_ID()); 
	$featureContext['link_label'] = get_field( 'feature_link_label', get_the_ID()); 
	$featureContext['image'] = get_field( 'feature_image', get_the_ID()); 

	$context['feature'] = Timber::compile('/views/components/feature.html.twig', $featureContext);

 	/// Events
	$eventsContext['spark_class'] = 'featured-news';
	$eventsContext['header'] = 'Featured News & Updates';
	$eventsContextArgs = 	array( 
							'showposts'		=> '3',
							'post_type'	=> 'page'
						);
	$eventsContext['feed'] = Timber::get_posts($eventsContextArgs);
	Theme_Theme::processPosts($eventsContext['feed']);
	
	$eventsContext['slide_template'] = '/views/content/event_slide.html.twig';
 	$context['events'] = Timber::compile('/views/components/static_feed.html.twig', $eventsContext);


	/// Papers & Factsheets
	$papersContext['feed'] 			= 	get_field('download_files');
	$paperscontext['spark_class'] 	= 'letters-briefs-petitions';
 	$context['papers_factsheets'] 	= Timber::compile('/views/components/file_feed.html.twig', $papersContext);


	//Display Page using home template 
	Timber::render('/views/pages/action.html.twig', $context);

	get_footer();
?>