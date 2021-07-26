@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}

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
                        <form method="post" action="{{route('routes.update', $data->id)}}"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.title')}}</label>
                                <div class="col-lg-9">
                                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                                           name="title" value="{{$data->title}}"/>
                                </div>
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.content')}}</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="content" value="{{$data->content}}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $stations = json_decode($data->stations);
                                @endphp
                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.stations')}}</label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="route_id" value="{{$data->id}}">
                                    <input type="hidden" name="url_st" value="deletestationimg">
                                    @foreach ($stations as $key=>$station)
                                        <div class="row">
                                            <input class="form-control mt-2 col-8" type="text" name="stations[]"
                                                   value="{{$station->name}}">
                                            @if(!empty($station->img_name))
                                                <div class="col-lg-3">
                                                    <img src="{{asset('storage/upload/'.$station->img_name)}}"
                                                         class="route_img">
                                                    <i class="fas fa-times close_st"></i>
                                                    <input type="hidden" name="stationsImg[{{$key}}]"
                                                           value="{{$station->img_name}}">
                                                </div>
                                                <input type="hidden" name="arr_id" value="{{$key}}">
                                            @else
                                                <div class="form-group row">
                                                    <div class="col-md-12 mt-4">
                                                        <input type="file" name="stations_img[{{$key}}]"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.stations_img')}}</label>
                                <input type="hidden" name="_id" value="{{$data->id}}">
                                <input type="hidden" name="url" value="deleterouteimg">
                                @if(!empty($data->image))
                                    <div class="col-lg-3">
                                        <img src="{{asset('storage/upload/'.$data->image)}}" class="route_img">
                                        <i class="fas fa-times close"></i>
                                    </div><input type="hidden" name="img" value="{{$data->image}}">
                                @else
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                    </div>
                                @endif
                                @if(!empty($data->image_map))
                                    <div class="col-lg-3">
                                        <img src="{{asset('storage/upload/'.$data->image_map)}} " class="route_img">
                                        <i class="fas fa-times close"></i>
                                    </div>
                                    <input type="hidden" name="img" value="image_map">
                                @else
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <input type="file" name="image_map"
                                                   class="form-control @error('title') is-invalid @enderror">
                                        </div>

                                    </div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9 flex">
                                    <input type="reset" class="btn btn-secondary" value="{{__("messages.cancel")}}"/>
                                    <input type="submit" class="btn btn-info plus" value="{{__("messages.save")}}"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

