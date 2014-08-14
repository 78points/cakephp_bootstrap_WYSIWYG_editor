<style>
#editor {
max-height: 450px;
height: 400px;
margin-bottom: 20px;
background-color: white;
border-collapse: separate;
border: 1px solid #cccccc;
padding: 4px;
box-sizing: content-box;
-webkit-box-shadow: rgba(0, 0, 0, 0.07451) 0px 1px 1px 0px inset;
box-shadow: rgba(0, 0, 0, 0.07451) 0px 1px 1px 0px inset;
border-top-right-radius: 3px;
border-bottom-right-radius: 3px;
border-bottom-left-radius: 3px;
border-top-left-radius: 3px;
overflow: scroll;
outline: none;
}
#voiceBtn {
width: 20px;
color: transparent;
background-color: transparent;
transform: scale(2, 2);
-webkit-transform: scale(2, 2);
-moz-transform: scale(2, 2);
border: transparent;
cursor: pointer;
box-shadow: none;
-webkit-box-shadow: none;
}
div[data-role="editor-toolbar"] {
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}
.dropdown-menu a {
cursor: pointer;
}
#text_edit_buttons {
margin-bottom: 10px;
margin-top: -10px;
}
#text_edit_buttons .btn {
background: #2c3e50;
font-weight: normal;
text-shadow: none;
margin-bottom: 5px;
}
#text_edit_buttons .btn i {
color: #fff;
}
#text_edit_buttons .btn-info {
background: #18bc9c;
border-color: #18bc9c;
}
</style>




<?php echo $this->Form->create('Your-model', array('type' => 'file', 'class' => 'form', 'id'=>'AddForm')); ?>
<div class="form-group">
<?php echo $this->Form->input('name', array('label' => 'Document title', 'class'=>'form-control', 'id'=>'name','placeholder'=>'Enter document name'));?>
</div>
<div class="form-group">
<?php
// this hidden field will take value of the #editor div before form submit
echo $this->Form->input('body', array('class'=>'form-control', 'id'=>'editor2', 'style'=>'display:none;'));
?>
</div>
<?php
include('text_edit_bar.php');
?>
<div id="editor">
<?php echo $data['Document']['body'];?>
</div>
<?php echo $this->Form->submit('Save Page', array('class' => 'btn btn-primary btn-sm', 'title' => 'Save Post')); ?>
<?php echo $this->Form->end(); ?>


<script src="<?php echo Router::fullbaseUrl();?><?php echo $this->webroot; ?>external/jquery.hotkeys.js"></script>
  <script src="<?php echo Router::fullbaseUrl();?><?php echo $this->webroot; ?>external/google-code-prettify/prettify.js"></script>
<script src="<?php echo Router::fullbaseUrl();?><?php echo $this->webroot; ?>bootstrap-wysiwyg.js"></script>

<script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
     $('.dropdown-menu input').click(function() {return false;})
.change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () {
        var overlay = $(this), target = $(overlay.data('target'));
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange" in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
};
function showErrorAlert (reason, detail) {
var msg='';
if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
else {
console.log("error uploading file", reason, detail);
}
$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
'<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
};
    initToolbarBootstrapBindings();
$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });
</script>

<script>
$(document).ready( function() {
// replace content of the body input with new input from editor div
$('#AddForm').submit(function() {
var textFiled = $('#editor').html();
$('#editor2').val( textFiled );
});
}); //document
</script>
