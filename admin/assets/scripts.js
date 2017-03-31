$(function() {
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	  $('#sidebar').hide('fast', function() {
	  	$('#content').removeClass('span9');
	  	$('#content').addClass('span12');
	  	$('.hide-sidebar').hide();
	  	$('.show-sidebar').show();
	  });
	});

	$('.show-sidebar').click(function() {
		$('#content').removeClass('span12');
	   	$('#content').addClass('span9');
	   	$('.show-sidebar').hide();
	   	$('.hide-sidebar').show();
	  	$('#sidebar').show('fast');
	});
});


$(function() {
    // Bootstrap
    $('#bootstrap-editor').wysihtml5();

// Ckeditor standard
    $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
]});
    $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
});
