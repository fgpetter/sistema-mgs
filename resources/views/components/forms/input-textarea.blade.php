@props([
  'label',
  'name',
  'required' => null,
  'id' => null,
  'placeholder' => null,
  'uppercase' => false
])

<label for="oservacoes" class="form-label">Observações</label>
<textarea 
  {{ $attributes->class(['form-control']) }} 
  name={{$name}}
  rows="3"
  @if ($id) id={{$id}} @endif
  @if ($required) {{$required}} @endif
  @if ($placeholder) placeholder={{$placeholder}} @endif
  @if ($uppercase) oninput="this.value = this.value.toUpperCase()" @endif
>{{ $slot }}</textarea>