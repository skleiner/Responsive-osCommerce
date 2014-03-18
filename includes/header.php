<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size('header') > 0) {
    echo '<div class="col-md-12">' . $messageStack->output('header') . '</div>';
  }
?>

<div id="header" class="col-md-12">
  <div class="col-md-6"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.png', STORE_NAME) . '</a>'; ?></div>

  <div class="col-md-6 text-right">
    <div class="btn-group">
<?php
  echo tep_draw_button(HEADER_TITLE_CART_CONTENTS . ($cart->count_contents() > 0 ? ' (' . $cart->count_contents() . ')' : ''), 'glyphicon-shopping-cart', tep_href_link(FILENAME_SHOPPING_CART)) .
       tep_draw_button(HEADER_TITLE_CHECKOUT, 'glyphicon-chevron-right', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) .
       tep_draw_button(HEADER_TITLE_MY_ACCOUNT, 'glyphicon-user', tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));

  if (tep_session_is_registered('customer_id')) {
    echo tep_draw_button(HEADER_TITLE_LOGOFF, 'glyphicon-log-out', tep_href_link(FILENAME_LOGOFF, '', 'SSL'));
  }
?>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<?php echo $breadcrumb->trail(); ?>


<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<div class="alert alert-danger">
  <a href="#" class="close glyphicon glyphicon-remove" data-dismiss="alert"></a>
  <?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['error_message']))); ?>
</div>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<div class="alert alert-info">
  <a href="#" class="close glyphicon glyphicon-remove" data-dismiss="alert"></a>
  <?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['info_message']))); ?>
</div>
<?php
  }
?>
