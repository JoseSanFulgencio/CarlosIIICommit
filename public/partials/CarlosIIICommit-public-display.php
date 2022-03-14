<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIICommit
 * @subpackage CarlosIIICommit/public/partials
 */

    function CarlosIIICommitWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Suscríbete para recibir participar en el proyecto piloto', 'CarlosIIICommitSuscribe_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="JuezLTICommit_suscribe">

        <p>
            <label for="nombre"><?php _e('Nombre:', 'subscribe-to-comments'); ?>
                <input type="nombre" name="nombre" id="nombre" size="22" value="" /></label>
            <br>
            <label for="email"><?php _e('E-Mail:', 'subscribe-to-comments'); ?>
                <input type="email" name="email" id="email" size="22" value="" /></label>
            <br>
            <label for="url-logo"><?php _e('Logotipo(url):', 'subscribe-to-comments'); ?>
                <input type="url_logo" name="url_logo" id="url_logo" size="22" value="" /></label>
            <input type="submit" name="submit" value="<?php _e('Subscribe', 'subscribe-to-comments'); ?>" />
        </p>
    </form>
<?php
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
