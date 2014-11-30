<?php


class Ent_Widget extends WP_Widget {

	//widget init
	public function __construct(){
		parent::__construct(
			'ent-news-ticker-widget', //id of the widget
			__('Easy News Ticker','ent'), //Widget Name
			array('description'=>__('Easy news ticker widget','ent'))

			);
	}

	//Output the widget options in the backend
	public function form($instance){
		$ent_defaults = array(
			'title' 			=> __('Recent News','ent'),
			'category_name' 	=> '',
			'post_type' 		=> 'post',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'posts_per_page'	=> '',
			'show_excerpt'		=> 'false',
			);

		$instance = wp_parse_args((array) $instance, $ent_defaults );

		?>

		<!-- the title -->
		<p>	
			<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title','ent'); ?> </label>
			<input type="text" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" >
		</p>

		<!-- the category name -->
		<p>
			<label for="<?php echo $this->get_field_id('category_name') ?>"><?php _e('Category Name','ent'); ?> </label>
			<input type="text" id="<?php echo $this->get_field_id('category_name') ?>" name="<?php echo $this->get_field_name('category_name') ?>" class="widefat" value="<?php echo esc_attr($instance['category_name']); ?>" >
			<small>Use ',' to sepatate multiple categories</small>
		</p>

		<!-- the post type -->
		<p>
			<label for="<?php echo $this->get_field_id('post_type') ?>"><?php _e('Post Type','ent'); ?> </label>
			
			<select class="widefat" name="<?php echo $this->get_field_name('post_type') ?>" id="<?php echo $this->get_field_id('post_type') ?>">
				<?php 
					$post_type_options = array('post','page');

					foreach ($post_type_options as $post_type_option) { ?>
						<option value="<?php echo $post_type_option ?>" <?php 

							if($post_type_option == $instance['post_type']){
								echo 'selected="selected"';
							}
						 ?>><?php echo ucfirst($post_type_option); ?></option>
					<?php }
				 ?>
			</select>
			
		</p>

		<!-- the order -->
		<p>
			<label for="<?php echo $this->get_field_id('order') ?>"><?php _e('Order','ent'); ?> </label>
			
			<select class="widefat" name="<?php echo $this->get_field_name('order') ?>" id="<?php echo $this->get_field_id('order') ?>">
				<?php 
					$post_order_options = array('DESC','ASC');

					foreach ($post_order_options as $post_order_option) { ?>
						<option value="<?php echo $post_order_option ?>" <?php 

							if($post_order_option == $instance['order']){
								echo 'selected="selected"';
							}
						 ?>><?php echo ucfirst($post_order_option); ?></option>
					<?php }
				 ?>
			</select>

			
		</p>

		<!-- the orderby -->
		<p>
			<label for="<?php echo $this->get_field_id('orderby') ?>"><?php _e('Order By','ent'); ?> </label>
			
			<select class="widefat" name="<?php echo $this->get_field_name('orderby') ?>" id="<?php echo $this->get_field_id('orderby') ?>">
				<?php 
					$post_orderby_options = array( 
											'date',
											'none',
											'ID',
											'author',
											'title',
											'name',
											'type',
											'modified',
											'parent',
											'rand',
											'comment_count'
											);

					foreach ($post_orderby_options as $post_orderby_option) { ?>
						<option value="<?php echo $post_orderby_option ?>" <?php 

							if($post_orderby_option == $instance['orderby']){
								echo 'selected="selected"';
							}
						 ?>><?php echo ucfirst($post_orderby_option); ?></option>
					<?php }
				 ?>
			</select>

			
		</p>


		<!-- the post per page -->
		<p>
			<label for="<?php echo $this->get_field_id('posts_per_page') ?>"><?php _e('Posts per page','ent'); ?> </label>
			

			<select class="widefat" name="<?php echo $this->get_field_name('posts_per_page') ?>" id="<?php echo $this->get_field_id('posts_per_page') ?>">
				<?php 
					$posts_per_page_options = array('10','15','20','25','30', 'No Limit');

					foreach ($posts_per_page_options as $posts_per_page_option) { ?>
						<option value="<?php 

							if($posts_per_page_option == 'No Limit'){
								echo '-1';
							}else{
								echo $posts_per_page_option ;
							}
								
							?>" <?php 

							if($posts_per_page_option == $instance['posts_per_page']){
								echo 'selected="selected"';
							}
						 ?>><?php echo ucfirst($posts_per_page_option); ?></option>
					<?php }
				 ?>
			</select>
		</p>




		<!-- Show Excerpt -->
		<p>
			<label for="<?php echo $this->get_field_id('show_excerpt') ?>"><?php _e('Show Excerpt','ent'); ?> </label>
			
			<select class="widefat" name="<?php echo $this->get_field_name('show_excerpt') ?>" id="<?php echo $this->get_field_id('show_excerpt') ?>">
				<?php 
					$post_show_excerpt_options = array( 
											'true',
											'false');

					foreach ($post_show_excerpt_options as $post_show_excerpt_option) { ?>
						<option value="<?php echo $post_show_excerpt_option ?>" <?php 

							if($post_show_excerpt_option == $instance['show_excerpt']){
								echo 'selected="selected"';
							}
						 ?>><?php echo ucfirst($post_show_excerpt_option); ?></option>
					<?php }
				 ?>
			</select>

			
		</p>

		<?php
	}

	//Process the widget options for saving
	public function update($new_instance,$old_instance){
		$instance = $old_instance;

		//Title
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category_name'] = strip_tags($new_instance['category_name']);
		$instance['post_type'] = $new_instance['post_type'];
		$instance['order'] =$new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['posts_per_page'] = strip_tags($new_instance['posts_per_page']);
		$instance['show_excerpt'] = $new_instance['show_excerpt'];

		return $instance;

	}

	//Displays the widgets on the page
	public function widget($args, $instance){
		extract($args);

		$title = apply_filters('widget-title', $instance['title'] );
		$category_name = $instance['category_name'];
		$post_type = $instance['post_type'];
		$order = $instance['order'];
		$orderby = $instance['orderby'];
		$posts_per_page = $instance['posts_per_page'];
		$show_excerpt = $instance['show_excerpt'];

		echo $before_widget;
		if($title){
			echo $before_title . $title . $after_title;
		}


		$ent_widget_query_args = array(
							'category_name'			=> $category_name,
							'post_type'				=> $post_type,
							'order'					=> $order,
							'orderby'				=> $orderby,
							'posts_per_page'		=> $posts_per_page,
							'ignore_sticky_posts'	=> false,
							);
		
		$ent_query = new WP_Query( $ent_widget_query_args );

		if($ent_query->have_posts()): 
			echo '<div class="ent_ticker"><ul>';

			while($ent_query->have_posts()):$ent_query->the_post();
				echo '<li id=post-';
				echo get_the_id(); 
				echo '"><a href="';
				echo  get_permalink();
				echo  '">';
				echo  '<h4>'.get_the_title().'</h4>';
				echo '</a>';

				if($show_excerpt == 'true'){
					echo get_the_excerpt();
				}
				
				
				echo'</li>';
			endwhile;
				echo '</ul></div>'; 
			endif;
			wp_reset_query();


		echo $after_widget;
	}

}

// register Foo_Widget widget
function register_ent_widget() {
    register_widget( 'Ent_Widget' );
}
add_action( 'widgets_init', 'register_ent_widget' );
?>