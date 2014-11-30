<?php
/**
 * Plugin Name: Easy News Ticker
 * Plugin URI: http://ontorok.com/easy_news_ticker
 * Description: Easy news ticker is a tiny news ticker plugin that scroll the list infinitely vertically. 
 * Version: 1.0.0
 * Author: shishir
 * Author URI: http://ontorok.com
 * Text Domain: ent
 * License: GPL2
 */

/*

    Copyright (C) 2014  ifte  ifte.hsn2013@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


require_once(plugin_dir_path( __FILE__ )."inc/ent_shortcode_init.php");
require_once(plugin_dir_path( __FILE__ )."inc/ent_widget.php");


add_action( 'admin_init', 'ent_admin_init' );
function ent_admin_init() {
    /* Register our script. */
    wp_register_script( 'mce_add_button', plugin_dir_url(__FILE__).'js/easy-ticker-mce-button.js' );
    
    wp_localize_script( 'mce_add_button', 'ent_options', array(

		'ent_category_name_label' 	=> __('Category Name','ent'),
		'ent_post_type_label' 		=> __('Post Type','ent'),
		'ent_order_label' 			=> __('Order','ent'),
		'ent_orderby_label' 		=> __('Order By','ent'),
		'ignore_sticky_posts_label'	=> __('Ignore Post Type','ent'),
		'ent_posts_per_page_label'	=> __('Post Per Page','ent'),
		'ent_show_excerpt_label'	=> __('Show Post Excerpt','ent'),
		'ent_post'					=> __('Post','ent'),
		'ent_page'					=> __('Page','ent'),
		'ent_desc'					=> __('DESC','ent'),
		'ent_asc'					=> __('ASC','ent'),
		'ent_none'					=> __('None','ent'),
		'ent_id'					=> __('ID','ent'),
		'ent_author'				=> __('Author','ent'),
		'ent_title'					=> __('Title','ent'),
		'ent_name'					=> __('Name','ent'),
		'ent_type'					=> __('Type','ent'),
		'ent_date'					=> __('Date','ent'),
		'ent_modified'				=> __('Modified','ent'),
		'ent_parent'				=> __('Parent','ent'),
		'ent_rand'					=> __('Random','ent'),
		'ent_comment_count'			=> __('Comment Count','ent'),
		'ent_true'					=> __('True','ent'),
		'ent_false'					=> __('False','ent'),




		'ent_category_name' 		=> '',
		'ent_post_type'				=> 'post',
		'ent_order'					=> '',
		'ent_orderby'				=> '',
		'ent_ignore_sticky_posts'	=> 'false',
		'ent_tag'					=> '',
		'ent_posts_per_page'		=> ''
	));


    wp_enqueue_script('mce_add_button');
}


function ok_easy_news_ticker() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'easy-news-ticker', plugin_dir_url(__FILE__).'js/jquery.easy-ticker.min.js', array( 'jquery' ),'2.0');
	wp_enqueue_script( 'easy-ticker-init', plugin_dir_url(__FILE__).'js/ticker_init.js', array( 'easy-news-ticker' ),'2.0');
	wp_enqueue_style( 'easy-ticker-style', plugin_dir_url(__FILE__).'css/ticker_style.css');
}

add_action( 'wp_enqueue_scripts', 'ok_easy_news_ticker' );



//MCE Button
add_action('admin_head', 'ent_add_my_mce_button');

function ent_add_my_mce_button(){
	global $typenow;

	//check user permission
	if(!current_user_can('edit_posts') && !current_user_can('edit_pages')){
		return;
	}

	//check if WYSUWYG is enabled
	if(get_user_option('rich_editing') == 'true'){
		add_filter('mce_external_plugins', 'ent_add_tinymce_plugin');
		add_filter('mce_buttons', 'ent_register_my_mce_button');
	}
}


function ent_add_tinymce_plugin($plugin_array){
	$plugin_array['ent_mce_button'] = plugins_url('js/easy-ticker-mce-button.js', __FILE__);
	return $plugin_array;
}
function ent_register_my_mce_button($buttons){
	array_push($buttons, 'ent_mce_button');
	return $buttons;
}





?>