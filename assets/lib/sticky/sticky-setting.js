/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function(){
   var wpAdminBar = jQuery('#wpadminbar');
   if (wpAdminBar.length) {
      jQuery("#teg-menu-wrap").sticky({topSpacing:wpAdminBar.height()});
   } else {
      jQuery("#teg-menu-wrap").sticky({topSpacing:0});
   }
});