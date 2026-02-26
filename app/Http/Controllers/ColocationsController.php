<?php

namespace App\Http\Controllers;

use App\Models\colocations;
use Illuminate\Http\Request;

class ColocationsController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('colocations.create');        
    }

    public function store(Request $request)
    {
    }

    public function show(colocations $colocations)
    {
    }

    public function edit(colocations $colocations)
    {
    }

    public function update(Request $request, colocations $colocations)
    {
    }

    public function destroy(colocations $colocations)
    {
    }
}
