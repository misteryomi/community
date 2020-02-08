@extends('layouts.app')

@section('content')
      <div class="row">
          <div class="col-12 pt-5 pb-4">
            <h4>All Units</h4>
            <div class="text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal">
                  <span class="mdi mdi-bookmark-plus-outline mr-3"></span> Add a new unit
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#assign-modal">
                  <span class="mdi mdi-users mr-3"></span> Assign user to unit
                </button>
            </div>
          </div>
      </div>
      <div class="card">
          <div class="card-body py-3">
            <p class="card-title ml-n1">All Units</p>
          </div>
          <div class="table-responsive">
              <table class="table table-hover table-sm">
                    <thead>
                        <tr class="solid-header">
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>No of Tickets</th>
                            <th>No of Staff</th>
                            <th>Team Lead</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if($units->count() < 1)
                            <tr><td colspan="6" class="text-center">No record found.</td></tr>
                        @else
                        @php $count = 1 @endphp
                        @foreach($units as $unit)
                            @php $count =  ($units ->currentpage()-1) * $units ->perpage() + $loop->index + 1; @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td><a href="{{ route('admin.units.show', ['unit' => $unit->id]) }}">{{ $unit->name }}</a></td>
                                <td>{{ $unit->department->name }}</td>
                                <td>{{ $unit->tickets->count() }}</td>
                                <td>{{ $unit->staff->count() }}</td>
                                <td>
                                    @if($unit->team_lead)
                                     <a href="{{ route('tickets.admin.users.show', ['user' => $unit->team_lead->id]) }}">{{ $unit->team_lead->name }}</a>`
                                    @else - @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="irs_pagination">
            {{ $units->links() }}
            </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="form-modal" aria-modal="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h6 class="text-primary mb-4">Add a new unit</h6>

              <div class="item-wrapper">
                  <form id="create-form" action="#" method="POST">
                      <div class="form-group">
                              <label for="category">Name</label>
                                  <input class="form-control" name="name" />
                                  <p class="invalid-feedback" id="name"></p>
                      </div>
                      <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control departments" name="department_id">
                                <option value="">Select a Department</option>
                            </select>
                            <p class="invalid-feedback" id="department_id"></p>
                      </div>
                      <div class="form-group">
                            <label for="category">Group Email Address</label>
                            <input class="form-control" name="group_email" />
                            <p class="invalid-feedback" id="group_email"></p>
                      </div>
                    <div class="form-group">
                        <label for="unit">Team Lead</label>

                        <select required class="form-control select2" name="team_lead_id" id="staff">
                            <option value="">Select team lead</option>
                            @if($vendors->count() > 0)
                            @foreach($vendors as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                      <button type="submit" class="btn btn-sm btn-primary">
                        <div class="spinner-grow spinner-grow-md mr-1 animate-this d-none" id="processing" role="status"><span class="sr-only">Loading...</span></div>
                            Create Unit
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
              <h6 class="text-primary mb-4">Assign staff to unit</h6>

              <div class="item-wrapper">
                    <form id="assign-form" action="#" method="POST">
                          <div class="form-group">
                                  <label for="department">Department</label>
                                  <select class="form-control departments" name="department_id">
                                      <option value="">Select a Department</option>
                                  </select>
                                  <p class="invalid-feedback" id="department_id"></p>
                          </div>
                          <div class="form-group">
                                  <label for="unit">Unit</label>
                                  <select class="form-control" disabled name="unit_id" id="units">
                                      <option value="">Select a Unit</option>
                                  </select>
                                  <p class="invalid-feedback" id="unit_id"></p>
                          </div>
                          <div class="form-group">
                                  <label for="unit">Staff</label>

                                  <select class="form-control select2"  name="staff_ids[]" id="staff"  multiple="multiple">
                                      <option value="">Select staff</option>
                                      @if($users->count() > 0)
                                      @foreach($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                                      @endforeach
                                      @endif
                                  </select>
                                  <p class="invalid-feedback" id="staff_ids"></p>
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

    //   $('.select2').select2();

        //fetch depts
        $.get("{{ route('api.departments.list') }}", (res) => {
            departments = res.data;
            //append depts
            appendItems(departments, '.departments');
        });


        //load units
        $('.departments').change(function(e) {
            units = departments.filter(item => item.id == e.target.value)[0].units;

            appendItems(units, '#units');
            $('#units').removeAttr('disabled');
        })

        //load categories
        $('#units').change(function(e) {
            categories = units.filter(item => item.id == e.target.value)[0].categories;

            appendItems(categories, '#categories');
            $('#categories').removeAttr('disabled');
            // console.log('success', units);
        })


        $('#create-form').submit(function(e) {
            e.preventDefault();

            let formObj = {};
            let formData = $(this).serializeArray();

            formData.forEach((item) => {
                formObj[item.name] = item.value
            });

            $.post("{{ route('admin.units.post.store') }}", formData)
            .done((res) => {
                alert(`Unit created successfully! . Click OK to continue`);
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
                alert(`Assignment has been successfully processed! . Click OK to continue`);
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
        items.forEach((item) => {
                $(field).append(`<option value="${item.id}">${item.name}</option>`);
        })
    }

</script>
@endsection
