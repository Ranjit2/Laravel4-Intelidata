@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h1>INICIO</h1>
				<a href="#" id="username" data-type="text" data-pk="1" data-url="edit-marks" data-title="Enter username">superuser</a>
				<table class="table table-bordered table-striped" id="user">
					<tbody>
						<tr>
							<td width="40%">Username</td>
							<td><a data-original-title="Enter username" data-name="username" data-type="text" id="new_username" class="myeditable editable editable-click editable-empty" href="#">Empty</a></td>
						</tr>
						<tr>
							<td>First name</td>
							<td><a data-original-title="Enter firstname" data-name="firstname" data-type="text" class="myeditable editable editable-click editable-empty" href="#">Empty</a></td>
						</tr>
						<tr>
							<td>Group</td>
							<td><a data-original-title="Select group" data-source="/groups" data-name="group" data-type="select" class="myeditable editable editable-click editable-empty" href="#">Empty</a></td>
						</tr>
						<tr>
							<td>Date of birth</td>
							<td><a data-original-title="Select Date of birth" data-viewformat="dd/mm/yyyy" data-name="dob" data-type="date" class="myeditable editable editable-click editable-empty" href="#">Empty</a></td>
						</tr>
						<tr>
							<td>Comments</td>
							<td><a data-original-title="Enter comments" data-name="comments" data-type="textarea" class="myeditable editable editable-pre-wrapped editable-click editable-empty" href="#">Empty</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
	$(function(){
		$.fn.editable.defaults.mode = 'inline';
		$('.pUpdate').editable({
			validate: function(value) {
				if($.trim(value) == '')
					return 'Value is required.';
			},
			type: 'text',
			url:'{{URL::to("/")}}/edit-marks',
			title: 'Edit Status',
			placement: 'top',
			send:'always',
			ajaxOptions: {
				dataType: 'json'
			}
		});
		$('#username').editable();
	});
	$('.myeditable').editable({
		url: '/post',
		mode: 'inline'
	});
	//make username required
	$('#new_username').editable('option', 'validate', function(v) {
		if(!v) return 'Required field!';
	});

	//automatically show next editable
	$('.myeditable').on('save.newuser', function(){
		var that = this;
		setTimeout(function() {
			$(that).closest('tr').next().find('.myeditable').editable('show');
		}, 200);
	});
	$('#save-btn').click(function() {
		$('.myeditable').editable('submit', {
			url: '/newuser',
			ajaxOptions: {
				dataType: 'json' //assuming json response
			},
			success: function(data, config) {
			if(data && data.id) { //record created, response like {"id": 2}
			//set pk
		$(this).editable('option', 'pk', data.id);
			//remove unsaved class
			$(this).removeClass('editable-unsaved');
			//show messages
			var msg = 'New user created! Now editables submit individually.';
			$('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
			$('#save-btn').hide();
			$(this).off('save.newuser');
		} else if(data && data.errors){
			//server-side validation error, response like {"errors": {"username": "username already exist"} }
			config.error.call(this, data.errors);
		}
	},
	error: function(errors) {
		var msg = '';
		    if(errors && errors.responseText) { //ajax error, errors = xhr object
		    	msg = errors.responseText;
		    } else { //validation error (client-side or server-side)
		    	$.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
		    }
		    $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
		  }
		});
});

$('#reset-btn').click(function() {
    $('.myeditable').editable('setValue', null) //clear values
    .editable('option', 'pk', null) //clear pk
    .removeClass('editable-unsaved'); //remove bold css
    $('#save-btn').show();
    $('#msg').hide();
  });
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop