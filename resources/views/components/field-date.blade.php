@props([
    'label'      => '',
    'date_name'  => '',
    'time_name'  => null,   // boleh null kalau tidak pakai jam
    'value_date' => '',
    'value_time' => '',
    'required'   => false,
])

<div class="field-row">
    <div class="field-label">
        {{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}
    </div>

    <div class="field-colon">:</div>

    <div class="field-input">
        <div style="display:flex;gap:5px;align-items:center;flex-wrap:wrap;">

            {{-- INPUT TANGGAL --}}
            <input type="date"
                   name="{{ $date_name }}"
                   value="{{ old($date_name, $value_date) }}"
                   @if($required) required @endif
            >

            {{-- INPUT JAM (OPSIONAL) --}}
            @if($time_name)
                <input type="time"
                       name="{{ $time_name }}"
                       value="{{ old($time_name, $value_time) }}"
                       @if($required) required @endif
                >
            @endif
        </div>
    </div>
</div>
