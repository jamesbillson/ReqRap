<?php
/**
 * Options for Admin Options Panel
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'tcsn_theme'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'tcsn_theme'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
			
			

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;
			
            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'tcsn_theme'), $this->theme->display('Name'));
            
            ?>

<div id="current-theme" class="<?php echo esc_attr($class); ?>">
  <?php if ($screenshot) : ?>
  <?php if (current_user_can('edit_theme_options')) : ?>
  <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>"> <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" /> </a>
  <?php endif; ?>
  <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
  <?php endif; ?>
  <h4><?php echo $this->theme->display('Name'); ?></h4>
  <div>
    <ul class="theme-info">
      <li><?php printf(__('By %s', 'tcsn_theme'), $this->theme->display('Author')); ?></li>
      <li><?php printf(__('Version %s', 'tcsn_theme'), $this->theme->display('Version')); ?></li>
      <li><?php echo '<strong>' . __('Tags', 'tcsn_theme') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
    </ul>
    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
    <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'tcsn_theme'), $this->theme->parent()->display('Name'));
            }
            ?>
  </div>
</div>
<?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
			
			
			// General 
			$this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General', 'tcsn_theme'),
                'fields'	=> array(
					array(
                        'id'	=> 'tcsn-favicon-field',
                        'type'	=> 'info',
                        'desc'	=> __('Favicon / Touch Icons', 'tcsn_theme')
                    ),
				  	array(
                        'id'        => 'tcsn_favicon',
                        'type'		=> 'media',
						'url'		=> true,
                        'title'     => __('Favicon', 'tcsn_theme'),
                        'subtitle'	=> __('Upload Favicon (16px x 16px ico/png/jpg)', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/favicon.png' ),
                    ),
				  	array(
                        'id'        => 'tcsn_favicon_iphone',
                        'type'      => 'media',
						'url'		=> true,
                        'title'     => __('Standard iPhone Touch Icon', 'tcsn_theme'),
                        'subtitle'  => __('Upload Icon ( 57px x 57px png )', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/standard-iPhone-touch.png' ),
                    ),
				 	array(
                        'id'        => 'tcsn_favicon_iphone_retina',
                        'type'      => 'media',
						'url'		=> true,
                        'title'     => __('Retina iPhone Touch Icon', 'tcsn_theme'),
                        'subtitle'  => __('Upload Icon ( 114px x 114px png )', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/retina-iPhone-touch.png' ),
                    ),
				 	array(
                        'id'        => 'tcsn_favicon_ipad',
                        'type'      => 'media',
						'url'		=> true,
                        'title'     => __('Standard iPad Touch Icon', 'tcsn_theme'),
                        'subtitle'  => __('Upload Icon ( 72px x 72px png )', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/standard-iPad-touch.png' ),
                    ),
				 	array(
                        'id'        => 'tcsn_favicon_ipad_retina',
                        'type'      => 'media',
						'url'		=> true,
                        'title'     => __('Retina iPad Touch Icon', 'tcsn_theme'),
                        'subtitle'  => __('Upload Icon ( 144px x 144px png )', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/retina-iPad-touch-.png' ),
                    ),
				 	array(
                        'id'	=> 'tcsn-responsive-field',
                        'type'	=> 'info',
                        'desc'	=> __('Responsive', 'tcsn_theme')
                    ),
					array(
                        'id'       => 'tcsn_layout_responsive',
						'type'     => 'switch',
						'title'    => __('Responsiveness', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'	=> 'tcsn-tracking-field',
                        'type'	=> 'info',
                        'desc'	=> __('Tracking Code', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_header_tracking',
                        'type'      => 'textarea',
                        'required'  => '',
                        'title'     => __('Tracking Code in Header', 'tcsn_theme'),
                        'subtitle'  => __('Paste your Google Analytics (or other) tracking code here. <br>This will be added into the header of theme.', 'tcsn_theme'),
                        'validate'  => '', // js
                        'desc'      => '',
                    ),
					array(
                        'id'        => 'tcsn_footer_tracking',
                        'type'      => 'textarea',
                        'required'  => '',
                        'title'     => __('Tracking Code in Footer', 'tcsn_theme'),
                        'subtitle'  => __('Paste your Google Analytics (or other) tracking code here. <br>This will be added into the footer of theme.', 'tcsn_theme'),
                        'validate'  => '', //js
                        'desc'      => '',
                    ),
					array(
                        'id'	=> 'tcsn-comment-field',
                        'type'	=> 'info',
                        'desc'	=> __('Comments on Pages (other than posts)', 'tcsn_theme')
                    ),
					array(
                        'id'       => 'tcsn_page_comments',
						'type'     => 'switch',
						'title'    => __('Comments on pages', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => false,
                    ),
                )
            );
			
			// Typography and Styling
            $this->sections[] = array(
                'title'     => __(' Typography & Styling', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-magic',
                'fields'    => array(
				 array(
                        'id'	=> 'tcsn-body-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Body Typography', 'tcsn_theme')
                    ),
				 array(
                        'id'            => 'tcsn_body_typography',
                        'type'          => 'typography',
                        'title'         => '',
                        'google'        => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true, // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'    => false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'		=> array('body'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
							'font-family'   => 'Roboto',
                            'color'         => '#545454',
                            'font-style'    => '300',
                            'font-size'     => '14px',
                            'line-height'   => '22px'),
                    ),
					array(
                        'id'	=> 'tcsn-headings-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Headings Typography', 'tcsn_theme'),
                    ),
				 	array(
                        'id'            => 'tcsn_h1_typography',
                        'type'          => 'typography',
                        'title'         => __('H1', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h1', 'h1 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '48px',
                            'line-height'   => '52px'),
                    ),
					array(
                        'id'            => 'tcsn_h2_typography',
                        'type'          => 'typography',
                        'title'         => __('H2', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h2', 'h2 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '36px',
                            'line-height'   => '42px'),
                    ),
					array(
                        'id'            => 'tcsn_h3_typography',
                        'type'          => 'typography',
                        'title'         => __('H3', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h3', 'h3 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '30px',
                            'line-height'   => '36px'),
                    ),
					array(
                        'id'            => 'tcsn_h4_typography',
                        'type'          => 'typography',
                        'title'         => __('H4', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h4', 'h4 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '24px',
                            'line-height'   => '30px'),
                    ),
					array(
                        'id'            => 'tcsn_h5_typography',
                        'type'          => 'typography',
                        'title'         => __('H5', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h5', 'h5 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '18px',
                            'line-height'   => '24px'),
                    ),
					array(
                        'id'            => 'tcsn_h6_typography',
                        'type'          => 'typography',
                        'title'         => __('H6', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('h6', 'h6 a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '14px',
                            'line-height'   => '20px'),
                    ),
					array(
                        'id'	=> 'tcsn-other-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('General', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_theme_link_color',
                        'type'      => 'link_color',
						'output'    => array('a'),
                        'title'     => __('Link Color', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'regular'   => true, // Disable Regular Color
                        'hover'     => true, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        'visited'   => false,  // Enable Visited Color
                        'default'   => array(
                            'regular'   => '#b8b8b8',
                            'hover'     => '#545454',
                        )
                    ),
					array(
                        'id'            => 'tcsn_button_typography',
                        'type'          => 'typography',
                        'title'         => __('Button Font', 'tcsn_theme'),
						'font-family'   => true,  
                        'google'        => true,   
                        'font-backup'   => false,   
                        'font-style'    => false, 
                        'subsets'       => false, 
                        'font-size'     => false,
						'font-weight'   => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => false,
                        'preview'       => false, 
                        'all_styles'    => false,    
                        'output'    	=> array('.mybtn', 'input[type="submit"]'),
                        'units'         => 'px', 
                        'subtitle'      => '',
                        'default'       => array(
							'font-family'   => 'Roboto',
							'font-style'    => '400',
						),
                    ),
					array(
                        'id'	=> 'tcsn-slide-panel-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Slide Panel Typography', 'tcsn_theme')
                    ),
				 	array(
                        'id'            => 'tcsn_slide_panel_typography',
                        'type'          => 'typography',
                        'title'         => '',
                        'google'        => true,    
                        'font-backup'   => false,    
                        'font-style'    => true, 
                        'subsets'       => true, 
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'    => false,
                        'color'         => true,
                        'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'		=> array('#slide-top'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#ffffff',
                            'font-style'    => '300',
                            'font-family'   => 'Roboto',
                            'font-size'     => '14px',
                            'line-height'   => '22px'),
                    ),
					array(
                        'id'        	=> 'tcsn_slide_panel_headings',
                        'type'      	=> 'color',
                        'output'    	=> array('#slide-top h1', '#slide-top h2', '#slide-top h3', '#slide-top h4', '#slide-top h5', '#slide-top h6', '#slide-top h1 a', '#slide-top h2 a', '#slide-top h3 a', '#slide-top h4 a', '#slide-top h5 a', '#slide-top h6 a'),
                        'title'     	=> __('Headings Color', 'tcsn_theme'),
                       'transparent'	=> false,
                        'default'   	=> '#ffffff',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        => 'tcsn_slide_panel_link_color',
                        'type'      => 'link_color',
						'output'    => array('#slide-top a'),
                        'title'     => __('Link Color', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'regular'   => true, // Disable Regular Color
                        'hover'     => true, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        'visited'   => false,  // Enable Visited Color
                        'default'   => array(
                            'regular'   => '#ffffff',
                            'hover'     => '#060606',
                        )
                    ),
					array(
                        'id'	=> 'tcsn-topbar-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Topbar', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_topbar_typography',
                        'type'          => 'typography',
                        'title'         => '',
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => false, // Disable the previewer
                        'all_styles'    => false,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('#topbar', '#topbar a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#ffffff',
                            'font-family'   => 'Roboto',
                            'font-style'    => '300',
                            'font-size'     => '14px',
                            ),
                    ),
				   array(
                        'id'        	=> 'tcsn_topbar_link_hover',
                        'type'      	=> 'color',
                        'output'    	=> array('#topbar a:hover'),
                        'title'     	=> __('Topbar Link Hover Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#545454',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_topbar_social_color',
						'output'        => array('#topbar .social li i'), // An array of CSS selectors to apply this font style to
                        'type'      	=> 'color',
                        'title'     	=> __('Social Icon Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#ffffff',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'	=> 'tcsn-menu-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Menu Typography', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_menu_typography',
                        'type'          => 'typography',
                        'title'         => __('Menu link', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('.sf-menu a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#060606',
                            'font-style'    => '500',
                            'font-family'	=> 'Roboto',
                            'font-size'     => '14px',
                            ),
                    ),
					array(
                        'id'        	=> 'tcsn_menu_link_hover',
                        'type'      	=> 'color',
                        'output'    	=> array('.sf-menu li a:hover'),
                        'title'     	=> __('Menu Link Hover Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#a2a2a2',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_menu_link_active',
                        'type'      	=> 'color',
                        'output'    	=> array('.sf-menu li.current-menu-item a', '.sf-menu li.current-menu-ancestor > a'),
                        'title'     	=> __('Menu Active Link Color', 'tcsn_theme'),
                       'transparent'	=> false,
                        'default'   	=> '#a2a2a2',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'            => 'tcsn_menu_dropdown_typography',
                        'type'          => 'typography',
                        'title'         => __('Dropdown Link', 'tcsn_theme'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => false,
                        'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'    	=> array('.sf-menu li li a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'font-style'    => '400',
                            'font-family'	=> 'Roboto',
                            'font-size'     => '14px',
                            ),
                    ),
					array(
                        'id'        => 'tcsn_dropdown_background',
                        'type'      => 'background',
                        'output'    => array('.sf-menu ul'),
                        'title'     => __('Dropdown Background Color', 'tcsn_theme'),
						'background-image' => false,
						'background-repeat' => false,
						'background-size' => false,
						'background-attachment' => false,
						'background-position' => false,
						'preview'  => false,
                       	'default'	=> array(
        					'background-color' => '#ffffff',
    					),
                    ),
					array(
                        'id'        	=> 'tcsn_dropdown_border',
                        'type'      	=> 'color',
                        'title'     	=> __('Dropdown Border Color', 'tcsn_theme'),
                        'transparent'	=> false,
                        'default'   	=> '#d5d5d5',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_dropdown_link',
                        'type'      	=> 'color',
                        'output'    	=> array('.sf-menu li li a', '.sf-menu li li:hover > a', '.sf-menu li.current-menu-item li a'),
                        'title'     	=> __('Dropdown Link Color', 'tcsn_theme'),
                        'transparent'	=> false,
                        'default'   	=> '#060606',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_dropdown_link_hover',
                        'type'      	=> 'color',
                        'output'    	=> array('.sf-menu li li a:hover'),
                        'title'     	=> __('Dropdown Link Hover Color', 'tcsn_theme'),
                        'transparent'	=> false,
                        'default'   	=> '#a2a2a2',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'	=> 'tcsn-pageheader-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Page Header', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_page_title_typography',
                        'type'          => 'typography',
                        'title'         => __('Page Title', 'tcsn_theme'),
                        'font-family'   => true,  
                        'google'        => true,   
                        'font-backup'   => false,   
                        'font-style'    => true, 
                        'subsets'       => true, 
                        'font-size'     => true,
						'font-weight'   => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => false, 
                        'all_styles'    => false,    
                        'output'    	=> array('.page-title'),
                        'units'         => 'px', 
                        'default'       => array(
							'font-style'    => '400',
                            'font-family'	=> 'Patua One',
                            'font-size'     => '24px',
							'color'         => '#b8b8b8',
						),
                    ),
					array(
                        'id'            => 'tcsn_breadcrumb_typography',
                        'type'          => 'typography',
                        'title'         => __('Font size', 'tcsn_theme'),
						'subtitle'      => 'Breadcrumb and other text',
                        'font-family'   => false,  
                        'google'        => false,   
                        'font-backup'   => false,   
                        'font-style'    => false, 
                        'subsets'       => false, 
                        'font-size'     => true,
						'font-weight'   => false,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => true,
                        'preview'       => false, 
                        'all_styles'    => false,    
                        'output'    	=> array('.breadcrumbs'),
                        'units'         => 'px', 
                        'default'       => array(
                            'font-size'     => '11px',
							'color'         => '#b8b8b8',
						),
                    ),
					array(
                        'id'        => 'tcsn_page_header_link',
                        'type'      => 'link_color',
						'output'    => array('#page-header a'),
                        'title'     => __('Link Color', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'regular'   => true, // Disable Regular Color
                        'hover'     => true, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        'visited'   => false,  // Enable Visited Color
                        'default'   => array(
                            'regular'   => '#b8b8b8',
                            'hover'     => '#545454',
                        )
                    ),
					array(
                        'id'	=> 'tcsn-footer-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Footer Typography', 'tcsn_theme')
                    ),
				 	array(
                        'id'            => 'tcsn_footer_typography',
                        'type'          => 'typography',
                        'title'         => '',
                        'google'        => true,    
                        'font-backup'   => false,    
                        'font-style'    => true, 
                        'subsets'       => true, 
                        'font-size'     => true,
                        'line-height'   => true,
						'text-align'    => false,
                        'color'         => true,
                        'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'		=> array('#footer'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => '',
                        'default'       => array(
                            'color'         => '#787878',
                            'font-style'    => '300',
                            'font-family'   => 'Roboto',
                            'font-size'     => '14px',
                            'line-height'   => '22px'),
                    ),
					array(
                        'id'        	=> 'tcsn_footer_headings',
                        'type'      	=> 'color',
                        'output'    	=> array('#footer h1', '#footer h2', '#footer h3', '#footer h4', '#footer h5', '#footer h6', '#footer h1 a', '#footer h2 a', '#footer h3 a', '#footer h4 a', '#footer h5 a', '#footer h6 a', '.twitter-info'),
                        'title'     	=> __('Headings Color', 'tcsn_theme'),
                       'transparent'	=> false,
                        'default'   	=> '#ffffff',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        => 'tcsn_footer_link_color',
                        'type'      => 'link_color',
						'output'    => array('#footer a'),
                        'title'     => __('Link Color', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'regular'   => true, // Disable Regular Color
                        'hover'     => true, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        'visited'   => false,  // Enable Visited Color
                        'default'   => array(
                            'regular'   => '#b8b8b8',
                            'hover'     => '#545454',
                        )
                    ),
					array(
                        'id'	=> 'tcsn-widget-typography-field',
                        'type'	=> 'info',
                        'desc'	=> __('Widgets', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_widget_typography',
                        'type'          => 'typography',
                        'title'         => __('Widget Heading', 'tcsn_theme'),
						'font-family'   => true,  
                        'google'        => true,   
                        'font-backup'   => false,   
                        'font-style'    => true, 
                        'subsets'       => true, 
                        'font-size'     => true,
						'font-weight'   => true,
                        'line-height'   => false,
						'text-align'	=> false,
                        'color'         => false,
                        'preview'       => false, 
                        'all_styles'    => false,    
                        'output'    	=> array('.widget-title'),
                        'units'         => 'px', 
                        'subtitle'      => '',
                        'default'       => array(
							'font-size'     => '18px',
							'font-style'    => '400',
                            'font-family'   => 'Patua One',
						),
                    ),
					array(
                        'id'        	=> 'tcsn_widget_border_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Widgets / Bordered List - Border Color', 'tcsn_theme'),
						'transparent'	=> true,
                        'default'   	=> '#d5d5d5',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_social_widget_color',
                        'type'      	=> 'color',
						'output'    	=> array('.social li i'),
                        'title'     	=> __('Social Network Widget - Icons Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#b8b8b8',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'	=> 'tcsn-slide-panel-widget-field',
                        'type'	=> 'info',
						'style' => 'warning',
                        'desc'	=> __("Settings for Top Slide Panel Widgets", 'tcsn_theme')
                    ),
					array(
                        'id'        	=> 'tcsn_slide_panel_widget_border_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Widgets / Bordered List - Border Color', 'tcsn_theme'),
						'transparent'	=> true,
                        'default'   	=> '#ffffff',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_slide_panel_social_widget_color',
                        'type'      	=> 'color',
						'output'    	=> array('#slide-top .social li i'),
                        'title'     	=> __('Social Network Widget - Icons Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#ffffff',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'	=> 'tcsn-footer-widget-field',
                        'type'	=> 'info',
						'style' => 'warning',
                        'desc'	=> __("Settings for Footer Widgets", 'tcsn_theme')
                    ),
					array(
                        'id'        	=> 'tcsn_footer_widget_border_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Widgets / Bordered List - Border Color', 'tcsn_theme'),
						'transparent'	=> true,
                        'default'   	=> '#545454',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_footer_social_widget_color',
                        'type'      	=> 'color',
						'output'    	=> array('#footer .social li i'),
                        'title'     	=> __('Social Network Widget - Icons Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#b8b8b8',
                        'validate'  	=> 'color',
                    ),
				),
            );  

			// Theme Colors
            $this->sections[] = array(
                'title'     => __('Theme Base Colors', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'        	=> 'tcsn_theme_base_color',
                        'type'      	=> 'color',
						'transparent'	=> false,
                        'output'    	=> array('.color', '.link-underline', '.filter_nav li a:hover', '.filter_nav li .active', '.widget-email', '.widget-email a', '#footer .widget-email', '#footer .widget-email a', '.widget-phone', '.pf-quote .quote-source', '.pf-link-source','.custom-tagcloud a:hover'),
                        'title'     	=> '',
                        'subtitle'  	=> '',
                        'default'   	=> '#ce0027',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'	=> 'tcsn-theme-base-color',
                        'type'	=> 'info',
			            'desc'	=> __('Other suggested - Theme Base Colors. <br> Try these by pasting color values above.', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_color_orange',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'orange',
                        'title'     => __('#ce3f00', 'tcsn_theme'),
                        'desc'      => '',
                    ),
					array(
                        'id'        => 'tcsn_color_cyan',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'cyan',
                        'title'     => __('#00a5ce', 'tcsn_theme'),
                        'desc'      => '',
                    ),
					array(
                        'id'        => 'tcsn_color_blue',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'blue',
                        'title'     => __('#0061ce', 'tcsn_theme'),
                        'desc'      => '',
                    ),
					array(
                        'id'        => 'tcsn_color_green',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'green',
                        'title'     => __('#74ce00', 'tcsn_theme'),
                        'desc'      => '',
                    ),
                ),
            );  
			
			// Body
            $this->sections[] = array(
                'title'     => __('Body / Others', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'	=> 'tcsn-body-field',
                        'type'	=> 'info',
			            'desc'	=> __('Body', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_body_background',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Body Background', 'tcsn_theme'),
                       	'default'	=> array(
        					'background-color' => '#ffffff',
    					),
                    ),
					array(
                        'id'	=> 'tcsn-sidebar-field',
                        'type'	=> 'info',
			            'desc'	=> __('Sidebar', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_sidebar_padding',
                        'type'          => 'spacing',
                        'output'        => array('.pad-top-none .sidebar'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => false,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Padding top to Sidebar', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.', 'tcsn_theme'),
                        'default'       => array(
                            'padding-top'		=> '60', 
                        )
                    ),
                ),
            );  
			
			// Header
            $this->sections[] = array(
                'icon'      => 'el-icon-cog',
                'title'     => __('Header Section', 'tcsn_theme'),
                'desc'      => '',
                'fields'	=> array(
                    array(
                        'id'	=> 'tcsn-header-layout-field',
                        'type'	=> 'info',
			            'desc'	=> __('Select a Header Layout', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_layout_header',
                        'type'      => 'image_select',
                        'title'     => '',
                        'subtitle'	=> '',
                        'desc'      => '',
                        'options'   => array(
                            'v1'	=> array( 'alt' => 'Header 1', 'img' => get_template_directory_uri() . "/includes/img/header1.jpg" ),
                            'v2'	=> array( 'alt' => 'Header 2', 'img' => get_template_directory_uri() . "/includes/img/header2.jpg" ),
                        ), 
                        'default'	=> 'v1'
                    ),
					array(
                        'id'	=> 'tcsn-select-headeritem-field',
                        'type'	=> 'info',
			            'desc'	=> __('Enable / Disable / Select Elements', 'tcsn_theme')
                    ),
					array(
                        'id'       => 'tcsn_header_sticky',
						'type'     => 'switch',
						'title'    => __('Sticky Header', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'	=> 'tcsn-headeritem-info-field',
                        'type'	=> 'info',
						 'style' => 'success',
						'notice'    => true,
                        'desc'	=> __("These will work according to header layout selected.", 'tcsn_theme')
                    ),
					array(
                        'id'       => 'tcsn_show_slide_panel',
						'type'     => 'switch',
						'title'    => __('Show Slide Panel', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'       => 'tcsn_show_topbar',
						'type'     => 'switch',
						'title'    => __('Show Topbar', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'       => 'tcsn_show_topbar_social',
						'type'     => 'switch',
						'title'    => __('Social in Topbar', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'       => 'tcsn_show_topbar_search',
						'type'     => 'switch',
						'title'    => __('Search in Topbar', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'        => 'tcsn_select_topbar_info',
                        'type'      => 'select',
                        'title'     => __('Topbar Text Area : Links or Text', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => __('If Text, enter text below.<br> If links, secondary menu will be displayed.', 'tcsn_theme'),
                        'options'   => array(
                            'tcsn_links'	=> 'Links', 
                            'tcsn_text'		=> 'Text'
                        ),
                        'default'   => 'tcsn_links'
                    ),
					array(
                        'id'        => 'tcsn_text_topbar_info',
                        'type'      => 'textarea',
                        'title'     => '',
                        'subtitle'  => __('Enter text for topbar text area here. HTML is allowed.', 'tcsn_theme'),
						'default'   => 'This is a Tagline',
                    ),
                ),
            );      
					
			// Topbar
            $this->sections[] = array(
                'icon'      => 'el-icon-cog',
                'title'     => __('Topbar', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'fields'	=> array(
					array(
                        'id'        => 'tcsn_topbar_background',
                        'type'      => 'background',
                        'output'    => array('#topbar'),
                        'title'     => __('Background', 'tcsn_theme'),
						'default'	=> array(
        					'background-color' => '#060606',
    					),
                    ),
					array(
                        'id'            => 'tcsn_topbar_padding',
                        'type'          => 'spacing',
                        'output'        => array('#topbar'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Padding (top & bottom)', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.', 'tcsn_theme'),
                        'default'       => array(
                            'padding-top'		=> '10', 
							'padding-bottom'	=> '10', 
                        )
                    ),
					array(
                        'id'       => 'tcsn_topbar_border_bottom',
						'type'     => 'switch',
						'title'    => __('Border Bottom', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => false,
                    ),
					array(
                        'id'        	=> 'tcsn_topbar_border_bottom_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Border Bottom Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '',
                        'validate'  	=> 'color',
                    ),
                ),
            );
			
			// Header
            $this->sections[] = array(
                'icon'      => 'el-icon-cog',
                'title'     => __('Header', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'fields'	=> array(
					array(
                        'id'        => 'tcsn_header_background',
                        'type'      => 'background',
                        'output'    => array('#header'),
                        'title'     => __('Background', 'tcsn_theme'),
                        'default'	=> array(
        					'background-color' => '#ffffff',
    					),
                    ),
					
					array(
                        'id'            => 'tcsn_header_padding',
                        'type'          => 'spacing',
                        'output'        => array('#header'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Padding (top & bottom)', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.', 'tcsn_theme'),
                        'default'       => array(
                            'padding-top'		=> '30', 
							'padding-bottom'	=> '30', 
                        )
                    ),
					array(
                        'id'       => 'tcsn_header_border_bottom',
						'type'     => 'switch',
						'title'    => __('Border Bottom', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'        	=> 'tcsn_header_border_bottom_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Border Bottom Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#e0e0e0',
                        'validate'  	=> 'color',
                    ),
                ),
            );
			
			// Logo, menu
            $this->sections[] = array(
                'icon'      => 'el-icon-cog',
                'title'     => __('Logo & Menu', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'fields'	=> array(
					
					array(
                        'id'	=> 'tcsn-logo-field',
                        'type'	=> 'info',
                        'desc'	=> __("Logo", 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_logo_type',
                        'type'      => 'image_select',
                        'title'     => 'Select Logo Type',
                        'subtitle'	=> '',
                        'desc'      => __('If Image Logo : Upload logo image using field below. <br/><br/> If text logo : Provide text using field below.', 'tcsn_theme'),
                        'options'   => array(
                            'tcsn_show_image_logo'	=> array( 'alt' => 'Image Logo', 'img' => get_template_directory_uri() . "/includes/img/image-logo.png" ),
                            'tcsn_show_text_logo'	=> array( 'alt' => 'Text Logo', 'img' => get_template_directory_uri() . "/includes/img/text-logo.png" ),
                        ), 
                        'default'	=> 'tcsn_show_image_logo'
                    ),
					array(
                        'id'        => 'tcsn_image_standard_logo',
                        'type'		=> 'media',
                        'title'     => __('If Image Logo', 'tcsn_theme'),
                        'desc'      => '',
                        'subtitle'	=> __('Upload logo.', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                    ),
				   array(
                        'id'        => 'tcsn_text_logo',
                        'type'      => 'text',
                        'title'     => __('If Text Logo', 'tcsn_theme'),
						'subtitle'     => __('Enter text for logo and set font below.', 'tcsn_theme'),
                        'desc'      => '',
                        'default'   => 'Mylogo',
                    ),
				   array(
                        'id'        	=> 'tcsn_font_logo',
                        'type'      	=> 'typography',
						'output'    	=> array('.logo a'), 
                        'title'     	=> '',
                        'subtitle'  	=> __('Set font for logo text.', 'tcsn_theme'),
                        'google'    	=> true,
						'subsets'		=> true, 
						'color'         => false,
						'text-align'	=> false,
                        'default'   => array(
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),
                    ),
					array(
                        'id'        => 'tcsn_link_menu',
                        'type'      => 'link_color',
						'output'        => array('.logo a'), 
                        'desc'      => __('Set font color and hover color for logo text.', 'tcsn_theme'),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                        'default'   => array(
                            'regular'   => '#ffffff',
                            'hover'     => '#ffffff',
                        )
                    ),
					array(
                        'id'	=> 'tcsn_retina-logo-field',
                        'type'	=> 'info',
						'style' => 'warning',
                        'desc'	=> __("Retina Logo (Optional)", 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_image_retina_logo',
                        'type'		=> 'media',
						'url'		=> true,
                        'title'     => __('For Retina Image Logo', 'tcsn_theme'),
                        'desc'      => '',
                        'subtitle'	=> __('Upload logo.', 'tcsn_theme'),
						'default'	=> array( 'url' => get_template_directory_uri() . '/img/logo@2x.png' ),
                    ),
					array(
                        'id'                => 'tcsn_retina_logo_dimensions',
                        'type'              => 'dimensions',
						'output'        	=> array('.logo .logo-retina'), 
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'	=> 'false',  // Allow users to select any type of unit
                        'title'             => __('Retina Logo Dimensions (Width/Height)', 'tcsn_theme'),
                        'subtitle'          => '',
                        'desc'              => __('Enter width / height of logo for retina device. <br>It should be the width of normal / standard logo, not the retina logo.', 'tcsn_theme'),
						'default'           => array(
                            'width'     => 132, 
                            'height'    => 36,
                        ),
                    ),
					array(
                        'id'	=> 'tcsn-sticky-logo-field',
                        'type'	=> 'info',
						'style' => 'warning',
                        'desc'	=> __("Sticky Header Logo", 'tcsn_theme')
                    ),
					array(
                        'id'                => 'tcsn_sticky_logo_dimensions',
                        'type'              => 'dimensions',
						'height'            => false,  
						'output'        	=> array('.is-sticky #header .logo img'), 
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'	=> 'false',  // Allow users to select any type of unit
                        'title'             => __('Sticky header Logo Width. <br>Height will be taken accordingly.', 'tcsn_theme'),
                        'subtitle'          => '',
                        'desc'              => __('No need of unit. It will be in px.', 'tcsn_theme'),
						'default'           => array(
                            'width'     => 100, 
                        ),
                    ),
					array(
                        'id'	=> 'tcsn-menu-field',
                        'type'	=> 'info',
                        'desc'	=> __('Menu', 'tcsn_theme')
                    ),
					array(
                        'id'            => 'tcsn_menu_margin',
                        'type'          => 'spacing',
                        'output'        => array('.menu-wrapper'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => false,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Margin Top to Menu', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.', 'tcsn_theme'),
                        'default'       => array(
                            // 'margin-top'    => '', 
                        )
                    ),
                ),
            );

			// Page header
            $this->sections[] = array(
                'title'     => __('Page Header', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'icon'      => 'el-icon-cog',
                'fields'    => array(
				    array(
                        'id'       => 'tcsn_show_page_header',
						'type'     => 'switch',
						'title'    => __('Show Page Header', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'        => 'tcsn_page_header_background',
                        'type'      => 'background',
                        'output'    => array('#page-header'),
                        'title'     => __('Background', 'tcsn_theme'),
                        'default'	=> array(
        					'background-color' => '#f4f4f4',
    					),
        
                    ),
					array(
                        'id'            => 'tcsn_page_header_padding',
                        'type'          => 'spacing',
                        'output'        => array('#page-header'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Padding (top & bottom)', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.', 'tcsn_theme'),
                        'default'       => array(
                            'padding-top'		=> '20', 
							'padding-bottom'	=> '20', 
                        )
                    ),
					array(
                        'id'       => 'tcsn_page_header_border_bottom',
						'type'     => 'switch',
						'title'    => __('Border Bottom', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'        	=> 'tcsn_page_header_border_bottom_color',
                        'type'      	=> 'color',
                        'title'     	=> __('Border Bottom Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#e0e0e0',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'       => 'tcsn_show_breadcrumb',
						'type'     => 'switch',
						'title'    => __('Breadcrumb', 'tcsn_theme'),
						'default'  => true,
                    ),
                ),
            );   
			  
			// Slide Panel
            $this->sections[] = array(
                'title'     => __('Slide Panel', 'tcsn_theme'),
                'desc'      => '',
				'subsection' => true,
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					 array(
                        'id'        => 'tcsn_columns_slide_panel',
                        'type'      => 'image_select',
                        'title'     => __('Number of Columns', 'tcsn_theme'),
                        'subtitle'	=> '',
                        'desc'      => __('Select number of columns. <br> Then add widgets to these columns: Appearance > Widgets', 'tcsn_theme'),
                        'options'   => array(
                            '1'	=> array( 'alt' => 'One Column', 'img' 		=> get_template_directory_uri() . "/includes/img/col1.png" ),
							'2'	=> array( 'alt' => 'Two Columns', 'img'		=> get_template_directory_uri() . "/includes/img/col2.png" ),
							'3'	=> array( 'alt' => 'Three Columns', 'img'	=> get_template_directory_uri() . "/includes/img/col3.png" ),
							'4'	=> array( 'alt' => 'Four Columns', 'img'	=> get_template_directory_uri() . "/includes/img/col4.png" ),
                        ), 
                        'default'	=> '3'
                    ),
					array(
                        'id'        	=> 'tcsn_slide_panel_background',
                        'type'      	=> 'color',
                        'title'     	=> __('Background Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#74ce00',
                        'validate'  	=> 'color',
                    ),
					array(
                        'id'        	=> 'tcsn_slide_panel_btn_background',
                        'type'      	=> 'color',
                        'title'     	=> __('Slide panel Button Background Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#74ce00',
                        'validate'  	=> 'color',
                    ),
                ),
            );             

			// Footer
            $this->sections[] = array(
                'title'     => __('Footer', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                   array(
                        'id'        => 'tcsn_columns_footer',
                        'type'      => 'image_select',
                        'title'     => __('Number of Columns', 'tcsn_theme'),
                        'subtitle'	=> '',
                        'desc'      => __('Select number of columns. <br> Then add widgets to these columns: Appearance > Widgets', 'tcsn_theme'),
                        'options'   => array(
                            '1'	=> array( 'alt' => 'One Column', 'img' 		=> get_template_directory_uri() . "/includes/img/col1.png" ),
							'2'	=> array( 'alt' => 'Two Columns', 'img'		=> get_template_directory_uri() . "/includes/img/col2.png" ),
							'3'	=> array( 'alt' => 'Three Columns', 'img'	=> get_template_directory_uri() . "/includes/img/col3.png" ),
							'4'	=> array( 'alt' => 'Four Columns', 'img'	=> get_template_directory_uri() . "/includes/img/col4.png" ),
                        ), 
                        'default'	=> '3'
                    ),
					array(
                        'id'        => 'tcsn_footer_background',
                        'type'      => 'background',
                        'output'    => array('#footer'),
                        'title'     => __('Background', 'tcsn_theme'),
                        'default'	=> array(
        					'background-color' => '#0d0d0d',
    					),
                
                    ),
					array(
                        'id'            => 'tcsn_footer_padding',
                        'type'          => 'spacing',
                        'output'        => array('#footer'), // An array of CSS selectors to apply this font style to
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'all'           => false,        // Have one field that applies to all
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'units_extended'    => 'false',  // Allow users to select any type of unit
                        'display_units' => 'true',   // Set to false to hide the units if the units are specified
                        'title'         => __('Padding (top & bottom)', 'tcsn_theme'),
                        'subtitle'      => '',
                        'desc'          => __('No need of unit. It will be in px.<br> Default : Top: 60, Bottom: 30', 'tcsn_theme'),
                        'default'       => array(
                            'padding-top'		=> '60', 
							'padding-bottom'	=> '30', 
                        )
                    ),
					array(
                        'id'	=> 'tcsn-take-top-field',
                        'type'	=> 'info',
                        'desc'	=> __('Take to Top Arrow Above Footer', 'tcsn_theme')
                    ),
					array(
                        'id'       => 'tcsn_show_take_top',
						'type'     => 'switch',
						'title'    => __('Show Take to Top Arrow Section', 'tcsn_theme'),
						'subtitle' => '',
						'default'  => true,
                    ),
					array(
                        'id'        	=> 'tcsn_take_top_background',
                        'type'      	=> 'color',
                        'title'     	=> __('Background Color', 'tcsn_theme'),
						'transparent'	=> false,
                        'default'   	=> '#000000',
                        'validate'  	=> 'color',
                    ),
                ),
            );   
			
			// Blog
            $this->sections[] = array(
                'title'     => __('Blog', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'        => 'tcsn_blog_title',
                        'type'      => 'text',
                        'title'     => __('Blog Page Title', 'tcsn_theme'),
                        'validate'  => '',
                        'default'   => 'Blogpost',
                    ),
					array(
                        'id'	=> 'tcsn-archive-field',
                        'type'	=> 'info',
                        'desc'	=> __('Archives', 'tcsn_theme')
                    ),
				    array(
                        'id'        => 'tcsn_blog_layout',
                        'type'      => 'select',
                        'title'     => __('Select Archives Layout.', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'options'   => array(
                            'tcsn-full-width'	=> 'Full Width', 
							'tcsn-with-sidebar'	=> 'With Sidebar',
                        ),
                        'default'   => 'tcsn-with-sidebar'
                    ),
					array(
                        'id'        => 'tcsn_blog_sidebar',
                        'type'      => 'select',
                        'title'     => __('Sidebar Position', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => __('Select archives sidebar position.', 'tcsn_theme'),
                        'options'   => array(
                            'tcsn-sidebar-left'	=> 'Sidebar Left', 
							'tcsn-sidebar-right'	=> 'Sidebar Right',
                        ),
                        'default'   => 'tcsn-sidebar-right'
                    ),
					array(
                        'id'	=> 'tcsn-single-post-field',
                        'type'	=> 'info',
                        'desc'	=> __('Single Post', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_single_post_layout',
                        'type'      => 'select',
                        'title'     => __('Select Layout.', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => '',
                        'options'   => array(
                            'tcsn-single-full-width'   => 'Full Width', 
							'tcsn-single-with-sidebar' => 'With Sidebar',
                        ),
                        'default'   => 'tcsn-single-with-sidebar'
                    ),
					array(
                        'id'        => 'tcsn_single_post_sidebar',
                        'type'      => 'select',
                        'title'     => __('Sidebar Position', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => __('Select sidebar position.', 'tcsn_theme'),
                        'options'   => array(
                            'tcsn-single-sidebar-left'  => 'Sidebar Left', 
							'tcsn-single-sidebar-right' => 'Sidebar Right',
                        ),
                        'default'   => 'tcsn-single-sidebar-right'
                    ),
                ),
            );  
			
			// Portfolio
            $this->sections[] = array(
                'title'     => __('Portfolio', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'	=> 'tcsn-portfolio-grid',
                        'type'	=> 'info',
                        'desc'	=> __('Portfolio Grid Pages (2,3,4 columns)', 'tcsn_theme')
                    ),
					array(
                        'id'        => 'tcsn_portfolio_items_per_page',
                        'type'      => 'text',
                        'title'     => __('Portfolio items per page', 'tcsn_theme'),
                        'desc'      => __('Specify the number of portfolio items to display per page.', 'tcsn_theme'),
                        'validate'  => '',
                        'default'   => '9',
                    ),
					array(
                        'id'        => 'tcsn_portfolio_sort',
                        'type'      => 'select',
                        'title'     => __('Sort Portfolio Items', 'tcsn_theme'),
                        'subtitle'  => '',
                        'options'   => array(
                            'date'  => 'By Date', 
							'rand' 	=> 'Random', 
							'title'	=> 'By Title', 
                        ),
                        'default'   => 'date'
                    ),
					array(
                        'id'        => 'tcsn_portfolio_arrange',
                        'type'      => 'select',
                        'title'     => __('Arrange Sorted Portfolio Items', 'tcsn_theme'),
                        'subtitle'  => '',
                        'desc'      => __('For more flxible re-ordering, refer help document for recommended plugin', 'tcsn_theme'),
                        'options'   => array(
                            'DESC'	=> 'Descending', 
							'ASC'	=> 'Ascending',
                        ),
                        'default'   => 'DESC'
                    ),
					array(
                        'id'       	=> 'tcsn_portfolio_filter',
						'type'     	=> 'switch',
						'title'    	=> __('Portfolio Filter', 'tcsn_theme'),
						'subtitle'	=> '',
						'default'  	=> true,
                    ),
					array(
                        'id'       	=> 'tcsn_portfolio_heading',
						'type'     	=> 'switch',
						'title'    	=> __('Heading to Portfolio Item', 'tcsn_theme'),
						'subtitle'	=> '',
						'default'  	=> true,
                    ),
					array(
                        'id'       	=> 'tcsn_portfolio_excerpt',
						'type'     	=> 'switch',
						'title'    	=> __(' Excerpt of Portfolio Item', 'tcsn_theme'),
						'subtitle'	=> '',
						'default'  	=> true,
                    ),
					array(
                        'id'        => 'tcsn_portfolio_hover',
                        'type'      => 'select',
                        'title'     => __('Select zoom or link on hover', 'tcsn_theme'),
                        'subtitle'  => '',
                        'options'   => array(
                            'tcsn_zoom'	=> 'Zoom',
							'tcsn_link'  => 'Link',
                        ),
                        'default'   => 'tcsn_zoom'
                    ),
					array(
                        'id'	=> 'tcsn-portfolio-details-page',
                        'type'	=> 'info',
                        'desc'	=> __('Portfolio Details Pages', 'tcsn_theme')
                    ),
					array(
                        'id'       	=> 'tcsn_portfolio_predefined_content',
						'type'     	=> 'switch',
						'title'    	=> __('Predefined content', 'tcsn_theme'),
						'subtitle'	=> '',
						'desc'      => __('Check to enable predefined content on portfolio details page. This includes only image set through featured image.', 'tcsn_theme'),
						'default'  	=> true,
                    ),
                ),
            );  

			// Custom CSS
            $this->sections[] = array(
                'title'     => __('Custom CSS', 'tcsn_theme'),
                'desc'      => '',
                'icon'      => 'el-icon-css',
                'fields'    => array(
				 array(
                        'id'        => 'tcsn_custom_css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'tcsn_theme'),
                        'subtitle'  => __("Paste your CSS Code here. <br><br> ** Always keep backup, in case of accidental 'Reset'. <br><br>Consider using child theme for easy theme update. ", 'tcsn_theme'),
                        'mode'      => 'css',
                        'theme'     => 'chrome', // monokai
                        'desc'      => '',
                        'default'   => ""
                    ),
                ),
            );                
			
		   	// Import - Export
            $this->sections[] = array(
                'title'     => __('Import / Export', 'tcsn_theme'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'tcsn_theme'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'	=> false,
                    ),
                ),
            );                     
            
			// Divider        
            $this->sections[] = array(
                'type'	=> 'divide',
            );
			
			// Theme Information
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'tcsn_theme'),
                'desc'      => '',
                'fields'	=> array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'	=> $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'tcsn_theme'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Help Document', 'tcsn_theme'),
                'content'   => __('<p>Please go through help document for more info. It is included in main zip file you have downloaded. <br><br>Make sure to select option "Main File(s)” while downloading. This contains all files & documentation. <br><br>Find it here : Main zip > help-documents > quezal-help</p>', 'tcsn_theme')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('', 'tcsn_theme');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'tcsn_option',           // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'tcsn_theme'),
                'page_title'        => __('Theme Options', 'tcsn_theme'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'	=> 'AIzaSyBEbirM4qLtbzJzvzsSKwfLvPtcMiJWRhw', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.


                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            /*$this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );*/

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('', 'tcsn_theme'), $v);
            } else {
                $this->args['intro_text'] = __('', 'tcsn_theme');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('', 'tcsn_theme');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
