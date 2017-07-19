<!DOCTYPE html>
<html>
	<head>
		<title>Todo List - Laravel</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<style type="text/css">
			.btn-delete{
				float: right;
				color: #999999;
			}
			.btn-delete:hover{
				color: #bc2328;
			}
			.list-group-item:hover{
				background: #f5f5f5;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Laravel 5.2 Todo List with Ajax</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
						Todo List
					</div>
					<div class="panel-body">
						<div class="container">
							<div class="row">
								{{ Form::open(['id' => 'form-task']) }}
								<div class="col-md-6">
									{{ Form::text('task_name', '', ['class' => 'form-control', 'id' => 'input-task', 'placeholder' => 'Add new Todo...']) }}
									<span class="help-block">Type in a new todo...</span>
								</div>
								<div class="col-md-6">
									{{ Form::submit('Add Todo', ['class' => 'btn btn-default', 'id' => 'button-add']) }}
								</div>
								{{ Form::close() }}
							</div>
							<div class="row col-md-12">
								<hr>
							</div>
							<div class="row col-md-12">
								<ul class="list-group" id="ul-task">
									@foreach($tasks as $val)
									<li class="list-group-item">
										<label>
											{{ Form::checkbox('task', $val->id, false, ['class' => 'check-task', 'id' => 'task-'.$val->id]) }} {{ $val->task_name }} 
										</label>
										<a class="btn-delete" id="{{ $val->id }}" data-toggle="tooltip" data-placement="left" title="Remove this">
											<i class="glyphicon glyphicon-remove-sign"></i>
										</a>
									</li>
									@endforeach
								</ul>
							</div>
							<div class="row col-md-12">
								{{ Form::hidden('list-id', '') }}
								<button class="btn btn-default" id="button-selected">Delete Selected</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>