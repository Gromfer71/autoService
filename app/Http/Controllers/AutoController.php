<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function index()
    {
        //
    }

    public function take(Request $request)
    {
        $auto = Auto::findOrFail($request->id);
        if($auto->busy_until) {
            return back();
        }

        $auto->user_id = auth()->id();
        $auto->busy_until = now()->addMinutes($request->minutes);
        $auto->save();

        return back();
    }
}
