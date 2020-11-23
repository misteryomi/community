@extends('layouts.app')

@section('content')
        <h1>Manage Roles</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            @include('layouts.partials.alert')
                            <label>Role Name <small class="text-danger">(Small caps, no space)</small></label>
                            <div class="form-group">
                                <input name="name" class="form-control" required type="text" />
                            </div>
                            @if($permissions->count() > 0)
                            <label>Attach Role (s)</label>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-6 mb-2">
                                            <input type="checkbox" value="{{ $permission->id }}" name="roles[]" /> {{ $permission->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <button type="submit" id="submit" class="btn btn-block btn-default">
                                Create Role
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>All Roles</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="solid-header">
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($roles->count() < 1)
                                        <tr><td colspan="8" class="text-center">No record found.</td></tr>
                                    @else
                                    @php $count = method_exists($roles, 'links') ? 1 : 0; @endphp
                                    @foreach($roles as $role)
                                        @php $count = method_exists($roles, 'links') ? ($roles ->currentpage()-1) * $roles ->perpage() + $loop->index + 1 : $count + 1; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->permissions->count() }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <div class="irs_pagination">
                                {{ $roles->links('layouts.pagination.custom') }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
