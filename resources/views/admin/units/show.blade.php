@extends('layouts.app')

@section('content')
      <div class="row">
          <div class="col-12 pt-5 pb-4">
            <h4 class="mb-2">Unit: {{ $unit->name }}</h4>
            @if($unit->team_lead)
            <p><strong>Team Lead: </strong> <a href="{{ route('tickets.admin.users.show', ['user' => $unit->team_lead->id]) }}">{{ $unit->team_lead->name }}</a>
            @endif
            <div class="text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assign-modal">
                  <span class="mdi mdi-bookmark-plus-outline mr-3"></span> Assign a new vendor
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form-modal">
                  <span class="mdi mdi-pen mr-3"></span> Edit Unit
                </button>
            </div>
          </div>
      </div>
      @include('layouts.partials.alert')
      <div class="card">
          <div class="card-body py-3">
            <p class="card-title ml-n1">Filter Results</p>
            @include('tickets.admin.users.filter_template')
          </div>
          <div class="table-responsive">
              <table class="table table-hover table-sm">
                    <thead>
                        <tr class="solid-header">
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Department</th>
                            <th>No of Tickets Assigned</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($staff->count() < 1)
                            <tr><td colspan="8" class="text-center">No record found.</td></tr>
                        @else
                        @php $count = 1 @endphp
                        @foreach($staff as $user)
                            @php $count =  ($staff ->currentpage()-1) * $staff ->perpage() + $loop->index + 1; @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td><a href="{{ route('tickets.admin.users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->unit && $user->unit->unit ? $user->unit->unit->name : '-' }}</td>
                                <td>{{ $user->unit && $user->unit->unit ? $user->unit->unit->department->name : '-' }}</td>
                                <td>{{ $user->assignedTickets->count() }}</td>
                                <td>
                                    <a href="{{ request()->fullUrlWithQuery(['remove'=> true, 'user_id' => $user->id]) }}">Remove Vendor</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="irs_pagination">
            {{ $staff->links() }}
            </div>
      </div>


      <div class="modal fade" tabindex="-1" role="dialog" id="form-modal" aria-modal="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <h6 class="text-primary mb-4">Edit unit</h6>

                  <div class="item-wrapper">
                      <form id="update-form" action="#" method="POST">
                          <div class="form-group">
                                <label for="category">Name</label>
                              <input class="form-control" name="name" value="{{ $unit->name }}" />
                                <p class="invalid-feedback" id="name"></p>
                          </div>
                          <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control departments" name="department_id">
                                    <option value="">Select a Department</option>
                                    @foreach($departments as $department)
                                        <option {{ $department->id == $unit->department_id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <p class="invalid-feedback" id="department_id"></p>
                          </div>
                          <div class="form-group">
                              <label for="category">Group Email Address</label>
                              <input class="form-control" name="group_email" value="{{ $unit->group_email }}" />
                              <p class="invalid-feedback" id="group_email"></p>
                          </div>
                          <div class="form-group">
                              <select class="form-control select2"  name="team_lead_id" id="team_lead_id">
                                <option value="">Select team lead</option>
                                @if($vendors->count() > 0)
                                @foreach($vendors as $user)
                                <option value="{{ $user->id }}" {{ $unit->team_lead_id == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                @endforeach
                                @endif
                            </select>
                          </div>

                          <button type="submit" class="btn btn-sm btn-primary">
                            <div class="spinner-grow spinner-grow-md mr-1 animate-this d-none" id="processing" role="status"><span class="sr-only">Loading...</span></div>
                                Update Unit
                          </button>
                        </form>

                      </div>


                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" tabindex="-1" role="dialog" id="assign-modal" aria-modal="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <h6 class="text-primary mb-4">Assign Vendor to unit</h6>

                  <div class="item-wrapper">
                        <form id="assign-form" action="#" method="POST">
                              <div class="form-group">
                                      <label for="unit">Staff</label>

                                      <select class="form-control select2"  name="staff_ids[]" id="staff"  multiple="multiple">
                                          <option value="">Select staff</option>
                                          @if($vendors->count() > 0)
                                          @foreach($vendors as $user)
                                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                                          @endforeach
                                          @endif
                                      </select>
                                      <p class="invalid-feedback" id="staff_ids"></p>
                                    <input type="hidden" name="department_id" value="{{ $unit->department_id }}" />
                                    <input type="hidden" name="unit_id" value="{{ $unit->id }}" />
                              </div>
                              <button type="submit" class="btn btn-sm btn-primary">
                                  <div class="spinner-grow spinner-grow-md mr-1 animate-this d-none" id="processing" role="status"><span class="sr-only">Loading...</span></div>
                                      Save Record
                              </button>
                          </form>


                      </div>


                </div>
              </div>
            </div>
          </div>

@endsection
@section('scripts')
<script>
    var departments = [];
    var units = [];


    $(document).ready(function() {

      $('.select2').select2();



        $('#update-form').submit(function(e) {
            e.preventDefault();

            let formObj = {};
            let formData = $(this).serializeArray();

            formData.forEach((item) => {
                formObj[item.name] = item.value
            });

            $.post("{{ route('admin.units.post.update', ['unit_id' => $unit->id]) }}", formData)
            .done((res) => {
                alert(`Unit updated successfully! . Click OK to continue`);
                window.location.reload();
            })
            .fail((err) => {
                if(err.status == 422) {
                    $.each(err.responseJSON.errors, (index, value) => {
                        $(`p#${index}`).text(value);
                    })
                    // console.log(err);
                } else {
                    alert('An error occured. Please try again');
                }
            });
        })

        $('#assign-form').submit(function(e) {
            e.preventDefault();

            let formObj = {};
            let formData = $(this).serializeArray();

            formData.forEach((item) => {
                formObj[item.name] = item.value
            });

            $.post("{{ route('admin.units.assign.post.store') }}", formData)
            .done((res) => {
                alert(`Staff successfully assigned as vendor! . Click OK to continue`);
                window.location.reload();
            })
            .fail((err) => {
                if(err.status == 422) {
                    $.each(err.responseJSON.errors, (index, value) => {
                        $(`p#${index}`).text(value);
                    })
                    // console.log(err);
                } else {
                    alert('An error occured. Please try again');
                }
            });
        })
    });


    function appendItems(items, field) {
        $(field).html('');
        $(field).append(`<option value="">Select an option</option>`);
        items.forEach((item) => {
                $(field).append(`<option value="${item.id}">${item.name}</option>`);
        })
    }

</script>
@endsection
