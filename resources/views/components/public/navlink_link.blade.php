@props(['active','class'])
@php
$class = (($active))?$class.' active bg-white text-black':$class;

@endphp
<li class="nav-item">
    <a {{$attributes->merge(['class'=>$class])}}>{{$slot}}</a>
</li>
