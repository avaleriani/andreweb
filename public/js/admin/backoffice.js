dropZoneContainer = {
    init: function () {
        /*Dropzone.autoDiscover = false;
         $("#dropzone").dropzone({
         paramName: "file_list", // The name that will be used to transfer the file
         maxFilesize: 5, // MB
         previewsContainer: 'dropzone-previws',
         autoProcessQueue: false,
         addRemoveLinks: true,
         uploadMultiple: true,
         parallelUploads: 20,
         maxFiles: 20
         });
         var myDropzone = this;

         // First change the button to actually tell Dropzone to process the queue.
         this.element.querySelector(".btn-blue").addEventListener("click", function (e) {
         // Make sure that the form isn't actually being sent.
         e.preventDefault();
         e.stopPropagation();
         myDropzone.processQueue();
         });

         var current_queue = [];
         $('.sortable_img > li').each(function () {
         current_queue.push($(this).data('file'));
         });

         this.removeAllFiles();

         for (var i = 0; i < current_queue.length; i++) {
         this.addFile(current_queue[i]);
         }

         this.processQueue();

         // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
         // of the sending event because uploadMultiple is set to true.
         this.on("sendingmultiple", function () {
         // Gets triggered when the form is actually being sent.
         // Hide the success button or the complete form.
         });
         this.on("successmultiple", function (files, response) {
         // Gets triggered when the files have successfully been sent.
         // Redirect user or notify of success.
         });
         this.on("errormultiple", function (files, response) {
         // Gets triggered when there was an error sending the files.
         // Maybe show form again, and notify user of error
         });
         this.on('addedfile', function (file) {
         $('.sortable_img li:last-of-type').data('file', file);
         });
         }*/

        var photo_counter = 0;
        $("#dropzone").dropzone({
            uploadMultiple: false,
            parallelUploads: 100,
            maxFilesize: 8,
            previewsContainer: '#dropzonePreview',
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: 'Remove',
            dictFileTooBig: 'Image is bigger than 8MB',

            // The setting up of the dropzone
            init: function () {

                this.on("removedfile", function (file) {

                    $.ajax({
                        type: 'POST',
                        url: 'upload/delete',
                        data: {id: file.name, _token: $('#csrf-token').val()},
                        dataType: 'html',
                        success: function (data) {
                            var rep = JSON.parse(data);
                            if (rep.code == 200) {
                                photo_counter--;
                                $("#photoCounter").text("(" + photo_counter + ")");
                            }

                        }
                    });

                });
            },
            error: function (file, response) {
                var message = '';
                if ($.type(response) === "string") {
                    message = response; //dropzone sends it's own error messages in string
                }else{
                    message = response.message;
                }
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function (file, done) {
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }
        });
    }
};

wysiwyg = {
    init: function () {
        $('#edit').trumbowyg({
            svgPath: '../../img/icons/icons.svg',
            btns: [
                ['viewHTML'],
                ['formatting'],
                'btnGrp-semantic',
                ['superscript', 'subscript'],
                ['link'],
                'btnGrp-justify',
                'btnGrp-lists',
                ['horizontalRule'],
                ['removeformat'],
                ['foreColor'],
                ['backColor'],
                ['table'],
                ['tableAddRow'],
                ['tableAddColumn']
            ]
        });
    }
};

$(document).ready(function () {
    wysiwyg.init();
    dropZoneContainer.init();
});