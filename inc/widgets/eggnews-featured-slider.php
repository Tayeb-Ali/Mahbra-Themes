<?php
/**
 * Eggnews: Homepage Featured Slider
 *
 * Homepage slider section with featured section
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'eggnews_register_featured_slider_widget' );

function eggnews_register_featured_slider_widget() {
    register_widget( 'Eggnews_Featured_Slider' );
}

class Eggnews_Featured_Slider extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'eggnews_featured_slider clearfix',
            'description' => esc_html__( 'Display slider with featured posts.', 'eggnews' )
        );
        parent::__construct( 'eggnews_featured_slider', esc_html__( 'Featured Slider', 'eggnews' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

	   $eggnews_category_dropdown = eggnews_category_dropdown();

    	$fields = array(

            'slider_header_section' => array(
                'eggnews_widgets_name' => 'slider_header_section',
                'eggnews_widgets_title' => esc_html__( 'Slider Section', 'eggnews' ),
                'eggnews_widgets_field_type' => 'widget_section_header'
            ),

            'eggnews_slider_category' => array(
                'eggnews_widgets_name' => 'eggnews_slider_category',
                'eggnews_widgets_title' => esc_html__( 'Category for Slider', 'eggnews' ),
                'eggnews_widgets_default'      => 0,
                'eggnews_widgets_field_type' => 'select',
                'eggnews_widgets_field_options' => $eggnews_category_dropdown
            ),

            'eggnews_slide_count' => array(
                'eggnews_widgets_name' => 'eggnews_slide_count',
                'eggnews_widgets_title' => esc_html__( 'No. of slides', 'eggnews' ),
                'eggnews_widgets_default' => 5,
                'eggnews_widgets_field_type' => 'number'
            ),

            'featured_header_section' => array(
                'eggnews_widgets_name' => 'featured_header_section',
                'eggnews_widgets_title' => esc_html__( 'Featured Posts Section', 'eggnews' ),
                'eggnews_widgets_field_type' => 'widget_section_header'
            ),

            'eggnews_featured_category' => array(
                'eggnews_widgets_name' => 'eggnews_featured_category',
                'eggnews_widgets_title' => esc_html__( 'Category for Featured Posts', 'eggnews' ),
                'eggnews_widgets_default'      => 0,
                'eggnews_widgets_field_type' => 'select',
                'eggnews_widgets_field_options' => $eggnews_category_dropdown
            ),

        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $eggnews_slider_category_id      = intval( empty( $instance['eggnews_slider_category'] ) ? null : $instance['eggnews_slider_category'] );
        $eggnews_slide_count             = intval( empty( $instance['eggnews_slide_count'] ) ? 5 : $instance['eggnews_slide_count'] );
        $eggnews_featured_category_id    = intval( empty( $instance['eggnews_featured_category'] ) ? null : $instance['eggnews_featured_category'] );
        echo $before_widget;
    ?>
        <div class="teg-featured-slider-wrapper">
            <div class="teg-slider-section">
                <?php
                    $slider_args = eggnews_query_args( $eggnews_slider_category_id, $eggnews_slide_count );
                    $slider_query = new WP_Query( $slider_args );
                    if( $slider_query->have_posts() ) {
                        echo '<ul class="eggnewsSlider">';
                        while( $slider_query->have_posts() ) {
                            $slider_query->the_post();
                    ?>
                            <li>
                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>">
                                    <figure><?php the_post_thumbnail( 'eggnews-slider-large' ); ?></figure>
                                </a>
                                <div class="slider-content-wrapper">

                                    <h3 class="slide-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta-wrapper">
                                        <?php eggnews_posted_on(); ?>
                                        <?php eggnews_post_comment(); ?>
                                    </div>
	                                <?php do_action( 'eggnews_post_categories' ); ?>
                                </div><!-- .post-meta-wrapper -->
                            </li>
                    <?php
                        }
                        echo '</ul>';
                    }
                    wp_reset_postdata();
                ?>
            </div><!-- .teg-slider-section -->
        </div><!-- .teg-featured-slider-wrapper -->

        <div class="featured-post-wrapper">
            <?php
                $featured_args = eggnews_query_args( $eggnews_featured_category_id, 3 );
                $featured_query = new WP_Query( $featured_args );
                $total_post_count = $featured_query->post_count;
                if( $featured_query->have_posts() ) {
                    $post_count = 1;
                    while ( $featured_query->have_posts() ) {
                        $featured_query->the_post();
                        $post_id = get_the_ID();
                        $image_path = get_the_post_thumbnail( $post_id, 'eggnews-featured-medium' );
                        if( $post_count == 1 ) {
                            echo '<div class="featured-left-section">';
                        } elseif( $post_count == 3 ) {
                            $image_path = get_the_post_thumbnail( $post_id, 'eggnews-featured-long' );
                            echo '<div class="featured-right-section">';
                        }
            ?>
                    <div class="single-featured-wrap">
                        <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>">
                            <figure><?php echo $image_path; ?></figure>
                        </a>
                        <div class="featured-content-wrapper">

                            <h3 class="featured-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                            <div class="post-meta-wrapper"> <?php eggnews_posted_on(); ?> </div>
	                        <?php do_action( 'eggnews_post_categories' ); ?>
                        </div><!-- .post-meta-wrapper -->
                    </div><!-- .single-featured-wrap -->
            <?php
                        if( $post_count == 2 || $post_count == $total_post_count ) {
                            echo '</div>';
                        }
                        $post_count++;
                    }
                }
                wp_reset_postdata();
            ?>
        </div>

    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	eggnews_widgets_updated_field_value()		defined in eggnews-widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$eggnews_widgets_name] = eggnews_widgets_updated_field_value( $widget_field, $new_instance[$eggnews_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	eggnews_widgets_show_widget_field()		defined in eggnews-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $eggnews_widgets_field_value = !empty( $instance[$eggnews_widgets_name] ) ? wp_kses_post( $instance[$eggnews_widgets_name] ) : '';
            eggnews_widgets_show_widget_field( $this, $widget_field, $eggnews_widgets_field_value );
        }
    }

}
