@props(['url', 'title', 'classes'])
<a hx-get="{{ $url }}&navigate=1" aria-disabled="false" hx-target="#digest-navigation" hx-swap="outerHTML"
    hx-indicator=".loading-digest" class="{{ $classes }}">
    {{ $title }}
</a>
