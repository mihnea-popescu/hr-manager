@extends('layouts.master')

@section('content')

<a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary mb-4">
    <i class="ti ti-ballpen mx-1"></i>
    Editează
</a>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $user->getProfilePicture() }}" alt="Profile Picture" height="200">
            </div>
            <div class="col-md-8">
                <h4>Nume:</h4>
                <p>{{ $user->name }}</p>
                <h4>Email:</h4>
                <p>{{ $user->email }}</p>
                <h4>Administrator:</h4>
                <p>{{ $user->is_admin ? 'Da' : 'Nu' }}</p>
                <h4>Data nașterii:</h4>
                <p>{{ $user->dob }}</p>
                <h4>Data înregistrării:</h4>
                <p>{{ $user->created_at->format('d-m-Y') }}</p>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
      <tr>
        <th colspan="4">
          <a href="{{ route('department-user.create', ['user_id' => $user->id]) }}" class="btn btn-primary">
            <i class="ti ti-plus"></i>
          </a>
        </th>
      </tr>
      <tr>
        <th>Department</th>
        <th>Manager</th>
        <th>Angajat la</th>
        <th>Acțiuni</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user->departmentUsers as $row)
      <tr>
        <td>{{ $row->department->name }}</td>
        <td>{{ $row->manager ? 'Da' : 'Nu' }}</td>
        <td>{{ $row->created_at->format('d-m-Y H:i') }}</td>
        <td>
            <div class="d-inline-flex">
                @if(auth()->user()->is_admin)
                    @if($row->manager)
                        <button class="btn btn-danger manager-btn"
                                data-url="{{ route('department-user.manager', ['departmentUser' => $row->id]) }}" title="Șterge rangul de manager">
                            <i class="ti ti-arrow-bar-to-down"></i>
                        </button>
                    @else
                        <button class="btn btn-success manager-btn"
                                data-url="{{ route('department-user.manager', ['departmentUser' => $row->id]) }}" title="Promovează la rangul de manager">
                            <i class="ti ti-arrow-bar-to-up"></i>
                        </button>
                    @endif
                @endif
                <button class="btn btn-danger delete-btn mx-2"
                    data-url="{{ route('department-user.destroy', ['department_user' => $row->id]) }}">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.manager-btn').forEach(function(button) {
      button.addEventListener('click', function() {
        var deleteUrl = this.getAttribute('data-url');
  
        Swal.fire({
          title: 'Confirmare',
          text: 'Sunteți sigur că doriți să actualizați statusul acestui angajat?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Da',
          cancelButtonText: 'Anulează'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
  
            var csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = '{{ csrf_token() }}';
  
            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
  
            form.appendChild(csrfField);
            form.appendChild(methodField);
  
            document.body.appendChild(form);
            form.submit();
          }
        });
      });
    });

    document.querySelectorAll('.delete-btn').forEach(function(button) {
      button.addEventListener('click', function() {
        var deleteUrl = this.getAttribute('data-url');
  
        Swal.fire({
          title: 'Confirmare',
          text: 'Sunteți sigur că doriți să ștergeți acest utilizator de departament?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Da',
          cancelButtonText: 'Anulează'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
  
            var csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = '{{ csrf_token() }}';
  
            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
  
            form.appendChild(csrfField);
            form.appendChild(methodField);
  
            document.body.appendChild(form);
            form.submit();
          }
        });
      });
    });
  </script>
@endpush