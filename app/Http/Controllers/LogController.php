<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return Log::all();
    }

    public function show(Log $log)
    {
        return $log;
    }

    public function store(Request $request)
    {
        $log = Log::create($request->all());
        return response()->json($log, 201);
    }

    public function update(Request $request, Log $log)
    {
        $log->update($request->all());
        return response()->json($log);
    }

    public function destroy(Log $log)
    {
        $log->delete();
        return response()->json(null, 204);
    }
}