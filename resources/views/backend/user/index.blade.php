@extends('layouts.main')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.Users')}}</div>

                    <div class="card-body">
                        <div border="1" class="table-responsive">
                            <a href="{{route('users.create')}}"
                               class="btn btn-primary">{{__('messages.add_user')}}</a>
                            <table class="table table-striped table-bordered" id="dt">

                                <thead class="text-primary">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Change password</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($users))

                                    @foreach($users as $key=>$user)


                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <a href="{{route('users.edit',$user->id)}}"
                                                   class="btn btn-success">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{url('/backend/users/editpass',$user->id)}}"
                                                   class="btn btn-primary"><i class="fas fa-unlock-alt"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{route('users.destroy', $user->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>

                                        </tr>

                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot class="text-primary">
                                <tr>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Change password</th>
                                    <th>Delete</th>
                                </tr>
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
