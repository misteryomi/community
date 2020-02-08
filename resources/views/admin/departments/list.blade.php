@extends('layouts.app')

@section('content')
      <div class="row">
          <div class="col-12 pt-5 pb-4">
            <h4>All Departments</h4>
            <div class="text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal">
                  <span class="mdi mdi-bookmark-plus-outline mr-3"></span> Add a new department
                </button>
            </div>
          </div>
      </div>
      @include('layouts.partials.alert')
      <div class="card">
          <div class="card-body py-3">
            <p class="card-title ml-n1">All Departments</p>
          </div>
          <div class="table-responsive">
              <table class="table table-hover table-sm">
                    <thead>
                        <tr class="solid-header">
                            <th>#</th>
                            <th>Name</th>
                            <th>No of Tickets</th>
                            <th>Team Lead</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if($departments->count() < 1)
                            <tr><td colspan="6" class="text-center">No record found.</td></tr>
                        @else
                        @php $count = 1 @endphp
                        @foreach($departments as $department)
                            @php $count =  ($departments ->currentpage()-1) * $departments ->perpage() + $loop->index + 1; @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->tickets->count() }}</td>
                                <td>
                                  @if($department->team_lead)
                                    <a href="{{ route('tickets.admin.users.show', ['user' => $department->team_lead->id]) }}">{{ $department->team_lead->name }}</a>
                                  @else - @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="irs_pagination">
            {{ $departments->links() }}
            </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="form-modal" aria-modal="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h6 class="text-primary mb-4">Add a new department</h6>
              <form action="{{ route('admin.departments.post.store') }}" method="post">
              @csrf
                <div class="form-group">
                  <label>Department Name</label>
                  <input type="text" class="form-control" required name="name">
                </div>
                <div class="form-group">
                    <label for="unit">Team Lead</label>

                    <select required class="form-control select2"  name="team_lead_id" id="staff">
                        <option value="">Select team lead</option>
                        @if($vendors->count() > 0)
                        @foreach($vendors as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripts')
<script>

  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
@endsection
