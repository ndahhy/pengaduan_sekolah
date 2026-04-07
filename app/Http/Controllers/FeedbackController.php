<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'aspirasi_id'=>'required',
            'isi_feedback'=>'required'
        ]);

        Feedback::create([
            'aspirasi_id'=>$request->aspirasi_id,
            'isi_feedback'=>$request->isi_feedback,
            'tanggal'=>now()
        ]);

        return back();
    }

    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'isi_feedback'=>'required'
        ]);

        $feedback->update([
            'isi_feedback'=>$request->isi_feedback,
            'tanggal'=>now()
        ]);

        return back();
    }
}