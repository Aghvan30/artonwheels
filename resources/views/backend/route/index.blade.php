@extends('layouts.main')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.routes')}}
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table">
                            <a href="{{route('routes.create')}}"
                               class="btn btn-primary">{{__('messages.add_route')}}</a>
                            <table class="table table-striped table-bordered" id="dt">

                                <thead class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>{{__('messages.title')}}</th>
                                    <th>{{__('messages.content')}}</th>
                                    <th>{{__('messages.stations')}}</th>
                                    <th>{{__('messages.photo')}}</th>
                                    <th>{{__('messages.image_map')}}</th>
                                    <th>{{__('messages.edit')}}</th>
                                    <th>{{__('messages.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))

                                    @foreach($data as $key=>$route)
                                        <tr>
                                            <td>{{$route->id}}</td>
                                            <td>{{$route->title}}</td>
                                            <td>{{$route->content}}</td>
                                            <td>
                                                @if(!empty($route->stations))
                                                    @php
                                                        $stations = json_decode($route->stations);
                                                    @endphp
                                                    @foreach($stations as $station)
                                                        <p>{{$station->name}}</p>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td><img src="{{asset('storage/upload/'.$route->image)}}" alt=""></td>
                                            <td><img src="{{asset('storage/upload/'.$route->image_map)}}" alt=""></td>
                                            <td>
                                                <a href="{{route('routes.edit',$route->id)}}"
                                                   class="btn btn-success">{{__('messages.edit')}}</a>
                                            </td>

                                            <td>
                                                <form action="{{route('routes.destroy', $route->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="_id" value="{{$route->id}}">
                                                    <button type="button"
                                                            class="btn btn-danger delete">{{__('messages.delete')}}</button>
                                                    <input type="hidden" name="url" value="{{'deleteroute'}}">
                                                </form>
                                            </td>

                                        </tr>

                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>{{__('messages.title')}}</th>
                                    <th>{{__('messages.content')}}</th>
                                    <th>{{__('messages.stations')}}</th>
                                    <th>{{__('messages.photo')}}</th>
                                    <th>{{__('messages.image_map')}}</th>
                                    <th>{{__('messages.edit')}}</th>
                                    <th>{{__('messages.delete')}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
