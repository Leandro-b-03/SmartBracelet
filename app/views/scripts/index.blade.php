@extends('layout')

@section('content')
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Scripts</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				@if (isset($message))
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger alert-dismissable">
							<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
							<p>{{ $message }}</p>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Execultar Script
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
									{{ Form::open(array('url' => 'scripts/run', 'class' => 'form')) }}
										<div class="form-group">
											{{ Form::label('sqlQuery', 'Sintaxe SQL') }}
											{{ Form::textarea('sqlQuery', "", array('id' => 'sqlQuery', 'class' => 'form-control', 'rows' => '12')) }}
										</div>
										<div class="form-group">
											<label>Opções [</label>
											<label class="checkbox-inline">
												{{ Form::checkbox('execute', true) }}
												Execultar saída
											</label>
											<label class="checkbox-inline">
												{{ Form::checkbox('show', true) }}
												Visualizar saída
											</label>
											<label>]</label>
										</div>
										<div class="form-group">
											{{ Form::submit('Execultar QUERY', array('class'=>"btn btn-default right")) }}
										</div>
									{{ Form::close() }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					@if (isset($result))
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									Saída
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
										@foreach($result as $column => $item)
										@foreach($item as $key => $value)
											<p>{{ $value }}</p>
										@endforeach
										@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>

				<link rel="stylesheet" href="../media/js/codemirror/lib/codemirror.css" />
				{{ HTML::script("../media/js/codemirror/lib/codemirror.js") }}
				{{ HTML::script("../media/js/codemirror/mode/javascript/javascript.js") }}
				{{ HTML::script("../media/js/codemirror/mode/sql/sql.js") }}


				<script>
					window.onload = function() {
						var mime = 'text/x-sql';
						window.editor = CodeMirror.fromTextArea(document.getElementById('sqlQuery'), {
							mode: "text/x-mysql",
							hint: "hint/sql-hint.js",
							indentWithTabs: true,
							smartIndent: true,
							lineNumbers: true,
							matchBrackets : true,
							autofocus: true
						});
					};
				</script>

@stop