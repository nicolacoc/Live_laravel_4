@props(['active','class'])
@php
$class = (($active))?$class.' active':$class;

@endphp
<li class="nav-item">
    <a {{$attributes->merge(['class'=>$class])}}>{{$slot}}</a>
</li>
