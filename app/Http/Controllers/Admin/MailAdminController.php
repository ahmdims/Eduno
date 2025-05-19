<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailAdminController extends Controller
{
    public function index(Request $request)
    {
        $mails = Mail::orderBy('created_at', 'desc')->get();

        return view('admin.mail.index', compact('mails'));
    }

    public function show($id)
    {
        $mail = Mail::findOrFail($id);
        return response()->json($mail);
    }

    public function destroy($id)
    {
        $mail = Mail::findOrFail($id);

        $mail->delete();

        return redirect()->route('admin.mail.index')->with('success', 'Mail deleted successfully!');
    }
}
