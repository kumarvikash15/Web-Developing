<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>upload</title>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <script type="text/javascript">
    $.ajax({
  url : post_url,
  type: "POST",
  data : form_data,
  contentType: false,
  cache: false,
  processData:false,
  xhr: function(){
      //upload Progress
      var xhr = $.ajaxSettings.xhr();
      if (xhr.upload) {
          xhr.upload.addEventListener('progress', function(event) {
              var percent = 0;
              var position = event.loaded || event.position;
              var total = event.total;
              if (event.lengthComputable) {
                  percent = Math.ceil(position / total * 100);
              }
              //update progressbar
              $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
              $(progress_bar_id + " .status").text(percent +"%");
          }, true);
      }
      return xhr;
  },
  mimeType:"multipart/form-data"
}).done(function(res){ //
  $(my_form_id)[0].reset(); //reset form
  $(result_output).html(res); //output response from server
  submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
});
    </script>
    <div class="form-wrap">
<h3>Ajax Image Uploader</h3>
    <form action="" method="post" enctype="multipart/form-data" id="upload_form">
        <input name="__files[]" type="file" multiple />
      <input name="__submit__" type="submit" value="Upload"/>
    </form>
    <div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
    <div id="output"><!-- error or success results --></div>
</div>
  </body>
</html>
