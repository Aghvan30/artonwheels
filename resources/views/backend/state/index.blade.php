@extends('layouts.main')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.states')}}
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div  class="table-responsive table">
                            <a href="{{route('states.create')}}"
                               class="btn btn-primary">{{__('messages.add_state')}}</a>
                            <table class="table table-striped table-bordered" id="dt">

                                <thead class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>{{__('messages.title')}}</th>
                                    <th>{{__('messages.content')}}</th>
                                    <th>{{__('messages.photo')}}</th>
                                    <th>{{__('messages.lang')}}</th>
                                    <th>{{__('messages.edit')}}</th>
                                    <th>{{__('messages.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))

                                    @foreach($data as $key=>$state)
                                        <tr>
                                            <td>{{$state->id}}</td>
                                            <td>{{$state->title}}</td>
                                            <td>{{$state->content}}</td>
                                            <td><img src="{{asset('storage/upload/'.$state->image)}}" alt=""></td>

                                            <td>
                                                <a href="{{route('states.edit',$state->id)}}"
                                                   class="btn btn-success">{{__('messages.edit')}}</a>
                                            </td>

                                            <td>
                                                <form action="{{route('states.destroy', $state->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="_id" value="{{$state->id}}">
                                                    <button type="button" class="btn btn-danger delete">{{__('messages.delete')}}</button>
                                                    <input type="hidden" name="url" value="{{'deletestate'}}">
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
