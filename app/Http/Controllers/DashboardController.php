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
            ->with('user')
            ->with('action')
            ->with([
                'post' => function (Builder|\Illuminate\Database\Eloquent\Builder $query) {
                    return $query
                        ->with('user')
                        ->with('retweets', fn(Builder|\Illuminate\Database\Eloquent\Builder $query) => $query
                            ->where('user_id', auth()->id())
                        );
                },
            ])
            ->latest('id')
            ->take(3)
            ->get();


        return response()->json($activities);

//        return view('dashboard', [
//            'activities' => $activities
//        ]);

    }
}
