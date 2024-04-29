@component('mail::message')
# New Reaction on Your Gallery

{{ $userName }} ({{ $userEmail }}) has {{ $reaction == 'like' ? 'liked' : 'disliked' }} your gallery "{{ $gallery->name }}".

@component('mail::button', ['url' => route('galleries.show', $gallery)])
View Gallery
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
