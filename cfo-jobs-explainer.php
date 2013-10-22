<?php

/*
Plugin Name: CFO JOBS Act Explainer
Plugin URI: http://aramzs.me
Description: This plugin contains bonus files to get the CFO JOBS Explainer to work. 
Version: 0.5
Author: Aram Zucker-Scharff
Author URI: http://aramzs.me
License: GPL2
*/

/*  Copyright 2012  Aram Zucker-Scharff  (email : azuckers@gmu.edu)

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

function je_styles_scripts() {
	global $wp_query;
	
	$match = get_option("cfo_je_setting"); 
	#var_dump($match); die();
	if (is_singular()){
		
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post_id = get_the_ID();
			if (($post_id == (int)$match) ){
			
			wp_enqueue_script('jquery');
			wp_enqueue_style('je-style-single', plugins_url('style.css', __FILE__));
			wp_enqueue_script('je-functions-prime', plugins_url('je-functions.js', __FILE__), array('jquery'), '1', true);
			wp_enqueue_script('je-reveal', plugins_url('lib/reveal/jquery.reveal.js', __FILE__), array('jquery'), '1', true);
			wp_enqueue_style('je-style-reveal', plugins_url('lib/reveal/reveal.css', __FILE__));
			}
			endwhile;
		endif;
	}

}

add_action('wp_head', 'je_styles_scripts');

function add_to_settings(){
	register_setting( 'writing', 'je_setting_section', 'cfo_je_options_validator' );
	add_settings_section('je_setting_section', 'Jobs Explainer', 'je_setting_section_callback', 'writing');
	add_settings_field('cfo_je_setting','Set JOBS Explainer ID','je_callback', 'writing', 'je_setting_section');
}

add_action("admin_init", "add_to_settings"); 

function je_setting_section_callback(){
	
}

function je_callback(){
	$je_id = get_option('cfo_je_setting');
	#var_dump($je_id);
	?>  
		<div class="wrap">  
			<form action="options.php" method="post">  
				<table class="form-table">  
					<tr valign="top">  
						<td>  
							<input type="text" name="cfo_je_setting" value="<?php echo $je_id; ?>" size="25" />  
						</td>  
					</tr>  
				</table> 
				<input type="hidden" name="update_settings" value="Y" />  				
			</form>  
		</div>  
	<?php
		if (isset($_POST["update_settings"])) {  
			// Do the saving  
			$je_id = esc_attr($_POST["cfo_je_setting"]); 
			#var_dump($je_id); die();
			update_option("cfo_je_setting", $je_id);  			
		}  	

}

function cfo_je_options_validator($input){
		#var_dump($_POST); die();
		if (isset($_POST["update_settings"])) {  
			// Do the saving  
			$je_id = esc_attr($_POST["cfo_je_setting"]); 
			#var_dump($input); die();
			update_option("cfo_je_setting", $je_id);  			
		} 	
}