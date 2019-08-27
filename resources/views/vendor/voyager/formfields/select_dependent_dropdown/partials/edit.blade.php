	
	@php
		$model = app($dataType->model_name);
		$method = camel_case(sprintf('%s_relationship', $row->field));		// for example:  subcategoriaIdRelationship
																			// for example:  cityIdRelationship
	@endphp

	@if ( method_exists($model, $method) )
		
		@php 
			$model  = $model::{$method}($dataTypeContent->id);				// for example:  App\Producto::subcategoriaIdRelationship($productId)
																			// for example:  App\Profile::cityIdRelationship($profileId)
			$data = $model ? $model->toArray() : [];
			
			$query = app($row->details->model)::pluck($row->details->label, $row->details->key);
			
			$selects = $row->details->dependent_dropdown;
			$count = count($selects)+1;
			$css = ( $count == 2 ? 'col-md-6' : ( $count == 3 ? 'col-md-4' : 'col-md-3') );
		@endphp
		
		@if ( !empty($data) )
		
			<!-- // add first select -->
			<div class="{{ $css }}" style="padding: 10px;">
				<label for="{{$row->details->name}}">{{$row->details->display}}</label>
				<select id="{{ $row->details->name }}" name="{{ $row->details->name }}" class="form-control select2 dependent-dropdown"
						data-route="{{ route($row->details->route) }}"
						data-params="{{ json_encode(['options' => $selects[0], 'model' => $selects[0]->model, 'where' => $selects[0]->where, 'value' => '__value']) }}">
					<!-- //options -->
				@if(isset($row->details->placeholder))
					<option value="0">{{$row->details->placeholder}}</option>
				@endif
				@foreach($query as $key => $option)
					<option value="{{$key}}" @if($key == $data[$row->details->name]){{'selected="selected"'}}@endif>{{$option}}</option>
				@endforeach
				</select>
			</div>
			
			<!-- add other -->
			@foreach ($selects as $key => $item)
				@php 
					$query = app($item->model)::where($item->where, '=', $data[$item->where])->pluck($item->label, $item->key);
					$next = ++$key; 
				@endphp
				<div class="{{ $css }}" style="padding: 10px;">
				@if (isset($selects[$next]))
					<label for="{{$item->name}}">{{$item->display}}</label>
					<select id="{{$item->name}}" name="{{$item->name}}" class="form-group select2 dependent-dropdown"
							data-route="{{ route($row->details->route) }}"
							data-params="{{ json_encode(['options' => $selects[$next], 'model' => $selects[$next]->model, 'where' => $selects[$next]->where, 'value' => '__value']) }}"
							data-placeholder="{{$selects[$next]->placeholder}}">
						<!-- //options -->
					@if(isset($item->placeholder))
						<option value="0">{{$item->placeholder}}</option>
					@endif
					@foreach($query as $k => $option)
						<option value="{{$k}}" @if($k == $data[$item->name]){{'selected="selected"'}}@endif>{{$option}}</option>
					@endforeach
					</select>
				@else
					<label for="{{$item->name}}">{{$item->display}}</label>
					<select id="{{$item->name}}" name="{{$item->name}}" class="form-control select2">
					<!-- //options -->
					@if(isset($item->placeholder))
						<option value="0">{{$item->placeholder}}</option>
					@endif
					@foreach($query as $k => $option)
						<option value="{{$k}}" @if($k==$data[$item->name]){{'selected="selected"'}}@endif>{{$option}}</option>
					@endforeach
					</select>
				@endif
				</div>	
			@endforeach
			
		@else
			<p class="label label-warning"><i class="voyager-warning"></i> {{ __('voyager::generic.no_results') }}</p>
		@endif
	@else
		<p class="label label-warning"><i class="voyager-warning"></i> {{ __('voyager::form.field_select_dd_relationship', ['method' => 'public static function ' . camel_case($method).'($id){}', 'class' => $dataType->model_name]) }}</p>
	@endif
