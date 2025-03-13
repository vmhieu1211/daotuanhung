@extends('layouts.app')

@section('content')
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-dectoration-none mr-3">
                <li class="breadcrumb-item">Home</li>
            </a>
            <li class="breadcrumb-item active">Role</li>
        </ol>

    </nav>

    <div class="card">
        <div class="card-header">Role
            <a href="{{ route('roles.create') }}" class="btn btn-dark">Add Role</a>

        </div>
        <div class="card-body">
            <table class="table table-dark table-bordered table-hover">
                <thead>
                    <th>Role</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $roles->links() }}
        </div>
    </div>
@endsection
