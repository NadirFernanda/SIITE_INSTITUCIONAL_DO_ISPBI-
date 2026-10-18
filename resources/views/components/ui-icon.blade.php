@props(['name', 'size' => 'md'])

@php
    $sizeClass = match ($size) {
        'sm' => 'h-4 w-4',
        'lg' => 'h-8 w-8',
        'xl' => 'h-12 w-12',
        default => 'h-5 w-5',
    };
@endphp

<svg {{ $attributes->class(['inline-block shrink-0', $sizeClass]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    @switch($name)
        @case('users')
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            @break
        @case('briefcase')
            <rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13a20 20 0 0 0 18 0"/>
            @break
        @case('academic-cap')
            <path d="m2 9 10-5 10 5-10 5L2 9ZM6 11v5c0 2 3 4 6 4s6-2 6-4v-5M22 9v7"/>
            @break
        @case('book-open')
            <path d="M12 6a8 8 0 0 0-9-2v15a8 8 0 0 1 9 2m0-15a8 8 0 0 1 9-2v15a8 8 0 0 0-9 2m0-15v15"/>
            @break
        @case('newspaper')
            <path d="M4 4h14v16H5a3 3 0 0 1-3-3V6a2 2 0 0 1 2-2Zm14 4h4v9a3 3 0 0 1-3 3"/><path d="M7 8h7M7 12h7M7 16h4"/>
            @break
        @case('clipboard')
            <rect x="5" y="4" width="14" height="18" rx="2"/><path d="M9 4.5V3h6v1.5M9 10h6M9 14h6M9 18h4"/>
            @break
        @case('document')
            <path d="M6 2h8l5 5v15H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Zm8 0v5h5M8 12h8M8 16h8"/>
            @break
        @case('chart-bar')
            <path d="M3 21h18M5 17v-6h4v6M10 17V5h4v12M15 17V9h4v8"/>
            @break
        @case('printer')
            <path d="M6 9V3h12v6M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 15h12v6H6zM18 12h.01"/>
            @break
        @case('calendar')
            <rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18M8 14h3M8 17h3"/>
            @break
        @case('clock')
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
            @break
        @case('lock')
            <rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"/>
            @break
        @case('search')
            <circle cx="10.5" cy="10.5" r="7"/><path d="m16 16 5 5"/>
            @break
        @case('rocket')
            <path d="M5 16c1-6 5-10 13-13 2 8-2 12-8 14l-5-1ZM8 13l3 3M6 17l-2 4 4-2M14 7h.01"/>
            @break
        @case('hourglass')
            <path d="M6 3h12M6 21h12M8 3v3a4 4 0 0 0 2 3.5L12 11l2-1.5A4 4 0 0 0 16 6V3M8 21v-3a4 4 0 0 1 2-3.5L12 13l2 1.5a4 4 0 0 1 2 3.5v3"/>
            @break
        @case('check-circle')
            <circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16 9"/>
            @break
        @case('star')
            <path d="m12 2 3.1 6.3 7 .9-5.1 5 .9 7-5.9-3.3-5.9 3.3.9-7-5.1-5 7-.9L12 2Z" fill="currentColor" stroke="none"/>
            @break
    @endswitch
</svg>
