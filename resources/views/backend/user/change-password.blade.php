@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Edit')." ".$edit->name }} </div>

                    <div class="card-body">
                        @if (Session::has('danger'))
                            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
                        @endif
                    </div>

                        <form  method="post" action="{{route('changepass')}}">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$edit->id}}">
                                <label class="col-lg-3 col-form-label form-control-label">Old Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="old_pass" id="old_pass" value="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$edit->id}}">
                                <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="new_pass" id="new_pass" value="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{$edit->id}}">
                                <label class="col-lg-3 col-form-label form-control-label">Confirm Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="c_pass" id="c_pass" value="" />
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

