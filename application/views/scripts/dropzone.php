<script src="<?= site_url('js/dropzone.js') ?>"></script>
<script>
	// dropzone
	var myDropzone = new Dropzone("#newfile", { 
		url: "<?php echo site_url('profile/dropfoto/'.$user->username); ?>",
		maxFilesize: 1, // 1 file alla volta
		acceptedFiles: ".jpg,.png,.gif",
		resizeHeight: 50,
		dictFileTooBig: "Dimensioni file: {{filesize}}MB. Dimensioni massime: {{maxFilesize}}MB",
		dictInvalidFileType: "Solo immagini in formato .jpg",
		previewsContainer: "#picture-preview",
		previewTemplate: document.getElementById('preview-template').innerHTML
	});
	
	myDropzone.on("success", function(file,resp) {
		swal({
		  title: '',
		  html: resp,
		  showConfirmButton:false,
		  timer: 2000,
		  type: 'success'
		});
		setTimeout(function(){ location.reload() }, 2000);
	});
	
	myDropzone.on("error", function(file,resp) {
		swal({title:"", html:resp.responseText, type: "error"});
	});	
</script>
