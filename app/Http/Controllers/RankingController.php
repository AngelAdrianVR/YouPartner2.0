<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function ranking(){

        return inertia('Ranking/Ranking');
    }

    public function awards(){

        return inertia('Ranking/Awards');
    }

    public function motivation(){

        return inertia('Ranking/Motivation');
    }

    public function levels(){

        return inertia('Ranking/Levels');
    }
}
