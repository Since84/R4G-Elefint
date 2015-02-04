<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 	= Timber::get_context();

	//Get Site Header : uses SparkHeader Class
	$sparkHeader = new Header_Header(array(
	  'showLogo'      =>  true
	  ,'headerRight'  =>  'sidebars/social.php' //Template for right side ( /views/components/... )
	  ,'nav'          =>  'main-nav' //Menu name for nav menu
	  ,'template'     =>  'header' //Name of header template
	  ,'isJs'         =>  false
	));	
	$context['header'] 	= $sparkHeader::getView();
	
	///Page Feature
	$featureContext	= Timber::get_context();
	$featureContext['heading'] = get_post_meta( get_the_ID(), 'feature_heading', true );
	$featureContext['sub_heading'] = get_post_meta( get_the_ID(), 'feature_sub_heading', true );
	$featureContext['link'] = get_post_meta( get_the_ID(), 'feature_link', true ); 
	$featureContext['image'] = get_the_post_thumbnail( get_the_ID(), 'full' );
	$context['feature'] = Timber::compile('/views/components/feature.html.twig', $featureContext);

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