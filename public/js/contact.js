
// CONTACT FORM - SINGLE LOCATION
$(function() {
	
	// Validate the contact form
  $('#contact-form').validate({
  	// Specify what the errors should look like
  	// when they are dynamically added to the form
  	errorElement: "label",
  	wrapper: "div",
  	errorPlacement: function(error, element) {
  		error.insertAfter(element);
  		error.wrap("<div class='error-msg'></div>");
  	},
  	
  	// Add requirements to each of the fields
  	rules: {
  		name: {
  			required: true,
  			minlength: 3
  		},
  		email: {
  			required: true,
  			email: true
  		},
  		website: {
  			minlength: 10
  		},
  		message: {
  			required: true,
  			minlength: 10
  		}
  	},
  	
  	// Specify what error messages to display
  	// when the user does something horrid
  	messages: {
  		name: {
  			required: "Please enter your name.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
  		email: {
  			required: "Please enter your email.",
  			email: "Please enter a valid email."
  		},
  		message: {
  			required: "Please enter a message.",
  			minlength: jQuery.format("At least {0} characters required.")
  		}
  	},
  	
  	// Use Ajax to send everything to processForm.php
  	submitHandler: function(form) {
  		$("#send").text("Sending...");
  		$(form).ajaxSubmit({
  			success: function(responseText, statusText, xhr, $form) {
  				$(form).slideUp("fast");
  				$("#response").html(responseText).hide().slideDown("fast");
  			}
  		});
  		return false;
  	}
  });
});


// CONTACT FORM - MULTI LOCATION
$(function() {
	
	// Validate the subscribe form
  	$('#contact-multi').validate({
  	// Specify what the errors should look like
  	// when they are dynamically added to the form
  	errorElement: "label",
  	wrapper: "div",
  	errorPlacement: function(error, element) {
  		error.insertAfter(element);
  		error.wrap("<div class='error-msg'></div>");
  	},
  	
  	// Add requirements to each of the fields
  	rules: {
  		firstname: {
  			required: true,
  			minlength: 2
  		},
  		lastname: {
  			required: true,
  			minlength: 2
  		},
  		email: {
  			required: true,
  			email: true
  		},
  		message: {
  			required: true,
  			minlength: 10
  		}
  	},
  	
  	// Specify what error messages to display
  	// when the user does something horrid
  	messages: {
  		firstname: {
  			required: "Please enter your frist name.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
		lastname: {
  			required: "Please enter your last name.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
  		email: {
  			required: "Please enter your email.",
  			email: "Please enter a valid email."
  		},
		message: {
  			required: "Please enter your message.",
  			minlength: jQuery.format("At least {0} characters required.")
  		}
  	},
  	
  	// Use Ajax to send everything to processForm.php
  	submitHandler: function(form) {
  		$("#send").text("Sending...");
  		$(form).ajaxSubmit({
  			success: function(responseText, statusText, xhr) {
				$(form).slideUp("fast");
  				$("#response").html(responseText).hide().slideDown("fast");
  			}
  		});
  		return false;
  	}
  });
});