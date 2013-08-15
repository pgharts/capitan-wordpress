<?php
class Capitan_Calendar_Widget extends WP_Widget {

	public function __construct() {
    parent::__construct(
        'capitan_calendar_widget', // Base ID
      'Capitan Mini Calendar', // Name
      array( 'description' => __( 'Displays an event calendar.', 'text_domain' ), ) // Args
    );
	}

 	public function form( $instance ) {
		// outputs the options form on admin
     if ( isset( $instance[ 'capitan-calendar-title' ] ) ) {
   			$title = $instance[ 'capitan-calendar-title' ];
   		}
   		else {
   			$title = __( 'Upcoming Events', 'text_domain' );
   		}

   		?>
   		<p>
   		<label for="<?php echo $this->get_field_id( 'capitan-calendar-title' ); ?>"><?php _e( 'Title' ); ?></label>
   		<input class="widefat" id="<?php echo $this->get_field_id( 'capitan-calendar-title' ); ?>" name="<?php echo $this->get_field_name( 'capitan-calendar-title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      </p>
   		<?php
   	}

	public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['capitan-calendar-title'] = strip_tags( $new_instance['capitan-calendar-title'] );


    return $instance;
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
    extract( $args );
    $title = apply_filters( 'widget_title', $instance['capitan-calendar-title'] );

    $capitan_calendar = new CapitanCalendar(date("Y"), date("m"));
    ob_start();
    require("views/capitan_mini_calendar_widget.php");
    $calendar_html = ob_get_contents();
    ob_end_clean();


    echo $before_widget;
    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;
    echo $calendar_html;
    echo $after_widget;
	}

}
register_widget( 'Capitan_Calendar_Widget' );

?>