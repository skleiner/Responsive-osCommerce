<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

  class page_selection {
    function __construct() {}
    
    public static function _get_pages($p = '') {
      $pages_array = [];

      foreach (explode(';', $p) as $page) {
        $page = trim($page);

        if (!empty($page)) {
          $pages_array[] = $page;
        }
      }
      
      return $pages_array;
    }

    public static function _show_pages($text) {
      return nl2br(implode("\n", explode(';', $text)));
    }

    public static function _edit_pages($values, $key) {
      global $PHP_SELF;

      $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
      $files_array = [];
      if ($dir = @dir(DIR_FS_CATALOG)) {
        while ($file = $dir->read()) {
          if (!is_dir(DIR_FS_CATALOG . $file)) {
            if (substr($file, strrpos($file, '.')) == $file_extension) {
              $files_array[] = $file;
            }
          }
        }
        sort($files_array);
        $dir->close();
      }

      $values_array = explode(';', $values);

      $output = '';
      foreach ($files_array as $file) {
        $output .= '<br>' . tep_draw_checkbox_field('p_file[]', $file, in_array($file, $values_array)) . '&nbsp;' . tep_output_string($file);
      }
      $output .= '<br>' . tep_draw_checkbox_field('p_all') . '&nbsp;' . TEXT_ALL;

      $output .= tep_draw_hidden_field('configuration[' . $key . ']', '', 'id="p_files"');

      $output .= '<script>
                  function p_update_cfg_value() {
                    var p_selected_files = \'\';

                    if ($(\'input[name="p_file[]"]\').length > 0) {
                      $(\'input[name="p_file[]"]:checked\').each(function() {
                        p_selected_files += $(this).attr(\'value\') + \';\';
                      });

                      if (p_selected_files.length > 0) {
                        p_selected_files = p_selected_files.substring(0, p_selected_files.length - 1);
                      }
                    }

                    $(\'#p_files\').val(p_selected_files);
                  }

                  $(function() {
                    p_update_cfg_value();

                    if ($(\'input[name="p_file[]"]\').length > 0) {
                      $(\'input[name="p_file[]"]\').change(function() {
                        p_update_cfg_value();
                      });
                    }
                  });
                  $(\'input[name="p_all"]\').click(function() {
                  var c = $(\'input[name^="p_file"]\');
                    c.prop(\'checked\', !c.prop(\'checked\'));
                  });
                  </script>';

      return $output;
    }
    
  }