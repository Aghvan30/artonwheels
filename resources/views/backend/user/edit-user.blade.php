@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>
                    <div class="card-body">
                        <form  method="post" action="{{route('users.update', $edit->id)}}">
                            @method('PUT')
                            @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="{{$edit->id}}">
                                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="name" value="{{$edit->name}}" />
                                    </div>
                                </div>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$edit->id}}">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="email" value="{{$edit->email}}" />
                                </div>
                            </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Cancel" />
                                        <input type="submit" class="btn btn-info" value="Save Changes" />
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

