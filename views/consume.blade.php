@extends('layout.default')

@section('title', $L('Consume'))
@section('activeNav', 'consume')
@section('viewJsName', 'consume')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6 col-xl-4 pb-3">
		<h1>@yield('title')</h1>

		<form id="consume-form" novalidate>

			@include('components.productpicker', array(
				'products' => $products,
				'nextInputSelector' => '#amount',
				'disallowAddProductWorkflows' => true
			))

			@include('components.numberpicker', array(
				'id' => 'amount',
				'label' => 'Amount',
				'hintId' => 'amount_qu_unit',
				'min' => 1,
				'value' => 1,
				'invalidFeedback' => $L('The amount cannot be lower than #1', '1')
			))

			<div class="form-group">
				<label for="use_specific_stock_entry">
					<input type="checkbox" id="use_specific_stock_entry" name="use_specific_stock_entry"> {{ $L('Use a specific stock item') }}
					<span class="small text-muted">{{ $L('The first item in this list would be picked by the default rule which is "First expiring first, then first in first out"') }}</span>
				</label>
				<select disabled class="form-control" id="specific_stock_entry" name="specific_stock_entry">
					<option></option>
				</select>
			</div>

			<div class="checkbox">
				<label for="spoiled">
					<input type="checkbox" id="spoiled" name="spoiled"> {{ $L('Spoiled') }}
				</label>
			</div>

			@if (GROCY_FEATURE_FLAG_RECIPES)
			@include('components.recipepicker', array(
				'recipes' => $recipes,
				'isRequired' => false,
				'hint' => $L('This is for statistical purposes only')
			))
			@endif

			<button id="save-consume-button" class="btn btn-success">{{ $L('OK') }}</button>
			<button id="save-mark-as-open-button" class="btn btn-secondary">{{ $L('Mark as opened') }}</button>

		</form>
	</div>

	<div class="col-xs-12 col-md-6 col-xl-4">
		@include('components.productcard')
	</div>
</div>
@stop
