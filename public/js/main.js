$(function() {
	$("#navHandle").on("click", function() {
		$(".container nav").slideToggle();
	});
	//ajax bits--------------------------------

	$(".nav-type").on('click', function(e) {
		e.preventDefault();

		var url = $(this).attr('href');

		History.pushState(null, null, url);

	});

	$(".main.group").on('click', '.pagination a', function(e) {
		e.preventDefault();

		var url = $(this).attr('href');

		History.pushState(null, null, url);

	});

	History.Adapter.bind(window, 'statechange', function() {
		var state = History.getState();

		var spinner = new Spinner().spin();
		$('.main.group').append(spinner.el);

		$.get(state.url, function(res) {
			$('.main.group').empty().append(res);
		});

	});

	//Editables -------------------------------

	$('[data-editable]').each(function(i, el) {


		var url = $(el).data("url");
		var options = {
			type: "textarea",
			cssclass: "editable",
			submit: "OK",
			submitdata: {
				_method: "PUT",
				_token: $("#token").text(),
				column: $(el).data("editable")
			}

		};
		$(el).editable(url, options);

	});

	//WYSIWYG-----------------------------------

	$(document).on("DOMNodeInserted", function(e) {

		if ($(e.target).hasClass('editable')) {

			tinymce.editors = []; //removing existing references

			tinymce.init({
				selector: '.editable textarea'
			});

		}
	});
	//WYSIWYG-----------------------------------

	// Disable auto discover for all elements:
	Dropzone.autoDiscover = false;

	Dropzone.options.imageUpload = {
		paramName: "photo", // The name that will be used to transfer the file
		maxFilesize: 2, // MB
		parallelUploads: 1,
		uploadMultiple: false,
		acceptedFiles: ".jpg",
		accept: function(file, done) {
			//front end validation
			done();
		},
		sending: function(file, xhr, formData) {
			// Will send the filesize along with the file as POST data.
			formData.append("_token", $('#token').text());
		},
		init: function() {
			this.on("complete", function(file) {
				// do whatever on complete
			});

			this.on("success", function(file, response) {
				console.log(response);
				$("img#photo").attr('src', $('#public').text() + '/uploads/' + response);
			});
		}
	};

	//Dropzone
	var myDropzone = new Dropzone("#image-upload", {
		url: $('#public').text() + "/photos"
	});



});