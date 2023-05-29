@php
    $user = \App\Models\User::find($slot)
@endphp


<div class="d-inline-flex">
    <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-sm btn-primary mx-2" title="Vezi utilizatorul">
      <i class="ti ti-eye"></i>
    </a>
  
    @if(auth()->user()->is_admin)
        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-success">
            <i class="ti ti-ballpen"></i>
        </a>

        <a user-id="{{ $user->id }}" href="{{ route('user.destroy', ['user' => $user->id]) }}" class="btn btn-sm btn-danger mx-2">
            <i class="ti ti-x"></i>
        </a>

        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" class="delete-button-form" user-id="{{ $user->id }}" method="POST">
            @csrf
            @method('DELETE')
        </form>

        <script defer>
            document.querySelector('a[user-id="{{ $user->id }}"]').addEventListener('click', function(event) {
              event.preventDefault(); 
              Swal.fire({
                title: 'Ești sigur?',
                text: 'Ești sigur că vrei să ștergi acest utilizator?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Da',
                cancelButtonText: 'Nu',
              }).then((result) => {
                if (result.isConfirmed) {
                  if(document.querySelector('.delete-button-form[user-id="' + event.target.getAttribute('user-id') + '"]') !== null) {
                    document.querySelector('.delete-button-form[user-id="' + event.target.getAttribute('user-id') + '"]').submit();
                  }
                  // document.querySelector('.delete-button-form[user-id="' + event.target.getAttribute('user-id') + '"]').submit();
                }
              });
            });
          </script>
    @endif
</div>
  