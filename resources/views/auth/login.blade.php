@extends('adminlte::auth.login')

@if (session('warning'))
<x-adminlte-alert theme="warning" title="Peringatan">
    {{ session('warning') }}
</x-adminlte-alert>
@endif