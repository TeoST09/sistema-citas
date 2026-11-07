@props([
    'type' => 'info',
    'title' => null,
])

@php
    $type = in_array($type, ['success', 'info', 'warning', 'danger'], true) ? $type : 'info';
    $role = in_array($type, ['danger', 'warning'], true) ? 'alert' : 'status';
@endphp

<div {{ $attributes->merge(['class' => "alert alert-{$type}"]) }} role="{{ $role }}">
    <div class="alert-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon alert-icon">
            @if ($type === 'success')
                <path d="M5 12l5 5l10 -10" />
            @elseif ($type === 'warning')
                <path d="M12 9v4" />
                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />
                <path d="M12 16h.01" />
            @elseif ($type === 'danger')
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
            @else
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M12 9h.01" />
                <path d="M11 12h1v4h1" />
            @endif
        </svg>
    </div>
    <div>
        @if ($title)
            <h3 class="alert-heading">{{ $title }}</h3>
        @endif
        <div class="alert-description">{{ $slot }}</div>
    </div>
</div>
