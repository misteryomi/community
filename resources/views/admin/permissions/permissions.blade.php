@extends('layouts.app')

@section('content')
        <h1>Manage Permissions</h1>
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Permission</h4>
                    </div>
                    <div class="card-body">
                    <div class="item-wrapper">
                        <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label>Permission Name <small class="text-danger">(Small caps, no space)</small></label>
                            <input name="name" class="form-control" required type="text" />
                        </div>
                        @if($roles->count() > 0)
                        <div class="form-group">
                            <label>Attach Role (s)</small></label> <br/>
                            @foreach($roles as $role)
                                <p><input type="checkbox" value="{{ $role->id }}" name="roles[]" /> {{ $role->name }} <br/>
                            @endforeach
                        </div>
                        @endif
                        <button type="submit" id="submit" class="btn btn-block btn-default">
                            Create Permission
                        </button>
                    </form>

                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>All Permissions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="solid-header">
                                        <th>#</th>
                                        <th>Permission</th>
                                        <th>Role</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($permissions->count() < 1)
                                        <tr><td colspan="8" class="text-center">No record found.</td></tr>
                                    @else
                                    @php $count = method_exists($permissions, 'links') ? 1 : 0; @endphp
                                    @foreach($permissions as $permission)
                                        @php $count = method_exists($permissions, 'links') ? ($permissions ->currentpage()-1) * $permissions ->perpage() + $loop->index + 1 : $count + 1; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->role ? $permission->role->name : '' }}</td>
                                            <td>{{ $permission->created_at }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <div class="irs_pagination">
                                {{ $permissions->links('layouts.pagination.custom') }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
