<?php
/*
Plugin Name:  Donate For A Good Cause
Plugin URI: http://www.zurazine.com/
Description: add a Donate For A Good Cause link at your sidebar
Version: 1.0.0
Author: Zurazine
Author URI: http://www.zurazine.com/
*/

function donate_for_a_good_cause_init() {
	if ( !function_exists( 'register_sidebar_widget' ) )
		return;

	function donate_for_a_good_cause( $args ) {
		extract( $args );

		$options = get_option( 'donate_for_a_good_cause' );
		$donate_for_a_good_cause_title = $options[ 'donate_for_a_good_cause_title' ];
		$donate_for_a_good_cause_icon_size = $options[ 'donate_for_a_good_cause_icon_size' ];
			if( !$donate_for_a_good_cause_icon_size ) $donate_for_a_good_cause_icon_size = '125px';
		$donate_for_a_good_cause_icon_position = $options[ 'donate_for_a_good_cause_icon_position' ];
			if( !$donate_for_a_good_cause_icon_position ) $donate_for_a_good_cause_icon_size = 'center';
		$donate_for_a_good_cause_use_background = (int)$options[ 'donate_for_a_good_cause_use_background' ];


		// section main logic from here 
		
		$my_dir ='/wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

		$donation_window = get_bloginfo( 'wpurl' ) . $my_dir . '/donation.html';
		$donation_popup = 'javascript:var d=document,w=window,u=\'' . $donation_window . '\';w.open(u,\'title\',\'toolbar=1,resizable=1,scrollbars=1,status=1,width=450,height=450\');void(0);';

		$img_url = get_bloginfo( 'wpurl' ) . $my_dir . '/images/donate-for-a-good-cause-libian-kids.png';
		$img_tag = '<img class="donate_for_a_good_cause_icon" src="' . $img_url . '" border="0" onclick="' . $donation_popup . '"/>';
		$img_style_use_background = ' padding: 10px 0px; background-color: white; ';
		$img_style='<style type="text/css" >
		#donate_for_a_good_cause { text-align: ' . $donate_for_a_good_cause_icon_position . '; ' . ($donate_for_a_good_cause_use_background ? $img_style_use_background : '' ) . ' }
		.donate_for_a_good_cause_icon { width: ' . $donate_for_a_good_cause_icon_size . '; height: ' . $donate_for_a_good_cause_icon_size . '; border: 0px solid; cursor: pointer; }
		.post { position: relative; }
		</style>';

		$output = $img_style . '<div id="donate_for_a_good_cause">';

		$output .= $img_tag;

		// These lines generate the output
		$output .= '</div>';

		echo $before_widget;
		echo $before_title;?>Libyan kids don't deserve this!<?php echo $after_title;
		echo $output;
		echo $after_widget;

	} /* donate_for_a_good_cause() */

	function donate_for_a_good_cause_control() {
		$options = $newoptions = get_option( 'donate_for_a_good_cause' );
		if ( $_POST[ "donate_for_a_good_cause_submit" ] ) {
			$newoptions[ 'donate_for_a_good_cause_title' ] = strip_tags( stripslashes( $_POST[ "donate_for_a_good_cause_title" ] ) );
			$newoptions[ 'donate_for_a_good_cause_icon_size' ] = $_POST[ "donate_for_a_good_cause_icon_size" ];
			$newoptions[ 'donate_for_a_good_cause_icon_position' ] = $_POST[ "donate_for_a_good_cause_icon_position" ];
			$newoptions[ 'donate_for_a_good_cause_use_background' ] = (int)$_POST[ "donate_for_a_good_cause_use_background" ];
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option( 'donate_for_a_good_cause', $options );
		}

		$donate_for_a_good_cause_title = htmlspecialchars( $options[ 'donate_for_a_good_cause_title' ], ENT_QUOTES );
		$donate_for_a_good_cause_icon_size = $options[ 'donate_for_a_good_cause_icon_size' ];
			if( !$donate_for_a_good_cause_icon_size ) $donate_for_a_good_cause_icon_size = '125px';
		$donate_for_a_good_cause_icon_position = $options[ 'donate_for_a_good_cause_icon_position' ];
			if( !$donate_for_a_good_cause_icon_position ) $donate_for_a_good_cause_icon_size = 'center';
		$donate_for_a_good_cause_use_background = (int)$options[ 'donate_for_a_good_cause_use_background' ];

?>


Icon width:<br />
&nbsp;<input type="radio" id="donate_for_a_good_cause_icon_size" name="donate_for_a_good_cause_icon_size" value="62px" <?php echo ( $donate_for_a_good_cause_icon_size == '62px' ? 'checked' : '' ); ?> />&nbsp;62px&nbsp;
<input type="radio" id="donate_for_a_good_cause_icon_size" name="donate_for_a_good_cause_icon_size" value="125px" <?php echo ( $donate_for_a_good_cause_icon_size == '125px' ? 'checked' : '' ); ?> />&nbsp;125px&nbsp;

<input type="radio" id="donate_for_a_good_cause_icon_size" name="donate_for_a_good_cause_icon_size" value="50%" <?php echo ( $donate_for_a_good_cause_icon_size == '50%' ? 'checked' : '' ); ?> />&nbsp;50%&nbsp;
<input type="radio" id="donate_for_a_good_cause_icon_size" name="donate_for_a_good_cause_icon_size" value="100%" <?php echo ( $donate_for_a_good_cause_icon_size == '100%' ? 'checked' : '' ); ?> />&nbsp;100%<br />

Icon position:<br />
&nbsp;<input type="radio" id="donate_for_a_good_cause_icon_position" name="donate_for_a_good_cause_icon_position" value="left" <?php echo ( $donate_for_a_good_cause_icon_position == 'left' ? 'checked' : '' ); ?> />&nbsp;left&nbsp;
<input type="radio" id="donate_for_a_good_cause_icon_position" name="donate_for_a_good_cause_icon_position" value="center" <?php echo ( $donate_for_a_good_cause_icon_position == 'center' ? 'checked' : '' ); ?> />&nbsp;center&nbsp;
<input type="radio" id="donate_for_a_good_cause_icon_position" name="donate_for_a_good_cause_icon_position" value="right" <?php echo ( $donate_for_a_good_cause_icon_position == 'right' ? 'checked' : '' ); ?> />&nbsp;right<br />

<br />
  	    <input type="hidden" id="donate_for_a_good_cause_submit" name="donate_for_a_good_cause_submit" value="1" />

<?php
	} /* donate_for_a_good_cause_control() */

	register_sidebar_widget( 'Donate For A Good Cause', 'donate_for_a_good_cause' );
	register_widget_control( 'Donate For A Good Cause', 'donate_for_a_good_cause_control' );
} /* donate_for_a_good_cause_init() */

add_action('plugins_loaded', 'donate_for_a_good_cause_init');



?>