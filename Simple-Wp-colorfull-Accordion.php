<?php 

/*

Plugin Name: Simple Wp colorfull Accordion
Author: Nayon
Author uri: http://www.nayonbd.con
Description: Super easy way to create accordion on your website you will love this plugin
Version: 1.0 

*/


class Swca_main_class{

	public function __construct(){

		add_action('init',array($this,'Swca_main_accordian_area'));
		add_action('wp_enqueue_scripts',array($this,'Swca_accordian_script_area'));

		add_shortcode('accordion',array($this,'Swca_accordian_shortcode_area'));

	}


	public function Swca_main_accordian_area(){

		load_plugin_textdomain('Swca_accordion_textdomain', false, dirname( __FILE__).'/lang');

		register_post_type('accordian',array(
			'labels'=>array(
				'name'=>'Accordion'
			),
			'public'=>true,
			'supports'=>array('title','editor','thumbnail'),
			'menu_icon'=>'dashicons-filter'
		));

	}

	public function Swca_accordian_script_area(){

		wp_enqueue_style('jquerycss',PLUGINS_URL('css/themearea.css',__FILE__));

		wp_enqueue_script( 'jquery-ui-core',array('jquery') );
		wp_enqueue_script('jquery-ui-accordion',array('jquery'));
		wp_enqueue_script('jqueryjsss',PLUGINS_URL('js/customarea.js',__FILE__),array('jquery'));
	}

	function Swca_accordian_shortcode_area($attr,$content){
		ob_start();
		extract(shortcode_atts(array(
				'title'=>'accordion'
			),$attr));
			?>
			

			<div class="accorduan_main_area"> 
				<div class="accordion-title"> 
					<h2><?php echo $title; ?></h2>
				</div>
				<div class="accordion"> 
				<?php $accordian = new wp_Query(array(
					'post_type'=>'accordian',
					'posts_per_page'=>8
				)); ?>
				<?php while( $accordian->have_posts() ) : $accordian->the_post(); ?>
						<h3 class="accordian_area"><?php the_title(); ?></h3>
						<div><?php the_content(); ?></div>
				<?php endwhile; ?>
				</div>
			</div>
			<?php
			return ob_get_clean();
			}

}
new Swca_main_class();




