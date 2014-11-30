<?php

add_shortcode('easy_news_ticker', 'easy_news_ticker_function');

function easy_news_ticker_function($atts){
		$atts = shortcode_atts(array(
			'category_name'			=> '',
			'post_type'				=> 'post',
			'order'					=> 'DESC',
			'orderby'				=> 'date',
			'posts_per_page'		=> '',
			'show_excerpt'			=> 'false'


			),$atts);

			extract($atts);
			$ent_query_args = array(
							'category_name'			=> $category_name,
							'post_type'				=> $post_type,
							'order'					=> $order,
							'orderby'				=> $orderby,
							'posts_per_page'		=> $posts_per_page,
							'show_excerpt' 			=> $show_excerpt,
							'ignore_sticky_posts'	=> false,
							);
		
		$ent_query = new WP_Query( $ent_query_args );
			$ent_html = '';
		if($ent_query->have_posts()): 
			$ent_html .= '<div class="ent_ticker"><ul>';
			while($ent_query->have_posts()):$ent_query->the_post();
			$ent_html .= '<li id="post'.get_the_id().'">';
			$ent_html .= '<a href="';
			$ent_html .=  get_permalink();
			$ent_html .=  '">';
			$ent_html .=  '<h4>'.get_the_title().'</h4>';

			$ent_html .=  '</a>';
			if($show_excerpt=='true'){
				$ent_html .=  get_the_excerpt();
			}
			$ent_html .= '</li>';
		endwhile;
		$ent_html .= '</ul></div>'; 
		endif;

		wp_reset_query();
		


	return $ent_html;
}
