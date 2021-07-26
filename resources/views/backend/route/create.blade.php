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
                        <form method="post" action="{{route('routes.store')}}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group row">

                                <label for="title"
                                       class="col-lg-3 col-form-label form-control-label">{{__('messages.title')}}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">

                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.content')}}</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="content" value="{{old('content')}}">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.photo')}}</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.image_map')}}</label>
                                <div class="col-md-6">
                                    <input type="file" name="image_map" class="form-control">
                                </div>

                            </div>
                            <div class="form-group row">

                                <label
                                    class="col-lg-3 col-form-label form-control-label">{{__('messages.stations')}}</label>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <input class="form-control mt-2 col-5" type="text" name="stations[]"
                                               value="{{old('stations.0')}}">
                                        <input class="form-control col-4" type="file" name="stations_img[]">
                                    </div>
                                    <div class="row">
                                        <input class="form-control mt-2 col-5" type="text" name="stations[]"
                                               value="{{old('stations.1')}}">
                                        <input class="form-control col-4" type="file" name="stations_img[]">
                                    </div>
                                    <div class="row">
                                        <input class="form-control mt-2 col-5" type="text" name="stations[]"
                                               value="{{old('stations.2')}}">
                                        <input class="form-control col-4" type="file" name="stations_img[]">
                                    </div>
                                    <div class="row">
                                        <input class="form-control mt-2 col-5" type="text" name="stations[]"
                                               value="{{old('stations.3')}}">
                                        <input class="form-control col-4" type="file" name="stations_img[]">
                                    </div>
                                    <div class="row">
                                        <input class="form-control mt-2 col-5" type="text" name="stations[]"
                                               value="{{old('stations.4')}}">
                                        <input class="form-control col-4" type="file" name="stations_img[]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="{{__('messages.cancel')}}"/>
                                    <input type="submit" class="btn btn-info" value="{{__('messages.save')}}"/>
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


