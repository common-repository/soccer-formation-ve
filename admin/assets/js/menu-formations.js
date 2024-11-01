jQuery(document).ready(function($) {

  'use strict';

  $('#layout-id').select2();

  $(document.body).on('click', '#cancel' , function(event){

    'use strict';

    //reload the menu
    event.preventDefault();
    window.location.replace(window.DAEXTSFVE_PARAMETERS.admin_url + 'admin.php?page=daextsfve-formations');

  });

  //Dialog Confirm ---------------------------------------------------------------------------------------------------
  window.DAIM = {};
  $(document.body).on('click', '.menu-icon.delete' , function(event){

    'use strict';

    event.preventDefault();
    window.DAIM.autolinkToDelete = $(this).prev().val();
    $('#dialog-confirm').dialog('open');

  });

  /**
   * Dialog confirm initialization.
   */
  $(function() {

    'use strict';

    $('#dialog-confirm').dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 340,
      modal: true,
      buttons: {
        [objectL10n.deleteText]: function() {

          'use strict';

          $('#form-delete-' + window.DAIM.autolinkToDelete).submit();

        },
        [objectL10n.cancelText]: function() {

          'use strict';

          $(this).dialog('close');

        },
      },
    });

  });

});