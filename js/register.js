$(document).ready(function() {
  $("#registerform").validate({
    rules: {
      name: 
		{required: true,    // simple rule, converted to {required: true}
			minlength: 5,
			maxlength: 20
		},
	  password: {
		required: true,
		minlength: 5,
		maxlength: 20
      },
      email: {             // compound rule
      required: true,
      email: true 
      },
    },
	 highlight: function(element) {
    $(element).closest('.control-group').removeClass('success').addClass('error');
  },
  success: function(element) {
    element
	.text('OK!').addClass('valid')
	.closest('.control-group').removeClass('error').addClass('success');
  }
  });
});
