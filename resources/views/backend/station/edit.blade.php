@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 five">
                <div class="card">
                    <div class="card-header">{{ __('messages.edit') }}
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

                    <div class="card-body seven">
                        <div class="row">
                            <form method="post" action="{{url('backend/stations/update/'.$data->id)}}"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                            <div class="form-group col-6">
                                <input type="hidden" name="_id" value="{{$data->id}}">
                                <input type="hidden" name="url" value="deleteimg">
                                @if(!empty($data->image))
                                    <img src="{{asset('storage/upload/'.$data->image)}}" class="route_img">
                                    <i class="fas fa-times close_img"></i>
                                    <input type="hidden" name="img" value="{{$data->image}}">
                                @else
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-6">

                                <label class="col-lg-3 col-form-label form-control-label" for="title">title</label>
                                <div class="col-lg-9">
                                    <input class="x" type="text" name="title" id="title" value="{{$data->title}}">
                                </div>
                                <label for="x">X coordinate</label>
                                <input class="x" type="text" disabled name="x" id="x" value="{{$data->lang}}">
                                <input type="hidden" name="lang" id="lang" value="{{$data->lang}}">
                                <br>
                                <label for="y">Y coordinate</label>
                                <input class="x" type="text" disabled name="y" id="y" value="{{$data->lat}}">
                                <input type="hidden" name="lat" id="lat" value="{{$data->lat}}">
                                <br>
                                <label for="content">content</label>
                                <div class="col-lg-12">
                                    <textarea name="content" class="textarea"
                                              id="content ">{{$data->content}}</textarea>
                                </div>
                                <input type="hidden" name="arr_id" value="{{$data->arr_id}}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label for="google_map">google map</label>
                                <input type="text" name="google_map" id="google_map"
                                       value="{{$data->map_coordinates}}">
                                <a target="_blank"
                                   href="https://www.google.com/maps/d/viewer?ie=UTF8&oe=UTF8&msa=0&mid=1iiBu98m68CEpAy-kQ7SrHueqCaM&ll=-35.2255242196051%2C138.64155250000002&z=10">Google
                                    map</a>

                                <button class="btn btn-success">send</button>

                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


