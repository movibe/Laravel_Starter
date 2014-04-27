@extends('admin.layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('left-layout-nav')
	@include('admin/navigation/settings')
@stop

@section('left-layout-content')
	<div class="page-header">
		<h3>{{{ $title }}}</h3>
	</div>

	{{ Form::open(array('class' => 'form-horizontal')) }}
		 @foreach($settings as $a => $b)
		 @if (is_array($b))
				@section('tabs')

					<li @if($a == 'site')class="active"@endif><a href="#{{{ $a }}}" data-toggle="tab">
						@if (Lang::has('core::all.'.$a)){{ trans('core::all.'.$a) }}@else{{ $a }}@endif
					</a></li>
				@append
			
				@section('tab-content')

					<div class="tab-pane @if($a == 'site')active@endif" id="{{{ $a }}}">
					<table width="80%" class="table table-striped table-hover">
					@foreach($b as $c => $d)
							<tr>
								  <td><label class="control-label">@if (Lang::has('core::settings.'.$c)){{ trans('core::settings.'.$c) }}@else{{ $c }}@endif</label></td>
								  <td><input class="col-lg-12 form-control" type="text" name="settings[{{ $a }}.{{ $c }}]" value="{{ $d }}"></td>
							</tr>
					 @endforeach
					</table>
					</div>
				@append
		@endif
		@endforeach

		<ul class="nav settings-tabs">@yield('tabs')</ul>
		<div class="settings-tab-content">@yield('tab-content')</div>

		<div class="form-group">
			<div class="col-md-12">
				{{ Form::reset(Lang::get('button.reset'), array('class' => 'btn btn-default')); }} 
				{{ Form::submit(Lang::get('button.save'), array('class' => 'btn btn-success')); }} 
			</div>
		</div>
	{{ Form::close(); }}
@stop
@include('admin/left-layout')