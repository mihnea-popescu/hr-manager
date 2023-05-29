<?php

namespace App\Http\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService {
    public function update(User $user, $request) {
        $validated = $request->validated();

        $validated['dob'] = Carbon::parse($validated['dob'])->format('d-m-Y');

        $user->update($validated);
    }
}