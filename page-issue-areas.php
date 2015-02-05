<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();

	//Get Site Header : uses SparkHeader Class
	$sparkHeader 	= new Header_Header(array(
	  'showLogo'      =>  true
	  ,'headerRight'  =>  'sidebars/social.php' //Template for right side ( /views/components/... )
	  ,'nav'          =>  'main-nav' //Menu name for nav menu
	  ,'template'     =>  'header' //Name of header template
	  ,'isJs'         =>  false
	));	
	$context['header'] 	= $sparkHeader::getView();

	/// Issue Areas
	$issueContextArgs 				= 	array( 
										'showposts'			=> '3',
										'category_name'		=> 'issue-areas'
									);
	$issueContext['feed'] 			= 	Timber::get_posts($issueContextArgs);
	Theme_Theme::processPosts($mediaContext['feed']);
	$issuescontext['spark_class'] 	= 'issues';
 	$context['issue_areas'] 		= Timber::compile('/views/components/tabbed_feed.html.twig', $issuesContext);	
	

	/// Papers & Factsheets
	$papersContext['feed'] 			= 	get_field('papers_factsheets');
	$paperscontext['spark_class'] 	= 'papers-factsheets';
 	$context['papers_factsheets'] 	= Timber::compile('/views/components/file_feed.html.twig', $papersContext);


	//Display Page using news template 
	Timber::render('/views/pages/issue-areas.html.twig', $context);

	get_footer();
?>