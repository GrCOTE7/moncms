@php
    $routeName = request()->route()->getName();
@endphp

<p @class(['text-color', 'red' => str_starts_with($routeName, 'ga')])>La route est <b>{{ $routeName }}</b> !</p>
&
