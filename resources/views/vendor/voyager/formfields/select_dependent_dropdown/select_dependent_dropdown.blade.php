<div class="form-group">
	@php
		$fieldset = [
			'text' => !isset($row->details->fieldset) ? $row->display_name : $row->details->fieldset->text ?? $row->display_name,
			'align' => !isset($row->details->fieldset) ? 'left' : $row->details->fieldset->align ?? 'left',
			'bgcolor' => !isset($row->details->fieldset) ? '#ffffff' : $row->details->fieldset->bgcolor ?? '#ffffff'
		];
	@endphp
	
	<fieldset>	
		<legend class="text-{{ $fieldset['align'] }}" style="background-color: {{ $fieldset['bgcolor'] }};padding: 5px;">{{ $fieldset['text'] }}</legend>
	@if ( !isset($dataTypeContent->id) )
		@include('voyager::formfields.select_dependent_dropdown.partials.add')	
	@else
		@include('voyager::formfields.select_dependent_dropdown.partials.edit')
	@endif
	</fieldset>
	
</div>


@push('javascript')
<script src="{{ url('js/dependent-dropdown.js') }}"></script>
<script>
	var x = document.getElementsByTagName("label");
	for (var i=0; i<x.length; i++) {	
		if ( x[i].textContent === "{{$row->display_name}}" ) {
			x[i].style.display = 'none';
			break;
		}		
	}
</script>
@endpush