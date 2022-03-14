<div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="<?php menu_page_url( 'commits-options' ) ?>" method="post">
            <?php
            // output security fields for the registered setting "CarlosIIIJob_options"
            settings_fields( 'CarlosIIICommit_options' );
            // output setting sections and their fields
            // (sections are registered for "CarlosIIICommit", each field is registered to a specific section)
            do_settings_sections( 'commits-options' );
            // output save settings button
            submit_button( __( 'Save Settings', 'textdomain' ) );
            ?>
        </form>
    </div>