    </main>

    <?php

        if(function_exists('the_custom_logo')) {

            //the_custom_logo();
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id );
            if ( $logo ) {
                $icon = get_site_icon_url( 100, $logo[0] );
            }

        }

    ?>

    <footer>
        <div class="logo">
            <img src=
					"<?php
						if ( $logo ) {
							echo $logo[0];
						}
					?>"
				alt="<?php esc_html_e( 'Logo', '3hoops' ) ?>" />
        </div>
        <div class="footer-wrapper">
            <ul class="socialmedia">
                <?php
                    $socialmedias = array(
                        array('Facebook', 'facebook', 'fa-brands fa-facebook-f'),
                        array('Instagram', 'instagram', 'fab fa-instagram fa-fw'),
                        array('Tiktok', 'tiktok', 'fab fa-tiktok fa-fw'),
						array( 'YouTube', 'youtube', 'fa-brands fa-youtube' ),
                        array('X', 'x', 'fab fa-x-twitter fa-fw'),
                        array('Threads', 'threads', 'fab fa-threads fa-fw'),
                        array( 'Bluesky', 'bluesky', 'fa-brands fa-bluesky' ),
                        array( 'Reddit', 'reddit', 'fa-brands fa-reddit' ),
                        array('Github', 'github', 'fab fa-github fa-fw'),
                    );
                ?>
                <?php foreach ($socialmedias as $socialmedia) : ?>
                <li class="menu-item">
                    <a href="<?php
                        $social_link = get_theme_mod($socialmedia[1] . '_link', '');
                        if ($social_link) {
                            echo esc_attr($social_link);
                        }
                    ?>" title="<?php esc_html_e( $socialmedia[0] ); ?>" target="_blank">
                        <i class="<?php echo esc_html( $socialmedia[2] ); ?>"></i>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>

            <?php

                wp_nav_menu(
                    array(
                        'menu' => 'footer',
                        'container' => '',
                        'theme_location' => 'footer',
                        'items_wrap' => '<ul class="footer-navigation">%3$s</ul>',
                        'fallback_cb' => '',
                        'depth' => 2
                    )
                );

                dynamic_sidebar( 'footer-widget' ); 
            
            ?>

        </div>
    </footer>

    <?php
        wp_footer();
    ?>

</body>
</html>