<?php
    /*
  Plugin Name: wp show category posts
  Plugin URI: http://ajaysharma3085006.wordpress.com/
  Description: shows any category posts  in widget , page  or post, have shortcode [wpscp]
  Version: 0.1
  Author: Ajay Sharma
  Author URI: http://ajaysharma3085006.wordpress.com/
  License: GPLv2 or later
 */
  function wpscp_activation() 
  {
  
    
     add_option( wpscp_nop, '3', '', yes ); 
     add_option( wpscp_mnop, '10', '', yes );
     add_option( wpscp_cat, 'uncategorized', '', yes ); 
     add_option( wpscp_readmore,'Read More', '', yes ); 
     add_option( wpscp_enable,'1', '', yes ); 
     add_option( wpscp_thumbnail_enable,'1','', yes );
     add_option( wpscp_title_enable,'1', '', yes );
     add_option( wpscp_date_enable,'1', '', yes );
     add_option( wpscp_excerpt_enable,'1', '', yes );
     add_option( wpscp_readmore_enable,'1', '', yes );
     add_option( wpscp_c_len,'10', '', yes ); 
    
    }
	register_activation_hook(__FILE__, 'wpscp_activation');
	//deactivation
	
function wpscp_deactivation() 
	{
			
		delete_option( 'wpscp_nop' );
		delete_option( 'wpscp_mnop' );
		delete_option( 'wpscp_cat' );
		delete_option( 'wpscp_readmore' );
		delete_option( 'wpscp_enable' );
		delete_option( 'wpscp_thumbnail_enable' );
		delete_option( 'wpscp_title_enable' );
		delete_option( 'wpscp_date_enable' );
		delete_option( 'wpscp_excerpt_enable' );
		delete_option( 'wpscp_readmore_enable' );
		delete_option( 'wpscp_c_len' );


	}
register_deactivation_hook(__FILE__, 'wpscp_deactivation');
//adding styles
add_action('wp_enqueue_scripts', 'wpscp_styles');
function wpscp_styles() 
	{
		wp_register_style('wpscp_css', plugins_url('css/styles.css', __FILE__));
		wp_enqueue_style('wpscp_css');
    }
// create custom plugin settings menu
add_action('admin_menu', 'wpscp_create_menu');
function wpscp_create_menu() {
 //create new top-level menu
  
  add_menu_page('scroll posts  Plugin Settings', 'wp show category posts', 'administrator', 'wpscps_setting', 'wpscp_settings_page',plugins_url('/images/icon.png', __FILE__));
  
  //call register settings function
  add_action( 'admin_init', 'register_wpscp_settings' );
    
}
  

function register_wpscp_settings() { 

  //register our settings
  register_setting( 'wpscp-settings-group', 'wpscp_nop' );
  register_setting( 'wpscp-settings-group', 'wpscp_mnop' );
  register_setting( 'wpscp-settings-group', 'wpscp_mnop' );
  register_setting( 'wpscp-settings-group', 'wpscp_cat' );
  register_setting( 'wpscp-settings-group', 'wpscp_direction' );
  register_setting( 'wpscp-settings-group', 'wpscp_readmore' );
  register_setting( 'wpscp-settings-group', 'wpscp_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_mousepause' );
  register_setting( 'wpscp-settings-group', 'wpscp_speed' );
  register_setting( 'wpscp-settings-group', 'wpscp_ptime' );
  register_setting( 'wpscp-settings-group', 'wpscp_thumbnail_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_title_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_date_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_excerpt_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_readmore_enable' );
  register_setting( 'wpscp-settings-group', 'wpscp_c_len' );
  //wpscp_thumbnail_enable

}

function wpscp_settings_page() {?><div class="wrap">
<h2>Wp Show Category Posts Default Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'wpscp-settings-group' ); ?>
    <?php do_settings_sections( 'wpscp_settings_page' ); ?>
    <table class="form-table">
    
        <tr valign="top">
        <th scope="row">Enable  Feature image/thumbnail</th>
        <td>
<input type="checkbox" name="wpscp_thumbnail_enable" value="1" <?php checked(get_option('wpscp_thumbnail_enable'), 1); ?> />
                 Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Posts Title</th>
        <td>
<input type="checkbox" name="wpscp_title_enable" value="1" <?php checked(get_option('wpscp_title_enable'), 1); ?> />
  Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Date of posting</th>
        <td>

<input type="checkbox" name="wpscp_date_enable" value="1" <?php checked(get_option('wpscp_date_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Excerpt</th>
        <td>

<input type="checkbox" name="wpscp_excerpt_enable" value="1" <?php checked(get_option('wpscp_excerpt_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Enable  Readmore text</th>
        <td>

<input type="checkbox" name="wpscp_readmore_enable" value="1" <?php checked(get_option('wpscp_readmore_enable'), 1); ?> />

        
         Default: true</td>
        </tr>
        <tr valign="top">
        <th scope="row">Maximum Numbers of posts </th>
        <td><input type="text" name="wpscp_mnop" value="<?php echo get_option('wpscp_mnop'); ?>" />
                
         Default: 10</td>
        </tr>
        
         
        <tr valign="top">
        <th scope="row">category name</th>
        <td><input type="text" name="wpscp_cat" value="<?php echo get_option('wpscp_cat'); ?>" />
                
         Default: uncategorized <br />
         <strong>Note</strong>: If you want to include multiple categories then write names of categories separeted by comma . For example " <strong>news , tips</strong> " where news and tips are names of categories.
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">Excerpt length (in words)(please only numeric) </th>
        <td><input type="text" name="wpscp_c_len" value="<?php echo get_option('wpscp_c_len'); ?>" />
                
         Default: 10 <br />
        
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">Read more Text</th>
        <td><input type="text" name="wpscp_readmore" value="<?php echo get_option('wpscp_readmore'); ?>" />
       
         Default: Read More</td>
        </tr>
        
    </table>
   
    <?php submit_button(); ?></form>
	
	<div > 
	<h3>To show posts from category to your website:- </h3>
	<ul>
	<li> <h4> Method 1</h4> Use short code <code>[wpscp]</code> to your page or post or text widget.</li>
	<li> <h4> Method 2</h4>To use in theme use <code>&lt;?php echo do_shortcode('[wpscp]'); ?&gt;</code> to your template.</li>
	</div>
	
</div>
<?php

 } 
//setting ends here

/*****short code catcher starts here**/
function wpscp_shortcode_catcher( $atts ) {
 extract( shortcode_atts( array(
    'cat' => get_option("wpscp_cat"),
    'nop' => get_option('wpscp_mnop'),
    'exceptlen' => '10',
    'readmoretxt' => 'Read More',
    ), $atts ) );
    ob_start();
  
    add_filter('widget_text', 'do_shortcode'); //to enable shortcode in  text widget
        
       ?>
<!--wp show category posts   out put starts here by ajay sharma-->
  
<div id="wp_show_category_posts" class="wpscp_container">
          <ul>
        <?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => $nop,'category_name'=>$cat, 'paged' => $paged );
query_posts( $args); if ( have_posts($args) ) : while ( have_posts($args) ) : the_post($args); ?>
                <li >                
                  <?php if(get_option('wpscp_thumbnail_enable')==1){?> 
                  <p class="wpscp_img_box"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail('small'); ?>
                  </a></p>
                  <?php } ?>                  
                  <div class="wpscp_detail">
                    
<?php if(get_option('wpscp_title_enable')==1){?> 
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<?php }?>
                    <?php if(get_option('wpscp_date_enable')==1){?> <span><?php echo get_the_date();?></span><?php }?>
                   

                   <?php if(get_option('wpscp_excerpt_enable')==1){?> <p><?php //the_content();
                   
                   $wpscp_ex_len=get_option('wpscp_c_len');
                   
                     if (!is_numeric($wpscp_ex_len)) {
             $wpscp_ex_len=10;
             }
                   $wpscp_content = get_the_content();                   
                                 
$wpscp_trimmed = wp_trim_words( $wpscp_content, $wpscp_ex_len ,$more=null);
$wpscp_rest = substr($wpscp_trimmed, 0, -8); 
echo $wpscp_rest;
                   ?></p><?php }?>

                    
                     <?php if(get_option('wpscp_readmore_enable')==1){?> 
                      <a href="<?php the_permalink(); ?>" class="wpscp_readmore">
                     <?php echo get_option('wpscp_readmore'); ?> </a>
                     <?php }?>
                  </div>
                </li>
                <?php endwhile; endif; wp_reset_query(); ?> 
              </ul>
              
            </div>
                  
<!--wp show category posts  out put ends here by ajay sharma-->

<?php  return ob_get_clean();
     }
add_shortcode( 'wpscp', 'wpscp_shortcode_catcher' );

/*** short code catcher ends here *****/
 ?>