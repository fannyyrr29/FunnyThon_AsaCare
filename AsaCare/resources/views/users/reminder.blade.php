@extends('layouts.app')

@section('title', 'Jadwal Pengingat')
@section('back_button', true)
@section('header_title', 'Pengingat Minum Obat')

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 26px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        transform: translateX(24px);
    }

    @media (max-width: 576px) {
        .reminder-card {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .reminder-card form {
            align-self: flex-end;
        }
    }
</style>

@section('content')
    @if (session('header'))
        <div class="alert alert-{{ session('alert_type') }} alert-success fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h4 class="text-center mt-3">Jadwal Minum Obat per Jam</h4>
    <br>

    @php $hasData = true; @endphp

    <div class="container">
        <div class="row g-3">
            @foreach ($reminders as $reminder)
                @foreach ($reminder->reminderTimes as $time)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div
                            class="d-flex justify-content-between align-items-center border rounded p-3 mb-2 reminder-card">
                            <div>
                                <strong>{{ $reminder->drug->name }}</strong><br>
                                {{ \Carbon\Carbon::parse($time->date)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($time->time->time)->format('H:i') }}
                            </div>

                            <form action="{{ route('user.updateReminder') }}" method="POST">
                                @csrf
                                <input type="hidden" name="reminder_id" value="{{ $reminder->id }}">
                                <input type="hidden" name="time_id" value="{{ $time->time_id }}">
                                <input type="hidden" name="date" value="{{ $time->date }}">
                                <input type="hidden" name="status" value="off">

                                <label class="switch">
                                    <input type="checkbox" name="status" value="on" onchange="this.form.submit()"
                                        {{ $time->status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </form>
                            <form action="{{ route('user.deleteReminder') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pengingat ini?')">
                                @csrf
                                <input type="hidden" name="reminder_id" value="{{ $reminder->id }}">
                                <input type="hidden" name="time_id" value="{{ $time->time_id }}">
                                <input type="hidden" name="date" value="{{ $time->date }}">
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pengingat">🗑️</button>
                            </form>


                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    @if (!$hasData)
        <p class="text-center mt-4">Belum ada pengingat yang dijadwalkan.</p>
    @endif
    <a href="{{ route('user.reminder', Auth::id()) }}" class="btn btn-success rounded-circle shadow-lg position-fixed"
        style="bottom: 30px; right: 30px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; font-size: 28px; z-index: 1000;">
        +
    </a>
@endsection
