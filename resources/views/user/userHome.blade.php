@extends('layouts.master')

<main>
    <h5>Mi instragram</h5>
    <a class="" href="{{ route('logout.perform') }}">Logout</a>
    {{ $test }}
</main>