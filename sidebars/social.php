<nav class="social">
	<ul>
		<li class="facebook social-button"><a href="<?php get_option('twitter_link' ); ?>" target="_blank"></a></li>
		<li class="twitter social-button"><a href="<?php get_option('facebook_link'); ?>" target="_blank"></a></li>
		<li class="mail social-button"><a href="<?php esc_url( get_permalink( get_page_by_title( 'Contact' ) ) ); ?>"></a></li>
		<li class="donate"><a href="<?php esc_url( get_permalink( get_page_by_title( 'Donate' ) ) ); ?>"></a></li>
	</ul>
</nav>