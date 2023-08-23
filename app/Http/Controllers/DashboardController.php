<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Retweet;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $activities = Activity::where('user_id', auth()->id())
            ->with('action')
            ->with([
                'post' => function (Builder|\Illuminate\Database\Eloquent\Builder $query) {
                    return $query
                        ->with('user')
                        ->with('retweets');
                },
            ])
            ->latest()
            ->take(1)
            ->get();


        return response()->json($activities);

//        return view('dashboard', [
//            'activities' => $activities
//        ]);

    }
}
