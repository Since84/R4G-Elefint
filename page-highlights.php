<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();
	
	///Page Feature
	$featureContext	= Timber::get_context();
	$featureContext['heading'] 		= get_field( 'feature_heading', get_the_ID());
	$featureContext['text'] 		= get_field( 'feature_text', get_the_ID());
	$featureContext['link'] 		= get_field( 'feature_link', get_the_ID()); 
	$featureContext['link_text'] 	= get_field( 'feature_link_text', get_the_ID()); 
	$featureContext['link_label'] 	= get_field( 'feature_link_label', get_the_ID()); 
	$featureContext['image'] 		= get_field( 'feature_image', get_the_ID()); 

	$context['feature'] = Timber::compile('/views/components/feature.html.twig', $featureContext);

	/// Papers & Factsheets
	$papersContext['feed'] 			= 	get_field('image_feed');
	$paperscontext['spark_class'] 	= 'letters-briefs-petitions';
 	$context['papers_factsheets'] 	= Timber::compile('/views/components/thumbnail_carousel_gallery.html.twig', $papersContext);


 	/// Accomplishments
 	$accomplishmentsContext['feed'] 			= 	get_field('accomplishments');
	$accomplishmentsContext['spark_class'] 		= 'accomplishments';
	$accomplishmentsContext['slide_template'] 	= '/views/content/news_slide.html.twig';
 	$context['accomplishments'] 				= Timber::compile('/views/components/thumbnail_carousel_gallery.html.twig', $accomplishmentsContext);

	//Display Page using home template 
	Timber::render('/views/pages/action.html.twig', $context);

	get_footer();
?>