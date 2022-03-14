<?php

class CarlosIIICommit_Shortcode
{

    public function CarlosIIICommit_Shortcode_init()
    {
        function CarlosIIICommit_Shortcode($atts, $content = null)
        {

            $ofertas = get_option('JuezLTICommit_options_nOfertas');

            $atts = shortcode_atts( array(
                'n_ofertas' => $ofertas,
            ), $atts );

            $query = new WP_Query( array( 'post_type' => 'commit' , 'posts_per_page' => $atts['n_ofertas']) );
            ob_start();
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('CarlosIIICommit', 'CarlosIIICommit_Shortcode');
    }

}
