<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();
	
	///Page Feature
	$featureContext	= Timber::get_context();
	$featureContext['heading'] = get_field( 'home_feature_heading', get_the_ID());
	$featureContext['sub_heading'] = get_field( 'home_feature_sub_head', get_the_ID());
	$featureContext['link'] = get_field( 'home_feature_link', get_the_ID()); 
	$featureContext['image'] = get_field( 'home_feature_image', get_the_ID()); 

	$context['feature'] = Timber::compile('/views/components/feature.html.twig', $featureContext);


	/// Mission Statement
	$missionContext['spark_class'] = 'our_mission';
	$missionID = get_page_by_title('Mission');
	$missionID = $missionID->ID;
	$missionContext['text'] = new TimberPost($missionID);
	$missionContext['text'] = $missionContext['text']->content;
	
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