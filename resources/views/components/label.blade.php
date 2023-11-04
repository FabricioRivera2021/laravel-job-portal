<label class="mb-2 block text-sm font-medium test-slate-900" for="{{ $for }}">
    {{ $slot }} 
    @if ($required)
        <span>*</span>
    @endif
</label>