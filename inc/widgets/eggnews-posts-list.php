<?php
/**
 * Eggnews: Posts List
 *
 * Widget show latest or random posts in list view
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'eggnews_register_posts_list_widget' );

function eggnews_register_posts_list_widget() {
	register_widget( 'Eggnews_Posts_List' );
}

class Eggnews_Posts_List extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'eggnews_posts_list',
            'description' => esc_html__( 'Display latest or random posts in list view.', 'eggnews' )
        );
        parent::__construct( 'eggnews_posts_list', esc_html__( 'Posts Lists', 'eggnews' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

    	$eggnews_post_list_option = array(
    					'latest' => esc_html__( 'Latest Posts', 'eggnews' ),
    					'random' => esc_html__( 'Random Posts', 'eggnews' )
    					);

        $fields = array(

            'eggnews_block_title' => array(
                'eggnews_widgets_name'         => 'eggnews_block_title',
                'eggnews_widgets_title'        => esc_html__( 'Widget Title', 'eggnews' ),
                'eggnews_widgets_field_type'   => 'text'
            ),

            'eggnews_block_posts_count' => array(
                'eggnews_widgets_name'         => 'eggnews_block_posts_count',
                'eggnews_widgets_title'        => esc_html__( 'No. of Posts', 'eggnews' ),
                'eggnews_widgets_default'      => 4,
                'eggnews_widgets_field_type'   => 'number'
            ),

            'eggnews_block_posts_type' => array(
                'eggnews_widgets_name'         => 'eggnews_block_posts_type',
                'eggnews_widgets_title'        => esc_html__( 'Posts Type', 'eggnews' ),
                'eggnews_widgets_default'		 => 'latest',
                'eggnews_widgets_field_options'=> $eggnews_post_list_option,
                'eggnews_widgets_field_type'   => 'radio'
            ),

        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $eggnews_block_title      	= empty( $instance['eggnews_block_title'] ) ? '' : $instance['eggnews_block_title'];
        $eggnews_block_posts_count    = intval( empty( $instance['eggnews_block_posts_count'] ) ? 4 : $instance['eggnews_block_posts_count'] );
        $eggnews_block_posts_type     = empty( $instance['eggnews_block_posts_type'] ) ? '' : $instance['eggnews_block_posts_type'];
        echo $before_widget;
?>
			<div class="widget-block-wrapper">
				<div class="block-header">
	                <h3 class="block-title"><?php echo esc_html( $eggnews_block_title ); ?></h3>
	            </div><!-- .block-header -->
	            <div class="posts-list-wrapper list-posts-block">
	            	<?php
	            		$posts_list_args = eggnews_query_args( $cat_id = null, $eggnews_block_posts_count );
	            		if( $eggnews_block_posts_type == 'random' ) {
	            			$posts_list_args['orderby'] = 'rand';
	            		}
	            		$posts_list_query = new WP_Query( $posts_list_args );
	            		if( $posts_list_query->have_posts() ) {
	            			while( $posts_list_query->have_posts() ) {
	            				$posts_list_query->the_post();
	                ?>
	                			<div class="single-post-wrapper clearfix">
                                    <div class="post-thumb-wrapper">
    	                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
    	                                    <figure><?php the_post_thumbnail( 'eggnews-block-thumb' ); ?></figure>
    	                                </a>
                                    </div>
                                    <div class="post-content-wrapper">
                                        <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
    	                                <div class="post-meta-wrapper">
    	                                    <?php eggnews_posted_on(); ?>
    	                                </div><!-- .post-meta-wrapper -->
                                    </div>
	                            </div><!-- .single-post-wrapper -->
	                <?php
	            			}
	            		}

	            	?>
	            </div><!-- .posts-list-wrapper -->
			</div><!-- .widget-block-wrapper -->
<?php
		echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    eggnews_widgets_updated_field_value()     defined in eggnews-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
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
     * @param   array $instance Previously saved values from database.
     *
     * @uses    eggnews_widgets_show_widget_field()       defined in widget-fields.php
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
