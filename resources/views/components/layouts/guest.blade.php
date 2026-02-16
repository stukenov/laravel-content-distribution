<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    @include('partials.head')
</head>
<body class=" bg-white font-serif ">
@include('livewire.common.header')

{{ $slot }}

@include('livewire.common.footer')
@fluxScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
