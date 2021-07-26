@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.add_route') }}
                        @if(session()->has('danger'))
                            <div class="alert alert-danger">
                                {{ session()->get('danger') }}
                            </div>
                        @endif

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <select name="route" id="route">
                            <option>{{__('messages.select_route')}}</option>
                            @if(!empty($routes))

                                @foreach($routes as $key=>$route)

                                    <option value="{{$key}}">{{$route}}</option>
                                    @endforeach
                            @endif
                        </select>
                        <input type="hidden" name="url" value="getRouteById">
                        <div class="route_info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


