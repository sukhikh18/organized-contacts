<?php
/*
Plugin Name: Контакты (Organized Contacts)
Plugin URI: https://github.com/nikolays93/organized-contacts/
Description: Добавляет возможность управлять контактными данными используя шорткоды.
Version: 2.1.1 alpha
Author: NikolayS93
Author URI: https://vk.com/nikolays_93
Author EMAIL: nikolayS93@ya.ru
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace Contacts;

/**
 * @todo : add archive page
 */
if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

define('CONTACTS_DIR', rtrim(plugin_dir_path( __FILE__ ), '/') );
define('CONTACTS_SLUG', 'contacts' );

add_action( 'plugins_loaded', 'Contacts\Init' );
function Init(){
  require_once CONTACTS_DIR . '/inc/shortcodes.php';

  if( is_admin() ){
    require_once CONTACTS_DIR . '/inc/class-wp-form-render.php';
    require_once CONTACTS_DIR . '/inc/class-wp-post-boxes.php';
  }

  if( $details = get_theme_mod( 'company_details', false ) ){
    require_once CONTACTS_DIR . '/inc/contacts-type.php';

    add_action( 'init', array('Contacts\PostType', 'register_post_type') );

    add_action( 'save_post', array('Contacts\PostType', 'update_theme_mod') );

    add_action( 'load-post.php',     array('Contacts\PostType', 'add_contacts_metabox') );
    add_action( 'load-post-new.php', array('Contacts\PostType', 'add_contacts_metabox') );

    add_action( 'edit_form_after_title', array('Contacts\PostType', 're_order_contacts_metaboxes') );
  }

  require_once CONTACTS_DIR . '/inc/customizer.php';
}
