@props([
  'label' => null,
  'name',
  'tooltip' => null,
  'required' => null
])

@if($label) <label class="form-label">{{$label}} {!! ($required ? '<span class="text-danger-emphasis"> * </span>' : '') !!}</label> @endif
@if ($tooltip)
  <span data-bs-toggle="tooltip" data-bs-html="true" title="{!! $tooltip !!}">
  <i class="ri-information-line align-middle text-warning-emphasis" style="font-size: 1rem"></i></span>
@endif
<select class="form-select" name={{ $name }}>
  {{ $slot }}
</select>