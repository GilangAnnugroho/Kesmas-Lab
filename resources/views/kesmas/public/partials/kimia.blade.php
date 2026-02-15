{{-- resources/views/kesmas/public/partials/kimia.blade.php --}}
@if(isset($kimia) && $kimia->count())
    @foreach($kimia as $param)
        <label class="checkbox-row">
            <input
                type="checkbox"
                name="kimia[]"
                value="{{ $param->id }}"
                {{ in_array($param->id, old('kimia', [])) ? 'checked' : '' }}
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
        Belum ada master parameter kimia.
    </p>
@endif
