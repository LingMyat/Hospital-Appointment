$(function() {
	'use strict';

  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

    let arr = [$('#name_input'),$('#email_or_phone_input')]

    arr.forEach(element => {
        if (element.val()!= "") {
            var $field = element.closest('.form-group');
            $field.addClass('field--not-empty');
        }
    });

});
