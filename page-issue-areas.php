<?php
	get_header();

	//Get Timber Context. Provides Data to TWIG views
	$context 		= Timber::get_context();

	/// Issue Areas
	$issueContextArgs 				= 	array( 
										'showposts'			=> '3',
										'category_name'		=> 'issue-areas'
									);
	$issueContext['feed'] 			= 	Timber::get_posts($issueContextArgs);
	Theme_Theme::processPosts($issueContext['feed']); 
	$issuescontext['spark_class'] 	= 'issues';
 	$context['issue_areas'] 		= Timber::compile('/views/components/tabbed_feed.html.twig', $issueContext);	
	

	/// Papers & Factsheets
	$papersContext['feed'] 			= 	get_field('papers_factsheets');
	$paperscontext['spark_class'] 	= 'papers-factsheets';
 	$context['papers_factsheets'] 	= Timber::compile('/views/components/file_feed.html.twig', $papersContext);


	//Display Page using news template 
	Timber::render('/views/pages/issue-areas.html.twig', $context);

	get_footer();
?>