<?php

// Registrar y cargar el widget
function CarlosIIISuscribe_load_widget() {
    register_widget( 'CarlosIIICommitWidgetSuscribe' );
}
add_action( 'widgets_init', 'CarlosIIISuscribe_load_widget' );

// Creando el widget
class CarlosIIICommitWidgetSuscribe extends WP_Widget {

    function __construct() {
        parent::__construct(

// ID base del widget
            'CarlosIIICommitWidgetSuscribe',

// Nombre del widget que aparecerá en la UI
            __('CarlosIIICommit Suscribe Widget', 'CarlosIIICommitSuscribe_widget_domain'),

// Descripción del widget
            array( 'description' => __( 'Suscribirse a participar en el proyecto piloto', 'CarlosIIICommitSuscribe_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/CarlosIIICommit-public-display.php';

        CarlosIIICommitWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/CarlosIIICommit-admin-display.php';


        CarlosIIICommitWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class CarlosIIICommitWidgetSuscribe ends here

