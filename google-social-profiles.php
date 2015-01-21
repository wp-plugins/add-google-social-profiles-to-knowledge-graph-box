<?php
/**
* Plugin Name: Add Google Social Profiles to Knowledge Graph Box
* Plugin URI: http://palfbapps.com/gsp
* Description: Display Your Facebook, Twitter & Other Social Accounts In Its Knowledge Graph Boxes
* Version: 1.0 or whatever version of the plugin (pretty self explanatory)
* Author: Omar Abu Safieh
* Author URI: http://omarnas.com/
* License: GPL12
*/


function setup_theme_plugin_menus() {
    add_menu_page(
        'Google Social Profiles', 'Google Social Profiles', 'manage_options', 
        'Knowledge-Graph-Boxes', 'gsp_page_settings'); 
}

 
// This tells WordPress to call the function named "setup_theme_admin_menus"
// when it's time to create the menu pages.
add_action("admin_menu", "setup_theme_plugin_menus");

function gsp_page_settings() {
//require("themesoptions.php"); 
//echo " i am gere";
require("gsp-options.php");
}

function addgsp(){ 
    if(get_option("gsp_type")){
    	$gspsocial=' "'.get_option("gsp_facebook").'",
      "'.get_option("gsp_instagram").'",
      "'.get_option("gsp_twitter").'",
      "'.get_option("gsp_google").'",
      "'.get_option("gsp_linkedin").'"';
	  $gspsocial=str_replace('""', '', $gspsocial);
	  $gspsocial=str_replace(',,', '', $gspsocial);
echo '

<script type="application/ld+json">
{ "@context" : "http://schema.org",
  "@type" : "'.get_option("gsp_type").'",
  "name" : "'.get_option("gsp_name").'",
  "url" : "'.get_site_url().'",
  "sameAs" : ['.$gspsocial.'] 
}
</script>'."\t\n";
   } 
      }
add_action('wp_head','addgsp');