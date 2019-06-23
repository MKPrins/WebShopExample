@extends('layouts.default-container')

@section('content')

    <div class="admin-data-overview">

        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            @foreach($Users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getFullAddress() }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="/Admin/UserEdit/{{ $user->id }}" >
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/Admin/UserDel/{{ $user->id }}" >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

@endsection