<div class="relative">
    
    @if ('textarea' != $type)
        @if ($formId)
            <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-2" 
            onclick="document.getElementById('{{ $name }}').value = ''; document.getElementById('{{ $formId }}').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-5 h-5 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>          
            </button>
        @endif
        
        <input 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            id="{{ $name }}"
            @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
                'pr-8' => $formId, //only when input is part of a form that can be resend
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name),
                ])>
            {{-- class="w-full pr-8 rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2" --}}
    @else
        
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}" 
            cols="30" 
            rows="5"
            @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
                'pr-8' => $formId, //only when input is part of a form that can be resend
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name),
                ])>
        </textarea>

    @endif

    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror

</div>