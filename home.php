<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context = Timber::get_context();

	//Get Site Header : uses SparkHeader Class
	$sparkHeader = new Header_Header(array(
	  'showLogo'      =>  true
	  ,'headerRight'  =>  'sidebars/social.php' //Template for right side ( /views/components/... )
	  ,'nav'          =>  'main-nav' //Menu name for nav menu
	  ,'template'     =>  'header' //Name of header template
	  ,'isJs'         =>  false
	));	
	$context['header'] = $sparkHeader::getView();

	$context = Timber::get_context();
	$context['content'] = get_page_by_title( 'home' );


	//Display Page using home template 
	Timber::render('/views/pages/home.html.twig', $context);

	get_footer();
?>