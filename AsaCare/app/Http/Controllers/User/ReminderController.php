<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\DrugRecord;
use App\Models\MedicalRecord;
use App\Models\Reminder;
use App\Models\ReminderTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ViewFinderInterface;

class ReminderController extends Controller
{
    public function index($id){
        $reminders = Reminder::with(['drugRecord', 'drug'])->where('user_id', '=', $id)->where('status', '=', 0)->get();
        if ($reminders) {
            // return response()->json(compact('reminders'));
            return view('users.setReminder', compact('reminders'));
        }
        return redirect()->back()->withErrors(['header'=> 'GAGAL', 'message' => 'Tidak dapat menampilkan reminder']);
    }

    public function showReminder(){
        $reminders = Reminder::with(['reminderTimes', 'times'])->where('user_id', Auth::id())->get();
        // return response()->json(compact('reminders'));  
        return view('users.reminder', compact('reminders'));
    }

    public function delete(Request $request)
    {
        try {
            $reminder = ReminderTime::where('reminder_id', $request->reminder_id)
                ->where('time_id', $request->time_id)
                ->whereDate('date', $request->date);

            if ($reminder->exists()) {
                $reminder->delete();
                return redirect()->route('user.showReminder')->with([
                    'header' => 'SUKSES',
                    'message' => 'Pengingat berhasil dihapus!',
                    'alert_type' => 'success'
                ]);
            } else {
                return redirect()->route('user.showReminder')->withErrors([
                    'header' => 'GAGAL',
                    'message' => 'Data pengingat tidak ditemukan!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->route('user.showReminder')->withErrors([
                'header' => 'GAGAL',
                'message' => 'Pengingat tidak berhasil dihapus! ' . $th->getMessage()
            ]);
        }
    }


    public function create(Request $request){
        try {
            $reminder = Reminder::find($request->reminder_id);
            $time = $request->time;
            $date = $request->date;
            $status = 1;
            // return response()->json(compact('reminder', 'time'));

        switch ($time) {
            case 'pagi':
                $time = 5;
                break;
            case 'siang':
                $time = 10;
                break;
            case 'malam':
                $time = 16;
                break;
            default:
                $time = 5;
                break;
            }

        ReminderTime::create([
            'reminder_id' => $reminder->id,
            'time_id' => $time,
            'date' => $date, 
            'status' => $status
        ]);
        
        return redirect()->route('user.showReminder')->with(['header'=> 'SUKSES', 'message' => 'Pengingat berhasil dibuat!']);
        } catch (\Throwable $th) {
            return redirect()->route('user.showReminder')->withErrors(['header'=> 'Gagal', 'message' => 'Pengingat tidak berhasil dibuat! ' . $th->getMessage()]);
        }
        

    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'reminder_id' => 'required|exists:reminders,id',
            'time_id' => 'required|exists:times,id',
            'date' => 'required|date',
            'status' => 'required|string|in:on,off',
        ]);

        $updated = ReminderTime::where('reminder_id', $request->reminder_id)
            ->where('time_id', $request->time_id)
            ->whereDate('date', $request->date)
            ->update(['status' => $request->status == 'on' ? 1 : 0]);

        if ($updated) {
            return back()->with(['header' => 'SUKSES', 'message' => 'Pengingat berhasil diperbarui!', 'alert_type' => 'success']);
        } else {
            return back()->withErrors(['header' => 'GAGAL', 'message' => 'Pengingat tidak berhasil diperbarui!', 'alert_type' => 'danger']);
        }
    }
    
    

}
