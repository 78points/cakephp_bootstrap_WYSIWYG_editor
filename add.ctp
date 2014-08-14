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
<script>
$(document).ready( function() {
// replace content of the body input with new input from editor div
$('#AddForm').submit(function() {
var textFiled = $('#editor').html();
$('#editor2').val( textFiled );
});
}); //document
</script>
