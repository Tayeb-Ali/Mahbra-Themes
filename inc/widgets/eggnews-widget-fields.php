<?php
/**
 * Define custom fields for widgets
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

function eggnews_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {

	extract( $widget_field );

	switch ( $eggnews_widgets_field_type ) {

		// Standard text field
		case 'text' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>" type="text"
				       value="<?php echo esc_html( $athm_field_value ); ?>"/>

				<?php if ( isset( $eggnews_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $eggnews_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Standard url field
		case 'url' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>" type="text"
				       value="<?php echo esc_html( $athm_field_value ); ?>"/>

				<?php if ( isset( $eggnews_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $eggnews_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Checkbox field
		case 'checkbox' :
			?>
			<p>
				<input id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>"
				       type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?></label>

				<?php if ( isset( $eggnews_widgets_description ) ) { ?>
					<br/>
					<small><?php echo wp_kses_post( $eggnews_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' :
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label>
				<textarea class="widefat" rows="<?php echo intval( $eggnews_widgets_row ); ?>"
				          id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				          name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $athm_field_value ); ?></textarea>
			</p>
			<?php
			break;

		// Radio fields
		case 'radio' :
			if ( empty( $athm_field_value ) ) {
				$athm_field_value = $eggnews_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label>
			<div class="radio-wrapper">
				<?php
				foreach ( $eggnews_widgets_field_options as $athm_option_name => $athm_option_title ) {
					?>
					<input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"
					       name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>"
					       type="radio"
					       value="<?php echo esc_html( $athm_option_name ); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label
						for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?>
						:</label>
				<?php } ?>
			</div>

			<?php if ( isset( $eggnews_widgets_description ) ) { ?>
			<small><?php echo esc_html( $eggnews_widgets_description ); ?></small>
		<?php } ?>
			</p>
			<?php
			break;

		// Select field
		case 'select' :
			if ( empty( $athm_field_value ) ) {
				$athm_field_value = $eggnews_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label>
				<select name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>"
				        id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				        class="widefat">
					<?php foreach ( $eggnews_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr( $athm_option_name ); ?>"
						        id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
					<?php } ?>
				</select>

				<?php if ( isset( $eggnews_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $eggnews_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'number' :
			if ( empty( $athm_field_value ) ) {
				$athm_field_value = $eggnews_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"><?php echo esc_html( $eggnews_widgets_title ); ?>
					:</label><br/>
				<input name="<?php echo esc_attr( $instance->get_field_name( $eggnews_widgets_name ) ); ?>"
				       type="number" step="1" min="1"
				       id="<?php echo esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ); ?>"
				       value="<?php echo esc_html( $athm_field_value ); ?>"/>

				<?php if ( isset( $eggnews_widgets_description ) ) { ?>
					<br/>
					<small><?php echo esc_html( $eggnews_widgets_description ); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'widget_section_header':
			?>
			<span class="section-header"><?php echo esc_html( $eggnews_widgets_title ); ?></span>
			<?php
			break;

		case 'widget_layout_image':
			?>
			<div class="layout-image-wrapper">
				<span class="image-title"><?php echo esc_html( $eggnews_widgets_title ); ?></span>
				<img src="<?php echo esc_url( $eggnews_widgets_layout_img ); ?>"
				     title="<?php echo esc_attr__( 'Widget Layout', 'eggnews' ); ?>"/>
			</div>
			<?php
			break;

		case 'upload' :

			$output = '';
			$id     = esc_attr( $instance->get_field_id( $eggnews_widgets_name ) );
			$class  = '';
			$int    = '';
			$value  = $athm_field_value;
			$name   = esc_attr( $instance->get_field_name( $eggnews_widgets_name ) );

			if ( $value ) {
				$class = ' has-file';
				$value = explode( 'wp-content', $value );
				$value = content_url() . $value[1];
			}
			$output .= '<div class="sub-option widget-upload">';
			$output .= '<label for="' . esc_attr( $instance->get_field_id( $eggnews_widgets_name ) ) . '">' . esc_html( $eggnews_widgets_title ) . '</label><br/>';
			$output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__( 'No file chosen', 'eggnews' ) . '" />' . "\n";
			if ( function_exists( 'wp_enqueue_media' ) ) {
				if ( ( $value == '' ) ) {
					$output .= '<input id="upload-' . $id . '" class="wid-upload-button button" type="button" value="' . esc_html__( 'Upload', 'eggnews' ) . '" />' . "\n";
				} else {
					$output .= '<input id="remove-' . $id . '" class="wid-remove-file button" type="button" value="' . esc_html__( 'Remove', 'eggnews' ) . '" />' . "\n";
				}
			} else {
				$output .= '<p><i>' . esc_html__( 'Upgrade your version of WordPress for full media support.', 'eggnews' ) . '</i></p>';
			}

			$output .= '<div class="screenshot upload-thumb" id="' . $id . '-image">' . "\n";

			if ( $value != '' ) {
				$remove = '<a class="remove-image">' . esc_html__( 'Remove', 'eggnews' ) . '</a>';
				$image  = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
				if ( $image ) {
					$output .= '<img src="' . esc_url($value) . '" alt="' . esc_html__( 'Upload image', 'eggnews' ) . '" />';
				} else {
					$parts = explode( "/", $value );
					for ( $i = 0; $i < sizeof( $parts ); ++ $i ) {
						$title = $parts[ $i ];
					}

					// No output preview if it's not an image.
					$output .= '';

					// Standard generic output if it's not an image.
					$title = esc_html__( 'View File', 'eggnews' );
					$output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
				}
			}
			$output .= '</div></div>' . "\n";
			echo $output;
			break;
	}
}

function eggnews_widgets_updated_field_value( $widget_field, $new_field_value ) {


	$eggnews_widgets_field_type = '';

	extract( $widget_field );

	switch ( $eggnews_widgets_field_type ) {
		// Allow only integers in number fields
		case 'number':
			return eggnews_sanitize_number( $new_field_value );
			break;
		// Allow some tags in textareas
		case 'textarea':
			$eggnews_widgets_allowed_tags = array(
				'p' => array(),
				'em' => array(),
				'strong' => array(),
				'a' => array(
					'href' => array(),
				),
			);
			return wp_kses( $new_field_value, $eggnews_widgets_allowed_tags );
			break;
		// No allowed tags for all other fields
		case 'url':
			return esc_url_raw( $new_field_value );
			break;
		default:
			return wp_kses_post( sanitize_text_field( $new_field_value ) );

	}
}
