<?php
/*
* 
*
*/

if(isset($_POST['upload_image'])){
	
	$uploadfile=$_FILES["upload_file"]["tmp_name"];
// Проверим на ошибки


// Создадим ресурс FileInfo
$fi = finfo_open(FILEINFO_MIME_TYPE);

// Получим MIME-тип
$mime = (string) finfo_file($fi, $uploadfile);

// Закроем ресурс
finfo_close($fi);

// Проверим ключевое слово image (image/jpeg, image/png и т. д.)

if( strpos( $mime, 'image' ) === false ){		 die( 'Можно загружать только изображения.' ); 

}else{ 
	$limitBytes  = 1024 * 1024 * 30;
	if(	filesize( $uploadfile ) > $limitBytes ){ die( 'Размер изображения не должен превышать 30 Мбайт.' );
	
	}else{
		$checked_uploadfile = $uploadfile;
	}
}
	$folder="images/";
	move_uploaded_file($checked_uploadfile, "$folder".$_FILES["upload_file"]["name"]);
}
?>

<html>
<head>
<title>Загрузка картинки с порезкой</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>

<script>
$(document).ready(function() {
	$('form').ajaxForm(function() {
		$('#success_message').html("Uploaded");
	});
});
</script>
<style>
.icon_wrapper {
    height: 256px; width: 256px;
}
.icon_wrapper div {
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    height: 100%; width: 100%;
	position:relative;
}
#view{
	left: 10px;
	position: relative;
	display: block;
	width: 800px;
	height: 574px;
}

</style>
</head>
<body style="padding-top:50px;">
  <div class="container">	  
  <!-- container class is used to centered the body of the browser with some decent width-->
  <div  class="row">
  <!-- row class is used for grid system in Bootstrap-->
  <div class="col-md-4 col-md-offset-4" >
  <!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
  <div class="login-panel panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Загрузка изображения:</h3>
                  </div>
                  <div class="panel-body">

                      <form method="post" action="" enctype="multipart/form-data">

                          <fieldset>

                              <div class="form-group">
                                <input type="file" id="upload_file" preview-target-id="preview_1"  view-target-id="view" name="upload_file"/>
                              </div>
                          <input class="btn btn-success" id="submit_upload" type="submit" name='upload_image'  value="Upload Image"/>
                          </fieldset>
                      </form>
                      <p id="success_message"></p>

                  </div>

              </div>
	<label for="icon_upload">Image preview:<br>
    <div class="icon_wrapper" style="float:right;"><div id="preview_1" style="float:right;"></div></div>
	</label>
	</div>

	</div>
	  
  </div>
<label for="icon_upload">
    <div id="view">
		<div class="left" ></div>
		<div class="second" ></div>
		<div class="center" ></div>
		<div class="fourth" ></div>
		<div class="right" ></div>
	</div>
</label>
  
<script>
$('input[type="file"][preview-target-id]').on('change', function() {
    var input = $(this)
    if (!window.FileReader) return false // check for browser support
    if (input[0].files && input[0].files[0]) {
        var reader = new FileReader()
        reader.onload = function (e) {
            var target = $('#' + input.attr('preview-target-id'))
            var background_image = 'url(' + e.target.result + ')'
            target.css('background-image', background_image)
            target.parent().show()
        }
        reader.readAsDataURL(input[0].files[0]);
    }
})
$('input[type="file"][view-target-id]').on('change', function() {
    var input = $(this)
    if (!window.FileReader) return false // check for browser support
    if (input[0].files && input[0].files[0]) {
        var reader = new FileReader()
        reader.onload = function (e) {
            var target = $('#' + input.attr('view-target-id') )
            var background_image = 'url(' + e.target.result + ')'
			$('#view div').css({'background': background_image,
				'float': 'left',
				'position': 'relative',
				'display':'block',
				'width': '150px',
				'box-shadow': '10px 10px 20px #a1a39e',
			})
            $('#view .left').css({
				'bottom': '-166px',
				'background-position': 'left', 
				'left': '0px',
				'height': '174px',
			})
			$('#view .right').css({
				'bottom': '-166px',
				'background-position': 'right', 
				'left': '4%',
				'height':'174px'
			})
			$('#view .second').css({
				'bottom': '-104px',
				'background-position': 'calc( -150px + 1% )', 
				'left': '1%',
				'height':'300px'
			})
			$('#view .fourth').css({
				'bottom': '-104px',
				'background-position': 'calc( 2 * 150px + 1% )', 
				'left': '3%',
				'height':'300px'
			})
			$('#view .center').css({
				'background-position': 'center', 
				'left': '2%',
				'height':'508px'
			})
            target.parent().show()
        }
        reader.readAsDataURL(input[0].files[0]);
    }
})
</script>

</body>
</html>
