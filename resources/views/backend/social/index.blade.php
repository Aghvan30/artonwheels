
@extends('layouts.main')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.stations')}}
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
{{--                        @if(session()->has('danger'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                {{ session()->get('danger') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        @if(session()->has('deleted'))
                            <div class="alert alert-delete">
                                {{ session()->get('deleted') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table">
                            <a href="{{route('social.create')}}"
                               class="btn btn-primary">{{__('messages.add_route')}}</a>
                            <table class="table table-striped table-bordered" id="dt">

                                <thead class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>{{__('messages.title')}}</th>
                                    <th>{{__('messages.content')}}</th>

                                    <th>{{__('messages.edit')}}</th>
                                    <th>{{__('messages.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                       @foreach($socials as $social)
                                        <tr>
                                            <td>{{$social->id}}</td>
                                            <td>{{$social->name}}</td>
                                            <td>{{$social->link}}</td>



                                            <td>
                                                <a href="{{route('social.edit',$social->id)}}"
                                                   class="btn btn-success">{{__('messages.edit')}}</a>
                                            </td>

                                            <td>
                                                <form action="{{route('social.destroy',$social->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="_id" value="">
                                                    <button type="button"
                                                            class="btn btn-danger delete">{{__('messages.delete')}}</button>
                                                    <input type="hidden" name="url" value="{{'destroy'}}">
                                                </form>
                                            </td>

                                        </tr>

@endforeach
                                </tbody>
                                <tfoot class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>{{__('messages.title')}}</th>
                                    <th>{{__('messages.content')}}</th>

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
