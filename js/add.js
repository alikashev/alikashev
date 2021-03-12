// submit is an action performed ON THE FORM ITSELF...
// probably best to give the form an ID attribute and refer to it by that
$('form').submit( function (event) {
	// prevent the usual form submission behaviour; the "action" attribute of the form
	event.preventDefault();
	// validation goes below...

	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': 'destination.php',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
		},
		// you may change this to GET, if you like...
		'type': 'post',
		// the kind of response that you want from the server
		'dataType': 'html',
		'beforeSend': function () {
			// anything you want to have happen before sending the data to the server...
			// useful for "loading" animations
		}
	})
	.done( function (response) {
		// what you want to happen when an ajax call to the server is successfully completed
		// 'response' is what you get back from the script/server
		// usually you want to format your response and spit it out to the page
	})
	.fail( function (code, status) {
		// what you want to happen if the ajax request fails (404 error, timeout, etc.)
		// 'code' is the numeric code, and 'status' is the text explanation for the error
		// I usually just output some fancy error messages
	})
	.always( function (xhr, status) {
		// what you want to have happen no matter if the response is success or error
		// here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
	});
});