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

	/// Papers & Factsheets
	$papersContext['feed'] 			= 	get_field('image_feed');
	$paperscontext['spark_class'] 	= 'letters-briefs-petitions';
 	$context['papers_factsheets'] 	= Timber::compile('/views/components/thumbnail_carousel_gallery.html.twig', $papersContext);


 	/// Events
	$accomplishmentsContext['spark_class'] = 'accomplishments';
	$accomplishmentsContext['header'] = 'Accomplishments';
	$accomplishmentsContextArgs = 	array( 
							'showposts'		=> '5',
							'category_name'	=> 'accomplishments'
						);
	$accomplishmentsContext['feed'] = Timber::get_posts($accomplishmentsContextArgs);
	Theme_Theme::processPosts($accomplishmentsContext['feed']);
	
	$accomplishmentsContext['slide_template'] = '/views/content/news_slide.html.twig';
 	$context['events'] = Timber::compile('/views/components/static_feed.html.twig', $accomplishmentsContext);




	//Display Page using home template 
	Timber::render('/views/pages/action.html.twig', $context);

	get_footer();
?>