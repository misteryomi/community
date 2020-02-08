@extends('layouts.app')

@section('content')
        <h1>Manage Menus</h1>
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Menu</h4>
                    </div>
                    <div class="card-body">
                    <div class="item-wrapper">
                        <form action="{{ route('admin.menus.update', ['menu' => $menu->id]) }}" method="POST">
                        @csrf
                        @if($menu->route)
                        <div class="form-group">
                            <input name="route" class="form-control" type="text" value="{{ $menu->route }}" placeholder="Route Name" />
                        </div>
                        @else
                        <div class="form-group">
                            <input name="url" class="form-control" type="text" value="{{ $menu->url }}" placeholder="URL"/>
                        </div>
                        @endif
                        <div class="form-group">
                            <input name="title" class="form-control" required  value="{{ $menu->title }}" type="text" placeholder="Menu Title" />
                        </div>
                        <div class="form-group">
                            <input name="icon" class="form-control"  value="{{ $menu->icon }}" type="text" placeholder="Icon (font-awesome)" />
                        </div>
                        @if($menu->is_parent && $menus->where('is_parent', 1)->count() > 0)
                        <div class="form-group" required>
                            <select name="parent_id" class="form-control" id="parent_menu"  value="{{ $menu->parent_id }}" >
                                <option value="">Select Parent Menu</option>
                                <option value="null" @if(!$menu->parent_id) selected @endif>No Parent Menu</option>
                                @foreach($menus->where('is_parent', 1) as $p_menu)
                                    <option value="{{ $p_menu->id }}">{{ $p_menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if($menu->is_parent && $menus->where('is_parent', 1)->count() > 0)
                        <div class="form-group" style="display:none"  id="menu_position">
                            <select name="parent_order" class="form-control"  value="{{ $menu->parent_id }}" >
                                <option value="">Menu Position</option>
                                @foreach($menus->where('is_parent', 1) as $_menu)
                                    <option value="{{ $_menu->parent_order }}">Before {{ $_menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if($menu->parent() && $menu->parent()->children()->count() > 0)
                        <div class="form-group">
                            <select name="child_order" class="form-control"  value="{{ $menu->parent_id }}" >
                                <option value="">Menu Position</option>
                                @foreach($menu->parent()->children() as $menu)
                                    <option value="{{ $menu->child_order }}">Before {{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Attach Role(s)</small></label> <br/>
                            @foreach($roles as $role)
                                <p><input type="checkbox" value="{{ $role->id }}" name="roles[]" @if(in_array($role->id, $menu->roles()->pluck('role_id')->toArray())) checked @endif/> {{ $role->name }} <br/>
                            @endforeach
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label>Attach Permission(s)</small></label> <br/>
                            @foreach($permissions as $permission)
                                <p><input type="checkbox" value="{{ $permission->id }}" name="permission[]" @if(in_array($permission->id, $menu->permissions()->pluck('permission_id')->toArray())) checked @endif/> {{ $permission->name }} <br/>
                            @endforeach
                        </div>

                        <button type="submit" id="submit" class="btn btn-block btn-default">
                            Update Menu
                        </button>
                    </form>

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

        $('#parent_menu').change(function() {
            if($(this).val() == 'null') {
                $('#menu_position').fadeIn();
            } else {
                $('#menu_position').fadeOut();
            }
        })
    })
</script>
@endsection
