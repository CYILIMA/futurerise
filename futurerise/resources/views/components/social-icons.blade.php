@php
    $platforms = [
        'facebook' => [
            'label' => 'Facebook',
            'icon' => '<svg class="social-logo" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M13.8 21v-8h2.7l.4-3.1h-3.1V7.95c0-.9.25-1.5 1.54-1.5H17V3.68A23.1 23.1 0 0 0 14.67 3.56c-2.3 0-3.88 1.4-3.88 3.98V9.9H8.2V13h2.59v8h3.01Z"/></svg>',
        ],
        'instagram' => [
            'label' => 'Instagram',
            'icon' => '<svg class="social-logo" viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="3.4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor"/></svg>',
        ],
        'linkedin' => [
            'label' => 'LinkedIn',
            'icon' => '<svg class="social-logo" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.5 8.5A1.75 1.75 0 1 0 6.5 5a1.75 1.75 0 0 0 0 3.5ZM5 9.8h3v9.7H5V9.8Zm4.9 0h2.87v1.33h.04c.4-.76 1.38-1.56 2.84-1.56 3.04 0 3.6 2 3.6 4.6v5.3h-3v-4.7c0-1.12-.02-2.56-1.56-2.56-1.57 0-1.81 1.22-1.81 2.48v4.78h-3V9.8Z"/></svg>',
        ],
        'x' => [
            'label' => 'X',
            'icon' => '<svg class="social-logo" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M18.9 4.1h2.3l-5.1 5.8 6 9H16l-4.7-6.9L6.1 19H3.8l5.6-6.3L3 4.1h5.1l4.2 6.1 6.6-6.1Zm-1 13.3h1.3L8 5.1H6.5l11.4 12.3Z"/></svg>',
        ],
        'youtube' => [
            'label' => 'YouTube',
            'icon' => '<svg class="social-logo" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M21.6 7.2a2.8 2.8 0 0 0-2-2C17.9 4.8 12 4.8 12 4.8s-5.9 0-7.6.4a2.8 2.8 0 0 0-2 2C2 8.9 2 12 2 12s0 3.1.4 4.8a2.8 2.8 0 0 0 2 2c1.7.4 7.6.4 7.6.4s5.9 0 7.6-.4a2.8 2.8 0 0 0 2-2c.4-1.7.4-4.8.4-4.8s0-3.1-.4-4.8ZM10 15.5v-7l6 3.5-6 3.5Z"/></svg>',
        ],
    ];

    $platformLabels = array_values(array_column($platforms, 'label'));
    $socialLinks = \App\Models\SocialLink::whereIn('platform', $platformLabels)->get()->keyBy('platform');
@endphp

<div class="footer-socials">
    <span class="footer-social-label">Follow us</span>
    <div class="social-links">
        @foreach($platforms as $platformKey => $platformData)
            @php
                $storedLink = $socialLinks->get($platformData['label'])?->url ?? '';
                $hasLink = filled($storedLink);
            @endphp

            @if($hasLink)
                <a
                    class="social-link social-link--{{ $platformKey }}"
                    href="{{ $storedLink }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Visit {{ $platformData['label'] }}"
                    title="{{ $platformData['label'] }}"
                >
                    @php echo $platformData['icon']; @endphp
                </a>
            @else
                <span class="social-link social-link--{{ $platformKey }} social-link-muted" aria-hidden="true" title="{{ $platformData['label'] }}">
                    @php echo $platformData['icon']; @endphp
                </span>
            @endif
        @endforeach
    </div>
</div>
