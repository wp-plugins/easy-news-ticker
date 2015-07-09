(function($){
	tinymce.PluginManager.add('ent_mce_button',function(editor, url){
		editor.addButton( 'ent_mce_button', {
			title: 'Easy News Ticker',
			image: url+'/news_ticker_btn.png',
			onclick: function() {
				    editor.windowManager.open( {
				        
				        body: [{
				            type: 'textbox',
				            name: 'category_name',
				            label: ent_options.ent_category_name_label
				        },
				        {
				            type: 'listbox', 
				            name: 'post_type', 
				            label: ent_options.ent_post_type_label, 
				            'values': [
				                {text: ent_options.ent_post, value: 'post'},
				                {text: ent_options.ent_page, value: 'page'}
				            ]
				        },
				        {
				            type: 'listbox', 
				            name: 'order', 
				            label: ent_options.ent_order_label, 
				            'values': [
				                {text: ent_options.ent_desc, value: 'DESC'},
				                {text: ent_options.ent_asc, value: 'ASC'}
				            ]
				        },

				        {
				            type: 'listbox', 
				            name: 'orderby', 
				            label: ent_options.ent_orderby_label, 
				            'values': [
				            	{text: ent_options.ent_date, value: 'date'},
				                {text: ent_options.ent_none, value: 'none'},
				                {text: ent_options.ent_id, value: 'ID'},
				                {text: ent_options.ent_author, value: 'author'},
				                {text: ent_options.ent_title, value: 'title'},
				                {text: ent_options.ent_name, value: 'name'},
				                {text: ent_options.ent_type, value: 'type'},
				         		{text: ent_options.ent_modified, value: 'modified'},
				                {text: ent_options.ent_parent, value: 'parent'},
				                {text: ent_options.ent_rand, value: 'rand'},
				                {text: ent_options.ent_comment_count, value: 'comment_count'}
				            ]
				        },
				        {
				            type: 'textbox',
				            name: 'posts_per_page',
				            label: ent_options.ent_posts_per_page_label
				        },

				         {
				            type: 'listbox', 
				            name: 'show_excerpt', 
				            label: ent_options.ent_show_excerpt_label, 
				            'values': [
				                {text: ent_options.ent_false, value: 'false'},
				                {text: ent_options.ent_true, value: 'true'}
				            ]
				        },
				       ],
				        onsubmit: function( e ) {

				        	var ent_contents = '[easy_news_ticker ';

				        	if(e.data.post_type !='page'){
				        		if(e.data.category_name != ''){
					        		ent_contents += 'category_name ='+ e.data.category_name; 
					        	} 
				        	}

				        	
				            						
    						ent_contents += ' post_type =' + e.data.post_type 
    						ent_contents += ' order =' + e.data.order 
    						ent_contents += ' orderby ='+ e.data.orderby;

    						if(!isNaN(e.data.posts_per_page) && e.data.posts_per_page !=''){
    							ent_contents += ' posts_per_page ='+ e.data.posts_per_page;
    						}
    						ent_contents += ' show_excerpt ='+ e.data.show_excerpt;
    						ent_contents += ']';
				            editor.insertContent(ent_contents);
				        }
				    });
				}
		});
	});
})(jQuery);