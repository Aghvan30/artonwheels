@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        <form  method="post" action="{{route('routes.update', $data->id)}}">
                            @method('PUT')
                            @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <label class="col-lg-3 col-form-label form-control-label">{{__('messages.title')}}</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="title" value="{{$data->title}}" />
                                    </div>
                                </div>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label class="col-lg-3 col-form-label form-control-label">{{__('messages.content')}}</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="content" value="{{$data->content}}" />
                                </div>
                            </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="{{__("messages.cancel")}}" />
                                        <input type="submit" class="btn btn-info" value="{{__("messages.save")}}" />
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

