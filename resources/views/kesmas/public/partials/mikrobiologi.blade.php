{{-- resources/views/kesmas/public/partials/mikrobiologi.blade.php --}}
@if(isset($mikrobiologi) && $mikrobiologi->count())
    @foreach($mikrobiologi as $param)
        <label class="checkbox-row">
            <input
                type="checkbox"
                name="mikrobiologi[]"
                value="{{ $param->id }}"
                {{ in_array($param->id, old('mikrobiologi', [])) ? 'checked' : '' }}
            >
            <span>
                {{ $param->nama_parameter }}
                @if($param->satuan)
                    ({{ $param->satuan }})
                @endif
            </span>
        </label>
    @endforeach
@else
    <p style="margin-top:8px;font-size:12px;color:var(--muted);">
        Belum ada master parameter mikrobiologi.
    </p>
@endif
