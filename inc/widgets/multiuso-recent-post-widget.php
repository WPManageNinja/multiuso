<?php 
// Do not allow directly accessing this file.
if ( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

class MULTIUSO_Recent_Posts_Widget extends WP_Widget{

    //setup the widget name, description , etc.
    public function __construct(){

		$widget_ops = array(
			'calssname' => 'MULTIUSO_recent_posts_widget',
			'description' => esc_html__('Display Recent Posts Widget', 'multiuso')
		);

		parent::__construct('MULTIUSO_recent_posts', esc_html__('Multiuso Recent Posts', 'multiuso'), $widget_ops);
    }

    //back-end display of widget
    public function form( $instance ){ 

    	$title = ( !empty( $instance['title'] ) ? $instance['title'] : esc_html__('Recent Posts', 'multiuso') );
    	$total = ( !empty( $instance['total'] ) ? absint( $instance['total'] ) : 5 );
        ?>
    	<p>
	        <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php echo esc_html('Title:', 'multiuso');?></label>
	        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr( $title );?>">
        </p>
        <p>
	        <label for="<?php echo esc_attr($this->get_field_id('total'));?>"><?php echo esc_html('Number of Posts:', 'multiuso');?></label>
	        <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('total'));?>" name="<?php echo esc_attr($this->get_field_name('total'));?>" value="<?php echo esc_attr( $total );?>">
    	</p>
	    
        <?php
    }


    //update widget
     public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'total' ] = ( !empty( $new_instance[ 'total' ] ) ? absint( strip_tags( $new_instance[ 'total' ] ) ) : 0 );
		
		return $instance;
		
	}

	//front-end display of widget 
    public function widget( $args, $instance){

    	$total = absint( $instance['total'] );

    	$post_args = array(
    		'post_type' => 'post',
    		'posts_per_page' => $total,
    		'order' => 'DESC'
    	);
        $allowed_tags = array(
            'div' => array(
                'id' => array(),
                'class' => array()
            ),
            'h3' => array(
                'class' => array()
            ),
            'h4' => array(
                'class' => array()
            )
        );

    	$post_query = new WP_Query( $post_args );
        echo '<div class="recent-post">';
	    echo wp_kses($args['before_widget'], $allowed_tags);

	    if( !empty( $instance['title'] )){
		    echo wp_kses($args['before_title'], $allowed_tags) . esc_html(apply_filters('widget_title', $instance['title'], $instance, $this->id_base)) . wp_kses($args['after_title'], $allowed_tags);
	    }

    	if ( $post_query->have_posts() ):
         
            echo '<div class="all-recent-post">';

    		while( $post_query->have_posts() ) : $post_query->the_post();
            
    			echo '<div class="media">';
                echo '<div class="media-left">';
                if( has_post_thumbnail() ){
                echo '<a href="'.esc_url(get_permalink()).'">';
                the_post_thumbnail( 'multiuso-sidebar-recent-post'  );
                echo '</a>';
                }
                echo '</div>';
                echo '<div class="media-body">';
                echo ' <h4 class="post-text">
                      <a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a>
                     </h4>';
			    echo ' <div class="post-time">';
			    the_time('d-m-Y') ;
			    echo ' </div>';
                echo '</div>';
                echo '</div>';

    		endwhile;

            echo '</div>';

    	endif;
        
        wp_reset_postdata();

	    echo wp_kses($args['after_widget'], $allowed_tags);
        echo '</div>';
    }
}

function MULTIUSO_register_recent_post_widget(){
    register_widget( 'MULTIUSO_Recent_Posts_Widget' );
}
add_action('widgets_init', 'MULTIUSO_register_recent_post_widget');