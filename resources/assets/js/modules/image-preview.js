(function($) {

    var main = {
        renderImage: function (file) {

            console.log("something is hapenning!");
            // generate a new FileReader object
            var reader = new FileReader();
            var image = new Image();

            reader.onload = function (_file) {
                image.src = _file.target.result;              // url.createObjectURL(file);
                image.onload = function () {
                    var w = this.width,
                        h = this.height,
                        t = file.type,                           // ext only: // file.type.split('/')[1],
                        n = file.name,
                        s = ~~(file.size / 1024)/1024;
                    var scaleWidth = settings.thumbnail_size ;

                    $('.p').append("<div class='s-12 m-10 l-10 l-offset-1 m-offset-1'><div class='thumbnail' style='background: #ffffff'><img src='" + image.src + "' /><div class='caption' style='position: absolute;right: 10px;top:10px;'> <h4  style='background: black;padding: 4px; color: white'>"+ s.toFixed(2) +" Mb </h4></div></div> </div> ")

                };
                image.onerror = function () {
                    alert('Invalid file type: ' + file.type);
                    fileinput.val(null);
                };
            };
            reader.readAsDataURL(file);

        },
        renderProfileImage: function (file) {

                // generate a new FileReader object
                var reader = new FileReader();
                var image = new Image();

                reader.onload = function (_file) {
                    image.src = _file.target.result;              // url.createObjectURL(file);
                    image.onload = function () {
                        var w = this.width,
                            h = this.height,
                            t = file.type,                           // ext only: // file.type.split('/')[1],
                            n = file.name,
                            s = ~~(file.size / 1024)/1024;
                        var scaleWidth = settings.thumbnail_size ;

                        $('.profile-img-block').append("<img class=\"img profile-img\" align=\"center\" src='" + image.src + "' /> ").css({position:"relative"});

                        $('#changeImage .button.button-primary.button-block').val('to download press').addClass('text-success');
                    };
                    image.onerror = function () {
                        alert('Invalid file type: ' + file.type);
                        fileinput.val(null);
                    };
                };
                reader.readAsDataURL(file);

            }
    };

    //render the image in our view
    var fileinput = $("#fileupload").attr('accept', 'image/jpeg,image/png,image/gif');
    var settings = {
        thumbnail_size:460,
        thumbnail_bg_color:"#ddd",
        thumbnail_border:"1px solid #fff",
        thumbnail_shadow:"0 0 0px rgba(0, 0, 0, 0.5)",
        label_text:"",
        warning_message:"Not an image file.",
        warning_text_color:"#f00",
        input_class:'custom-file-input button button-primary button-block'
    };

    // when the file is read it triggers the onload event above.

    // handle input changes
    fileinput.change(function(e) {

        $('.p').html('');

        if(this.disabled) return alert('File upload not supported!');
        var F = this.files;
        if(F && F[0]) for(var i=0; i<F.length; i++) {
            if (F[i].type.match('image.*')) {
                console.log("file matches");
                if($('.image-error').length >= 1)
                {
                    $('.image-error').remove();
                }

                main.renderImage(F[i]);
            }
            else{
                $('.filelabel').append(
                    $('<small>').addClass('image-error')
                        .text(settings.warning_message)
                        .css({
                            "font-size":"100%",
                            "color":settings.warning_text_color,
                            "display":"inline-block",
                            "font-weight":"normal",
                            "margin-left":"1em",
                            "font-style":"normal"
                        })
                );
            }
        }

    });



    var fileElement = $("#file")
        .attr('accept', 'image/jpeg,image/png,image/gif');
    var settings = {
        thumbnail_size:100,
        thumbnail_bg_color:"#ddd",
        thumbnail_border:"3px solid white",
        thumbnail_border_radius: "3px",
        label_text:"",
        warning_message:"Not an image file.",
        warning_text_color:"#f00",
        input_class:'custom-file-input button button-primary button-block'
    };


    // when the file is read it triggers the onload event above.

    // handle input changes
    fileElement.change(function(e) {

        $('.profile-img-block').html('');
        if(this.disabled) return alert('File upload not supported!');
        var F = this.files;
        if(F && F[0]) for(var i=0; i<F.length; i++) {
            if (F[i].type.match('image.*')) {

                if($('.image-error'))
                {
                    $('.image-error').remove();
                }
                main.renderProfileImage(F[i]);
            }
            else{
                $('.profile-img-block').append(
                    $('<small>').addClass('image-error')
                        .text(settings.warning_message)
                        .css({
                            "font-size":"100%",
                            "color":settings.warning_text_color,
                            "display":"inline-block",
                            "font-weight":"normal",
                            "margin-left":"1em",
                            "font-style":"normal"
                        })
                );
            }
        }

    });
})(jQuery);