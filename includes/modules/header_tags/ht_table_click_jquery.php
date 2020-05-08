<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

  class ht_table_click_jquery {
    var $code = 'ht_table_click_jquery';
    var $group = 'footer_scripts';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->title = MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_TITLE;
      $this->description = MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $oscTemplate;

      if (tep_not_null(MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES)) {
        $pages_array = page_selection::_get_pages(MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES);

        if (in_array(basename($PHP_SELF), $pages_array)) {
          $oscTemplate->addBlock('<script>$(\'.table tr.table-selection\').click(function() { $(\'.table tr\').removeClass(\'success\').find(\'input\').prop(\'checked\', false); $(this).addClass(\'success\').find(\'input\').prop(\'checked\', true); });</script>', $this->group);
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Clickable Table Rows Module', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS', 'True', 'Do you want to enable the Clickable Table Rows module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES', 'checkout_payment.php;checkout_shipping.php', 'The pages to add the jQuery Scripts to.', '6', '2', 'page_selection::_show_pages', 'page_selection::_edit_pages(', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return ['MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER'];
    }
  }
  