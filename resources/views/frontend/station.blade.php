@extends('layouts.app')

@section('content')
    @if(!empty($station))
        @php
            $stations = json_decode($station->route->stations);
        $image = $stations[$arr_id]->img_name;

        @endphp
        <div class="fdc d-flex route" id="main"
             style="background-image: url('{{asset('storage/upload/'.$image)}}')">

            <img src="{{asset('storage/upload/'.$image)}}" alt="Planets" usemap="#planetmap">

            <map id="planetmap" name="planetmap">
                <area shape="circle" coords="{{$station->lang}}, {{$station->lat}}, 200" alt="Sun" href="https://www.facebook.com/Artonwheelsgyumri">
{{--                <area shape="circle" coords="90,58,3" alt="Mercury" href="mercur.htm">--}}
{{--                <area shape="circle" coords="124,58,8" alt="Venus" href="venus.htm">--}}
            </map>

        </div>
    @endif
@endsection
