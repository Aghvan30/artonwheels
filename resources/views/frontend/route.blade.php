@extends('layouts.app')

@section('content')
    @if(!empty($route))
        <div class="fdc d-flex route" id="main"
             style="background-image: url('{{asset('storage/upload/'.$route->image)}}')">
            @php

                $routes = json_decode($route->stations);
            @endphp
            <div class="section_numbers">
                @foreach($routes as $k=>$r)
                    <div class="row">
                        <a href="{{route('stations', ['route_id'=>$route->id,'arr_id'=>$k+1])}}">
                            <span class="station_{{($k+1)}}">{{($k+1)}}</span>
                            <span>{{$r->name}}</span>
                        </a>
                    </div>
                @endforeach()
            </div>
        </div>
    @endif
@endsection
