<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DrugRecord;
use App\Models\MedicalRecord;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ViewFinderInterface;

class ReminderController extends Controller
{
    public function index($id){
        $reminders = Reminder::where('user_id', '=', $id)->where('status', '=', 0)->get();
        if ($reminders) {
            return response()->json(compact('reminders'));
            // return view('users.reminderObat', compact('reminders'));
        }
        return redirect()->back()->withErrors(['header'=> 'GAGAL', 'message' => 'Tidak dapat menampilkan reminder']);
    }
    public function updateStatus(Request $request)
    {
        // Ambil data dari request
        $timeId = $request->time_id;
        $reminderId = $request->reminder_id;

        // Fetch the reminder from the database
        $reminder = DB::table('reminder_times')->where('time_id', $timeId)->where('reminder_id', $reminderId)->first();

        // Check if the reminder exists
        if (!$reminder) {
            return response()->json(['header' => 'GAGAL', 'message' => 'Pengingat tidak ditemukan!'], 404);
        }

        // Toggle the status (0 or 1)
        $newStatus = ($reminder->status == 1) ? 0 : 1;

        // Update the status in the database
        DB::table('reminder_times')
            ->where('time_id', $timeId)
            ->where('reminder_id', $reminderId)
            ->update(['status' => $newStatus]);

    return response()->json(['header' => 'SUKSES', 'message' => 'Status Pengingat diubah!']);
    }
}
