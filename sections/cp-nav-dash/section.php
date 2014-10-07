<?php
/*
Section: DMS Nav Dash
Author: TourKick (Clifford P)
Description: Assign a WordPress menu and it'll automatically create the correct number of columns to display top-level and one child-level link lists.
Class Name: DMSNavDash
Version: 1.0
Cloning: true
v3: true
Filter: nav, dual-width
*/


class DMSNavDash extends PageLinesSection {

	function navdash_color_presets() {
    	$colorpresets = array( // ALL HEX's LOWER-CASE
			pl_hashify(pl_setting('bodybg'))	=> array('name' => __('PL Background Base Setting', 'navdash') ),
			pl_hashify(pl_setting('text_primary'))	=> array('name' => __('PL Text Base Setting', 'navdash') ),
			pl_hashify(pl_setting('linkcolor'))	=> array('name' => __('PL Link Base Setting', 'navdash') ),
			'#fbfbfb'	=> array('name' => __('Light Gray', 'navdash') ),
			'#bfbfbf'	=> array('name' => __('Medium Gray', 'navdash') ),
			'#1abc9c'	=> array('name' => __('* Turquoise', 'navdash') ),
			'#16a085'	=> array('name' => __('* Green Sea', 'navdash') ),
			'#40d47e'	=> array('name' => __('* Emerald', 'navdash') ),
			'#27ae60'	=> array('name' => __('* Nephritis', 'navdash') ),
			'#3498db'	=> array('name' => __('* Peter River', 'navdash') ),
			'#2980b9'	=> array('name' => __('* Belize Hole', 'navdash') ),
			'#9b59b6'	=> array('name' => __('* Amethyst', 'navdash') ),
			'#8e44ad'	=> array('name' => __('* Wisteria', 'navdash') ),
			'#34495e'	=> array('name' => __('* Wet Asphalt', 'navdash') ),
			'#2c3e50'	=> array('name' => __('* Midnight Blue', 'navdash') ),
			'#f1c40f'	=> array('name' => __('* Sun Flower', 'navdash') ),
			'#f39c12'	=> array('name' => __('* Orange', 'navdash') ),
			'#e67e22'	=> array('name' => __('* Carrot', 'navdash') ),
			'#d35400'	=> array('name' => __('* Pumpkin', 'navdash') ),
			'#e74c3c'	=> array('name' => __('* Alizarin', 'navdash') ),
			'#c0392b'	=> array('name' => __('* Pomegranate', 'navdash') ),
			'#ecf0f1'	=> array('name' => __('* Clouds', 'navdash') ),
			'#bdc3c7'	=> array('name' => __('* Silver', 'navdash') ),
			'#95a5a6'	=> array('name' => __('* Concrete', 'navdash') ),
			'#7f8c8d'	=> array('name' => __('* Asbestos', 'navdash') ),
			'#791869'	=> array('name' => __('Plum', 'navdash') ),
			'#c23b3d'	=> array('name' => __('Red', 'navdash') ),
			'#0c5cea'	=> array('name' => __('Blue', 'navdash') ),
			'#00aff0'	=> array('name' => __('Light Blue', 'navdash') ),
			'#88b500'	=> array('name' => __('Lime', 'navdash') ),
			'#cf3f20'	=> array('name' => __('Orangey', 'navdash') ),
			'#f27a00'	=> array('name' => __('Yellowy-Orange', 'navdash') ),
		);

		return $colorpresets;
	}


	function section_scripts(){
		wp_enqueue_script('jquery');
	}

	function section_head(){
		$sectionid = '#cp-nav-dash' . $this->get_the_id();

       	if( $this->opt('navdash_color_top_level_border_picker') ) {
			$toplevelbordercolor = $this->opt('navdash_color_top_level_border_picker');
		} elseif( $this->opt('navdash_color_top_level_border') ) {
			$toplevelbordercolor = $this->opt('navdash_color_top_level_border');
		} else {
			$toplevelbordercolor = pl_setting('linkcolor');
		}
		$toplevelbordercolor = pl_hashify($toplevelbordercolor);


		if(!$this->opt('navdash_top_level_border_off')) {
		?>

        <style type="text/css">
			<?php echo $sectionid; ?> .nav-dash-top-level-item {
				border-left: <?php echo $toplevelbordercolor; ?> solid 2px;
			}
		</style>
		<?php } ?>

		<script type="text/javascript">
			jQuery(window).resize(function(){
				if( window.matchMedia('(max-width: 480px)').matches ) {
					jQuery('<?php echo $sectionid; ?> .nav-dash-toggler').show();
					jQuery('<?php echo $sectionid; ?> .sub-menu.in.collapse').removeClass('in');
				} else {
					jQuery('<?php echo $sectionid; ?> .nav-dash-toggler').hide();
					jQuery('<?php echo $sectionid; ?> .sub-menu.collapse').addClass('in');
				}
			});
		</script>
		<?php
		// http://www.paulund.co.uk/checking-media-queries-javascript

	}


	function section_opts(){

		$opts = array(
			array(
				'type'	=> 'multi',
				'key'	=> 'navdash_nav',
				'title'	=> 'Navigation',
				'col'	=> 1,
				'opts'	=> array(
					array(
						'key'	=> 'navdash_menu',
						'type'	=> 'select_menu',
						'label'	=> __( 'Select Menu', 'navdash' ),
						'help'	=> __( 'Nav Dash works with WordPress menus and can display top-level/parents and 2nd-level/children menu items.<br><strong>3rd-level/grandchildren and below will not appear.</strong><br>Nav Dash will automatically put your menu items into columns, but <strong>ONLY IF your menu has 12 or fewer top-level menu items.</strong><br>If you do not (e.g. 13 top-level menu items), your menu will not appear in columns.', 'navdash' ),
					),
					array(
						'key'	=> 'navdash_color_top_level_border',
						'type' 	=> 'select',
						'label'	=> __('Top Level Item Border Color<br>Default: <span class="pl-link">PL Link Base Setting</span><br>Color picker drop-down options beginning with an <strong>asterisk (*)</strong> are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>', 'navdash'),
						'opts' => $this->navdash_color_presets(),
					),
		            array(
		                'key'		=> 'navdash_color_top_level_border_picker',
		                'type'		=> 'color',
		                'label'		=> __( 'Top Level Item Border Color', 'navdash' ),
		                'default'	=> '',
		                'help'		=> __( 'Color Picker overrides Drop-Down Selection, if both are entered for the same setting.', 'navdash' ),
		            ),
					array(
						'key'	=> 'navdash_top_level_border_off',
						'type'	=> 'check',
						'label'	=> __( 'Turn Off Top Level Border?', 'navdash' ),
					),
					array(
						'key'	=> 'navdash_hide_col_error',
						'type'	=> 'check',
						'label'	=> __( 'Hide Error Message about too many top-level items to create columns?<br>(only shown to Contributors and above)', 'navdash' ),
					),
				)
			)
		);

		return $opts;

	}

	function section_template() {

		$menu = $this->opt('navdash_menu') ? $this->opt('navdash_menu') : '';
		if(!$menu) {
			return '';
		}

		$hidecolerror = $this->opt('navdash_hide_col_error') ? true : false;

		$menu_args = array(
			'menu'			=> $menu,
			'menu_class'	=> 'navdash-menu',
			'echo'			=> false,
			'fallback_cb'	=> false,
			'before'		=> '<div class="nav-dash-item">',
			'after'			=> '</div>',
			'depth'			=> 2,
			'walker'		=> new DMSNavDash_Walker_Nav_Menu,
			'navdashobject'	=> $this,
		);

		$menuoutput = wp_nav_menu( $menu_args );

		$toplevelcount = substr_count($menuoutput, 'nav-dash-level-1');
		if (
		  $hidecolerror == false
		  && current_user_can('edit_posts')
		  && $toplevelcount > 12
		) {
			$errormessage = sprintf('[pl_alertbox type="error" closable="yes"]Your menu has <strong>%s</strong> top-level items, which is NOT the correct number to create columns.[/pl_alertbox]', $toplevelcount);
			echo do_shortcode($errormessage);
		}

		$output = sprintf('<nav role="navigation" class="nav-dash-wrap nav-dash-top-levels-%s">%s</nav>', $toplevelcount, $menuoutput);

		echo $output;

	}

}


class DMSNavDash_Walker_Nav_Menu extends Walker_Nav_Menu {
	// https://core.trac.wordpress.org/browser/trunk/src/wp-includes/nav-menu-template.php

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu in collapse\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_dash_nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_dash_nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_dash_nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'nav_dash_the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';

		//
		if( $depth == 0 && in_array('menu-item-has-children', $item->classes ) ) { // only top-level parents
			$item_output .= sprintf(' <i class="nav-dash-toggler fa fa-caret-down" data-toggle="collapse" data-target="#cp-nav-dash%s li.menu-item-%s ul.sub-menu"></i>', $args->navdashobject->get_the_id(), $item->ID);
		}
		//

		$item_output .= $args->after;

		$output .= apply_filters( 'nav_dash_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if(!isset($this->topitemcount)) {
			$this->topitemcount = 0;
		}

		if (empty($element->menu_item_parent) || $element->menu_item_parent == 0) {
			$this->topitemcount++;
			$element->title = sprintf('<span class="nav-dash-top-level-item">%s</span>', $element->title);
			$element->classes[] = 'nav-dash-level-1 accordion-group nav-dash-top-level-group-'.$this->topitemcount;
			//$element->attr_title = 'myattrtitle'.$element->attr_title;
		} else {
			$element->title = sprintf('<span class="nav-dash-child-level-item">%s</span>', $element->title);
			$element->classes[] = 'nav-dash-level-2';
		}

		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}