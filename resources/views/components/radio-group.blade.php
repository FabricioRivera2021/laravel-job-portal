<div class="xl:flex gap-2 xl:flex-wrap md:border md:rounded-md md:p-2">
    @if ($allOptions)
        <label for="{{ $name }}" class="mb-1 flex items-center">
        <input type="radio" name="{{ $name }}" value=""
        {{--para que tenga persistencia el radio button--}}
        @checked(!request('experience'))/>
            <span class="ml-2">All</span>
        </label>
    @endif
    
    @foreach ($optionsWithLabels as $label => $option)
        <label for="experience" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $option }}" 
            @checked($option === ($value ?? request($name)))/>{{--para que tenga persistencia el radio button--}}
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach

    @error($name)
    <div class="mt-1 text-xs text-red-500">
        {{ $message }}
    </div>
    @enderror
</div>