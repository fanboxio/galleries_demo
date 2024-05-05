@php
    $alertType = match(true) {
        session()->has('success') => 'success',
        session()->has('error') => 'danger',
        default => null,
    };
@endphp

@if($alertType)
    @include('toast', ['toastMessage' => session($alertType)])
    <script>
        // loadToast - function from toast blade
        window.onload = () => loadToast();
    </script>
@endif