var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  init:function() {
    this.on('successmultiple',function(files,response) {
        if(response.status === 'Success') {
          alertify.success(response.message);
          Array.prototype.forEach.call(response.galleries,function(instance){
            displayImage(instance);
          })
        }else {
          alertify.error(response.message);
        }
    })

    this.on('error',function(files,errorMessage){
      alertify.error(errorMessage);
      [].forEach.call(files,function(file){
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
      })
    })
  },
  maxFiles:5,
  acceptFile:'image/*',
  url: "gallery_upload", // Set the url
  thumbnailWidth: 100,
  thumbnailHeight: 100,
  paramName:'photo',
  acceptedFiles:'image/*',
  headers:{'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")},
  uploadMultiple:true,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews", // Define the container to display the previews
  clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("success",function(file,message){
    file.previewElement.remove();
})

myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1";
  // And disable the start button
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true);
};

var form = $('#delete_gallery')[0];

form.onsubmit = function(e) {
  e.preventDefault();
  $('#delete-gallery').text('Deleting...').attr('disabled',true);
  var url = this.getAttribute('action');
  var data = $(this).serialize();
  $.post(url,data,function(data){
    alertify.success(data.message);
    $('#delete-gallery').text('Delete Selected').attr('disabled',false);
    deleteImage(data.ids);
  }).fail(function(){
    alertify.error('Something happened');
  })
}

function displayImage(instance) {
  $(`<div class="col-md-6 col-sm-6" id="${instance.id}">
  <div class="cbp-item graphics-design">
      <a href="${instance.image_name}" class="cbp-caption nivo-lightbox" data-lightbox-gallery="gallery1">
          <div class="cbp-caption-defaultWrap">
              <img src="${instance.image_name}" alt="" style="max-width:350px;">
          </div>
          <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                  <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-text">ENLARGE</div>
                  </div>
              </div>
          </div>
      </a>

      <div class="checkbox">
          <label class="">
              <div class="icheckbox_square"><input type="checkbox" value="${instance.id}" name="images[]" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
          </label>
      </div>

  </div>
</div>`).prependTo($('#id-row')).hide().fadeIn(1000);
}

function deleteImage(ids) {
  Array.prototype.forEach.call(ids,function(id){
    $(`#${id}`).fadeOut(1000,function(){
      $(this).remove();
    })
  })
}