<?php

namespace App\Http\Controllers;

use App\Models\ErrorReport;
use Illuminate\Http\Request;

class ErrorReportController extends Controller
{
    public function index(Request $request)
    {

        return inertia('ErrorReport/Index');

    }

    public function store(Request $request) 
    {
        $request->validate([
            'subject' => 'required|max:50',
            'content' => 'required',
            'is_error' => 'required',
        ]);
        
        $report = ErrorReport::create($request->validated() + ['user_id' => auth()->id()]);
        $report->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        return redirect()->route('error-reports.index')->with('message','Se ha enviado tu reporte. Muchas gracias por tu retroalimentación');
    }
    
    public function markAsRead(ErrorReport $error) 
    {
        $error->update(['is_read'  => 1]);
        return redirect()->route('admin.errors')->with('message', 'Marcado como leido');
    }
}
