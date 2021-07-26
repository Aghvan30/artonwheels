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
                        @if(!empty($data->name))
                        <h2>{{$data->name}}</h2>
                        @endif
                        @if(!empty($data->img_name))
                        <img src="{{asset('storage/upload/'.$data->img_name)}} " class="lat" width="500">
                        @endif
                        <div class="all">
                            <form method="post" action="{{route('stations.store')}}" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <label for="title">title</label>
                                <input type="text" name="title" id="title">
                                <br>
                                <label for="x">X coordinate</label>
                                <input type="text" disabled name="x" id="x">
                                <input type="hidden" name="lang" id="lang" value="">
                                <br>
                                <label for="y">Y coordinate</label>
                                <input type="text" disabled name="y" id="y">
                                <input type="hidden" name="lat" id="lat" value="">
                                <br>
                                <label for="content">content</label>
                                <textarea name="content" id="content"></textarea>
                                <br>
                                <input type="hidden" name="arr_id" value="{{$data->arr_id}}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label for="google_map">google map</label>
                                <input type="text" name="google_map" id="google_map">
                                <a target="_blank"
                                   href="https://www.google.com/maps/d/viewer?ie=UTF8&oe=UTF8&msa=0&mid=1iiBu98m68CEpAy-kQ7SrHueqCaM&ll=-35.2255242196051%2C138.64155250000002&z=10">Google
                                    map</a>
                                <input type="file" name="image" class="file">
                                <button class="btn btn-success">send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


