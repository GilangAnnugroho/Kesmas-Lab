@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
])

<div class="field-row">
    <div class="field-label">
        {{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}
    </div>

    <div class="field-colon">:</div>

    <div class="field-input">
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
        >
    </div>
</div>
