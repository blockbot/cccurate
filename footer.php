            </div> <!-- end #content -->
        
            <footer data-template-url="<?php bloginfo("template_url"); ?>">

                <p>Copyright &copy; <?php echo date(Y); ?> Curate</p>

            </footer> 

        </div> <!-- end #container -->  

        <?php

            // to make use of this update your .htaccess on your local machine 
            // in your wordpress root directory to include:
            // SetEnv APPLICATION_ENV development

            if(getenv('APPLICATION_ENV') == 'development'){
                $js_directory = 'js';
            } else {
                $js_directory = 'js-build';
            }

        ?>
        
        <script data-main="<?php bloginfo("template_url"); ?>/library/<?php echo $js_directory; ?>/main" src="<?php bloginfo("template_url"); ?>/library/js/require.js"></script>

        <?php if(!getenv('APPLICATION_ENV') == 'development'): ?>
    
            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-1881290-31', 'auto');
                ga('send', 'pageview');
            </script>

        <?php endif; ?>

        <?php if(is_single()): ?>


            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1377873419104069&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

            <?php 

                if(get_post_meta($post->ID, 'Video Source') == true){
                    $custom_field["Video Source"] = get_post_meta($post->ID, 'Video Source', true);
                }

            ?>

            <?php if($custom_field["Video Source"] == "Vine"): ?>
                <script async src="//platform.vine.co/static/scripts/embed.js\"></script>
            <?php endif; ?>

            <?php if($custom_field["Video Source"] == "Instagram"): ?>
                <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>
            <?php endif; ?>

        <?php endif; ?>
        
    </body>
</html>
