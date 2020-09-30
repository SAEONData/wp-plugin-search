<?php
/**
 * Plugin Name: SAEON Data Search
 * Description: Use a shortcode to display data search field
 * Author: SAEON
 * Author URI: https://wordpress.org/plugins/saeon/
 * Plugin URI: https://wordpress.org/plugins/saeon-data-search/
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: saeon-data-search
 */

global $post;


/* Recent Posts Shortcocde */
function saeon_data_search($atts){
  extract(shortcode_atts( array(

    'placeholder' => 'Search Data',
    'border' => '1px solid #ccc',
    'background' => 'transparent',
    'iconcolor' => '#000',
    'inputheight' => 'initial',
    'inputpadding' => '0 20px 0 45px',
    'iframe' => 'true',
    'minheight' => '800px',

  ), $atts

));

        $html = "<form class='sn-ds-form'>";
        $html .= "<input type='text' class='ds-datasearch' placeholder='{$placeholder}' style='border:{$border};background:{$background};height:{$inputheight};padding:{$inputpadding}'>";
        $html .= "<button class='ds-btn-search' type='submit'>";
        $html .= "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='s_search' x='0px' ";
        $html .= "y='0px' viewBox='0 0 56.966 56.966' style='enable-background:new 0 0 56.966 56.966;' xml:space='preserve'>";
        $html .= "<path style='fill:{$iconcolor};' d='M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  ";
        $html .= "s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  ";
        $html .= "c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  ";
        $html .= "s-17-7.626-17-17S14.61,6,23.984,6z'/></svg></button>";
        $html .= "</form>";
        if($iframe='true'){
            $html .= "<iframe id='sn-ds-iframe' src='https://catalogue.saeon.ac.za/render/records' style='min-height:{$minheight};display:none' /></iframe>";
        }

  return $html;
 }
 add_shortcode( 'saeon-data-search', 'saeon_data_search' );

/* Include files */
function data_support_files() {
    // wp_register_style('data_support_files', plugins_url('style.css',__FILE__ ));
    // wp_enqueue_style('data_support_files');
    // wp_register_script( 'data_js_support_files', plugins_url('script.js',__FILE__ ));
    // wp_enqueue_script('data_jssupport_files');

    wp_enqueue_style( 'test', plugins_url('style.css',__FILE__ ) );     
    wp_enqueue_script( 'tester', plugins_url('script.js',__FILE__ ), array( 'jquery' ),'',true ); 
}

add_action( 'wp_enqueue_scripts','data_support_files'); //admin_init instead of wp_
/* Admin area */
 function saeon_data_search_admin_menu()
{
    add_menu_page('SAEON Data Search','Data Search','manage_options','saeon-data-search-admin-menu','saeon_data_search_scripts_page',plugins_url('saeon-data-search/img/admin-icon.png'),6);
}

add_action('admin_menu','saeon_data_search_admin_menu');

/* Admin Scripts Page */
function saeon_data_search_scripts_page()
{
    /* The stored fields */
    
    if(array_key_exists('submit_scripts_update',$_POST))
    {
        echo'hey';
        update_option('saeon_data_search_sidebar',$_POST['sidebar']);
        update_option('saeon_data_search_iframeload',$_POST['iframeload']);
        update_option('saeon_data_search_filtertags',$_POST['filtertags']);
        ?>
           <div id="setting-error-settings_updated" class="updated settings_error notice is-dismissible">
                <strong>settings have been changed</strong>
            </div>
        <?php
    }
    echo'hey there';


    $sidebar = get_option('saeon_data_search_sidebar','checked');
    $iframeload = get_option('saeon_data_search_iframeload','');
    $filtertags = get_option('saeon_data_search_filtertags','test');

    ?>
    <!-- The admin page content -->
    <div class="wrap">
        <h2>SAEON Data Search Shortcode</h2>
        <p>Paste the following shortcode on any page to display data search</p>
        <p style="border: 1px solid #ccd0d4;background: #fff;padding: 10px 20px;font-size: 16px;display: inline-block;">[saeon-data-search]</p>
        <br /><strong>Shortcode Variables:</strong>
        <ul>
            <li><strong>placeholder="" </strong><em>e.g. "Search Data"</em></li>
            <li><strong>border="" </strong><em>e.g. "1px solid #ccc"</em></li>
            <li><strong>background="" </strong><em>e.g. "transparent"</em></li>
            <li><strong>iconcolor="" </strong><em>e.g. "#000"</em></li>
            <li><strong>inputheight="" </strong><em>e.g. "initial"</em></li>
            <li><strong>inputpadding="" </strong><em>e.g. "0 20px 0 45px"</em></li>
            <li><strong>iframe="" </strong><em>e.g. "true",</em></li>
            <li><strong>minheight="" </strong><em>e.g. "800px"</em></li>
        </ul>
        <p>example of added variables: [saeon-data-search placeholder="Search Data" border="1px solid #ccc" background="transparent" iconcolor"#000"]</p>
        <h2>Add options</h2>
        <form method="post" action="">
        <input type="checkbox" name="iframeload" id="iframeload" <?php print $iframeload; ?>/><label for="iframeload">Show results in same page</label><br  />
        <input type="checkbox" name="sidebar" id="sidebar" <?php print $sidebar; ?> /><label for="sidebar">Show results sidebar</label><br  />
        <label for="filtertags"><input type="text" name="filtertags" value="<?php print $filtertags; ?>" />Filter results by these tags</label><br />
        <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE" />
        <!-- class="large-text"  -->
        </form>
    </div>

    <?php
global $post;
    print_r($_POST);
}
 ?>