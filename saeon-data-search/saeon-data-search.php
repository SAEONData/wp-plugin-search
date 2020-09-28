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




/* Recent Posts Shortcocde */
function saeon_data_search()
 {
  global $post;

  $html = "<div class='sn-row sn-news-block'>";

//   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
//   <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>

//   </svg>
        $html .= "<div class='sn-wrapper'>";
        $html .= "test";
        $html .= "</div>";

    $html .= "</div>";
  return $html;
 }
 add_shortcode( 'saeon-data-search', 'saeon_data_search' );

/* Include files */
function p_support_files() {
    wp_register_style('p_support_files', plugins_url('style.css',__FILE__ ));
    wp_enqueue_style('p_support_files');
    // wp_register_script( 'p_support_files', plugins_url('your_script.js',__FILE__ ));
    // wp_enqueue_script('p_support_files');
}

add_action( 'wp_enqueue_scripts','p_support_files'); //admin_init instead of wp_
/* Admin area */
 function saeon_data_search_admin_menu()
{
    add_menu_page('SAEON Data Search','Data Search','manage_options','saeon-data-search-admin-menu','saeon_data_search_scripts_page',plugins_url('saeon-data-search/img/admin-icon.png'),6);
}

add_action('admin_menu','saeon_data_search_admin_menu');

/* Admin Scripts Page */
function saeon_data_search_scripts_page()
{
    ?>
    <div class="wrap">
        <h2>SAEON Data Search Shortcode</h2>
        <p>Paste the following shortcode on any page to display data search</p>
        <p style="border: 1px solid #ccd0d4;background: #fff;padding: 10px 20px;font-size: 16px;display: inline-block;">[saeon-data-search]</p>
    </div>

    <?php
}
 ?>