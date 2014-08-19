	<div>
		<ol class="breadcrumb">
		  <li><a href="{{{URL::route('user.home')}}}">Home</a></li>
		  <li><a href="{{ URL::route('test.index') }}">Test</a></li>
		  <li class="active">Edit</li>
		</ol>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading ">
			<span class="glyphicon glyphicon-user"></span>
			Edit
		</div>
		<div class="panel-body">
		<!-- if there are creation errors, they will show here -->
			@if($errors->all())
				<div class="alert alert-danger">
					{{ HTML::ul($errors->all()) }}
				</div>
			@endif
			{{ Form::open(array('route' => 'test.viewDetails', 'id' => 'form-enter-results')) }}
				<div class="form-group">
					{{ Form::label('testType', 'BS for mps') }}
					{{ Form::text('testType', Input::old('testType'), 
						array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('interpretation', 'Result Interpretation') }}
					{{ Form::text('interpretation', Input::old('interpretation'), array('class' => 'form-control')) }}
				</div>
				<div class="form-group actions-row">
					{{ Form::button('<span class="glyphicon glyphicon-save"></span> Save', 
						['class' => 'btn btn-primary', 'onclick' => 'submit()']) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>