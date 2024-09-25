<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        return inertia('Library/Index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Library $library)
    {
        //
    }

    public function edit(Library $library)
    {
        //
    }

    public function update(Request $request, Library $library)
    {
        //
    }

    public function destroy(Library $library)
    {
        //
    }
}
