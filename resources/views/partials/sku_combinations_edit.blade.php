	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-center">
					<label for="" class="control-label">{{__('Variant')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{__('Variant Price')}}</label>
				</td>
			</tr>
		</thead>
		<tbody>


        @foreach(json_decode($product->choice_size) as $key=>$Item)
		<tr>
			<td>
			    <input type="number" name="choice_options_2[]" id="size_{{ $key }}" onkeyup="getVarient({{ $key }})" value="{{ $key }}"  min="0" step="0.01" class="form-control" required>
			</td>
			<td>
				<input type="number" name="choice_options_price[]" id="price_{{ $key }}" readonly value="{{ $Item }}" min="0" step="0.01" class="form-control" required>
			</td>
		</tr>
     @endforeach

	</tbody>
</table>
