@props(['errors'])

@if ($errors->any())
    <div class="error-alert"{{ $attributes }}>
        <!-- <div class="font-medium" style="padding-top:1px;">
            {{ __('These credentials do not match our records.') }}
        </div> -->

        <ul class="list-disc list-inside text-sm mt-1 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
