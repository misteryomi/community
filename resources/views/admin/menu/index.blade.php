@extends('layouts.app')

@section('content')
        <h1>Manage Menus</h1>
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Menu</h4>
                    </div>
                    <div class="card-body">
                    <div class="item-wrapper">
                        <form action="{{ route('admin.menus.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select id="type" class="form-control" required>
                                <option value="">Select route type</option>
                                <option value="laravel_route">Laravel Route</option>
                                <option value="external_route">External URL</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:none" id="laravel_route">
                            <input name="route" class="form-control" type="text" placeholder="Route Name" />
                        </div>
                        <div class="form-group" style="display:none"  id="external_route">
                            <input name="url" class="form-control" type="text" placeholder="URL"/>
                        </div>
                        <div class="form-group">
                            <input name="title" class="form-control" required type="text" placeholder="Menu Title" />
                        </div>
                        <div class="form-group">
                            <input name="icon" class="form-control" type="text" placeholder="Icon (font-awesome)" />
                        </div>
                        @if($menus->where('is_parent', 1)->count() > 0)
                        <div class="form-group" required>
                            <select name="parent_id" class="form-control" >
                                <option value="">Select Parent Menu</option>
                                <option value="">No Parent Menu</option>
                                @foreach($menus->where('is_parent', 1) as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Attach Role(s)</small></label> <br/>
                            @foreach($roles as $role)
                                <p><input type="checkbox" value="{{ $role->id }}" name="roles[]" /> {{ $role->name }} <br/>
                            @endforeach
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label>Attach Permission(s)</small></label> <br/>
                            @foreach($permissions as $permission)
                                <p><input type="checkbox" value="{{ $permission->id }}" name="permission[]" /> {{ $permission->name }} <br/>
                            @endforeach
                        </div>

                        <button type="submit" id="submit" class="btn btn-block btn-default">
                            Create Menu
                        </button>
                    </form>

                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>All Menus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="solid-header">
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Parent Menu</th>
                                        <th>Role(s)</th>
                                        <th>Permission(s)</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @if($menus->count() < 1)
                                        <tr><td colspan="8" class="text-center">No record found.</td></tr>
                                    @else
                                    @foreach($menus as $menu)
                                            <td>{{ $count }}</td>
                                            <td><a href="{{ $menu->route ? route($menu->route) : $menu->url}}">{{ $menu->title }}</a>                                            </td>
                                            <td>{{ ($menu->parent()) ? $menu->parent()->title : '' }}</a>                                            </td>
                                            <td>
                                                @foreach($menu->roles as $role)
                                                {{ $role->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($menu->permissions as $permission)
                                                {{ $permission->name }},
                                                @endforeach
                                            </td>
                                            <td>{{ $menu->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <a href="{{ route('admin.menus.edit', ['menu' => $menu->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pen"></i>
                                                <a href="{{ route('admin.menus.delete', ['menu' => $menu->id]) }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i>
                                            </td>
                                        </tr>
                                        @php $count++; @endphp
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#type').change(function(e) {
            let id = $(this).val();
            if(id == 'laravel_route') {
                $('#laravel_route').fadeIn();
                $('#external_route').fadeOut();
            } else {
                $('#external_route').fadeIn();
                $('#laravel_route').fadeOut();
            }
        })
    })
</script>
@endsection
