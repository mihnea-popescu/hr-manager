@php
    $user = \App\Models\User::find($slot)
@endphp
<p>{{ $user->is_admin ? 'Administrator' : ($user->departments->count() ? implode(',', $user->departments->pluck('name', 'id')->all()) : 'Niciunul') }}</p>