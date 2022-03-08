<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InviteCodeStoreController extends Controller
{
    public function __invoke()
    {
        if (request()->user()->reachedInviteCodeRequestLimit()) {
            return redirect()->back()->withErrors(['errors' => 'You have reached to the limit number of requests']);
        }
        request()->user()->inviteCodes()->create([
                                                     'code' => Str::random(8)
                                                 ]);
        return back();
    }
}
