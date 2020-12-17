<?php
/**
 * Plugin Name: SAEON Data Search
 * Description: Use a shortcode to display data search field for the SAEON ODP Catalog of South African Environmental Data
 * Author: SAEON
 * Author URI: https://ulwazi.saeon.ac.za
 * Version: 1.0.0
 * Requires at least: 5.2
 * Tested up to: 5.5.1
 * Requires PHP: 7.2
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: saeon-data-search
 */

global $post;


/* Recent Posts Shortcocde */

// Create shortcode attributes with default values
function saeon_data_search($atts){
  extract(shortcode_atts( array(

    'placeholder' => 'Search Data',
    'border' => '1px solid #ccc',
    'borderradius' => '0px',
    'background' => 'transparent',
    'iconcolor' => '#000',
    'inputheight' => 'initial',
    'inputpadding' => '0 20px 0 45px',
    'iframe' => 'false',
    'minheight' => '800px',
    'resultsonly' => 'false',
    'allowsearch' => 'true',
    'textcolor' => 'initial',
    'placeholdercolor' => 'initial',
    'formwidth' => 'initial'

  ), $atts

));

// Render HTML where shortcode loads
$html = "<form class='sn-ds-form' style='width:{$formwidth}'>";
$html .= "<input type='text' class='ds-datasearch' placeholder='{$placeholder}' style='border:{$border};color:{$textcolor};border-radius:{$borderradius};background:{$background};height:{$inputheight};padding:{$inputpadding}'>";
$html .= "<button class='ds-btn-search' type='submit'>";
$html .= "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='s_search' x='0px' ";
$html .= "y='0px' viewBox='0 0 56.966 56.966' style='enable-background:new 0 0 56.966 56.966;' xml:space='preserve'>";
$html .= "<path style='fill:{$iconcolor};' d='M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  ";
$html .= "s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  ";
$html .= "c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  ";
$html .= "s-17-7.626-17-17S14.61,6,23.984,6z'/></svg></button>";
$html .= "</form><style> .ds-datasearch::placeholder ";
$html .= "{ color: {$placeholdercolor}!important; } </style>";
    if($iframe=='true'){ // attribute for loading iframe option
        $html .= "<iframe id='sn-ds-iframe' src='https://catalogue.saeon.ac.za/render/records' style='min-height:{$minheight};display:none' /></iframe>";
    };
    if($resultsonly=='true'){ // attribute for loading results only option
        $html .= "<input type='hidden' id='sn-ds-resultsonly' style='display:none' />";
    };
    if($allowsearch=='false'){ // attribute for further search inside results listing
        $html .= "<input type='hidden' id='sn-ds-allowsearch' style='display:none' />";
    };

return $html;
}
add_shortcode( 'saeon-data-search', 'saeon_data_search' );

// Shortcode to render results on the page in another location
function saeon_data_search_results(){
     ?>
     <div id="saeon-data-search-resuts"></div>
     <?php
}
add_shortcode( 'saeon-data-search-resuts', 'saeon_data_search_results' );


/* Include supporting CSS and JS files */
function data_support_files() {
    wp_enqueue_style( 'test', plugins_url('style.css',__FILE__ ) );     
    wp_enqueue_script( 'tester', plugins_url('script.js',__FILE__ ), array( 'jquery' ),'',true ); 
}

add_action( 'wp_enqueue_scripts','data_support_files');

/* Admin area */
// Add to admin menu
function saeon_data_search_admin_menu()
{
    add_menu_page('SAEON Data Search','Data Search','manage_options','saeon-data-search-admin-menu','saeon_data_search_scripts_page',plugins_url('saeon-data-search/img/admin-icon.png'),6);
}
add_action('admin_menu','saeon_data_search_admin_menu');

/* Admin Scripts Page */
function saeon_data_search_scripts_page()
{
    ?>
    <!-- The admin page content -->
    <style>
        .sn-ds-table{
            width: 100%;
            border: 1px solid #ccd0d4;
            background: #fff;
        }
        .sn-ds-table td{
            vertical-align:top;
            padding:10px;
        }
        .sn-ds-cell-dark{
            background: #ccd0d4;
        }
        .sn-ds-block{
            border: 1px solid #ccd0d4;
            background: #fff;
            padding: 10px 20px;
            font-size: 16px;
            display: inline-block;
            margin-right:10px;
        }
    </style>
    <div class="wrap">
        <h2>SAEON Data Search Shortcode</h2>
        <p>Paste the following shortcode on any page to display data search</p>
        <p><div class="sn-ds-block">[saeon-data-search]</div>
        </p>
        <br /><strong>Shortcode Variables:</strong>
        <table class="sn-ds-table">
        <tr>
        <td>
        <h3>Styling attributes:</h3><br/>
        <ul>
            <li><strong>placeholder="" </strong><em>e.g. "Search Data"</em></li>
            <li><strong>border="" </strong><em>e.g. "1px solid #ccc"</em></li>
            <li><strong>borderradius="" </strong><em>e.g. "0px"</em></li>
            <li><strong>background="" </strong><em>e.g. "transparent"</em></li>
            <li><strong>iconcolor="" </strong><em>e.g. "#000"</em></li>
            <li><strong>inputheight="" </strong><em>e.g. "initial"</em></li>
            <li><strong>inputpadding="" </strong><em>e.g. "0 20px 0 45px"</em></li>
            <li><strong>minheight="" </strong><em>e.g. "800px"</em></li>
            <li><strong>textcolor="" </strong><em>e.g. "#fff"</em></li>
            <li><strong>placeholdercolor="" </strong><em>e.g. "#fff"</em></li>
            <li><strong>formwidth="" </strong><em>e.g. "100%"</em></li>
        </ul>
        </td>
        <td>
        <h3>Functionality attributes: (true/false)</h3><br/>
        <ul>
            <li><strong>iframe="" </strong><em>e.g. "true"</em>use shortcode <strong>[saeon-data-search-resuts]</strong> if you want to place iframe results in another location on the page</li>
            <li><strong>resultsonly="" </strong><em>e.g. "true"</em></li>
            <li><strong>allowsearch="" </strong><em>e.g. "false"</em></li>
        </ul>
        </td>
        </tr>
        <tr class="sn-ds-cell-dark"><td colspan="2">example of added variables:<br/>[saeon-data-search placeholder="Search Data" border="1px solid #ccc" background="transparent" iconcolor"#000"]</td></tr>
        </table>

        </form>
    </div>

    <?php
}
 ?>