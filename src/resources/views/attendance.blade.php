@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}" >
@endsection

@section('content')
<div class="attendance_form">
    @if($status == 'not_started')
    <form class="attendance_form-content" action="{{ route('work.start') }}" method="post">
        @csrf
        <div class="work_status">
            <h1>勤務外</h1>
        </div>
        <div class="work_datetime">
            <h2>{{ Carbon\Carbon::now()->isoFormat('Y年M月D日(ddd)') }}</h2>
            <h3 id="current-time">--:--</h3>
        </div>
        <div class="form_button">
            <button class="form_submit-button">出勤</button>
        </div>
    </form>
    @endif

    @if($status == 'working')
    <div class="attendance_form-content">
        <div class="work_status">
            <h1>勤務中</h1>
        </div>
        <div class="work_datetime">
            <h2>{{ Carbon\Carbon::now()->isoFormat('Y年M月D日(ddd)') }}</h2>
            <h3 id="current-time">--:--</h3>
        </div>
        <div class="form_button">
            <form class="work_form_content" action="{{ route('work.end') }}" method="post">
                @method('patch')
                @csrf
                <button class="form_submit-button_end">退勤</button>
            </form>
            <form class="break_form_content" action="{{ route('break.start') }}" method="post">
                @csrf
                <button class="form_submit-button_break">休憩入</button>
            </form>
        </div>
    </div>
    @endif

    @if($status == 'breaking')
    <form class="attendance_form-content" action="{{ route('break.end') }}" method="post">
        @method('patch')
        @csrf
        <div class="work_status">
            <h1>勤務外</h1>
        </div>
        <div class="work_datetime">
            <h2>{{ Carbon\Carbon::now()->isoFormat('Y年M月D日(ddd)') }}</h2>
            <h3 id="current-time">--:--</h3>
        </div>
        <div class="form_button">
            <button class="form_submit-button">休憩戻</button>
        </div>
    </form>
    @endif

    @if($status == 'finished')
    <div class="attendance_form-content">
        <div class="work_status">
            <h1>退勤済</h1>
        </div>
        <div class="work_datetime">
            <h2>{{ Carbon\Carbon::now()->isoFormat('Y年M月D日(ddd)') }}</h2>
            <h3 id="current-time">--:--</h3>
        </div>
        <div class="work_comment">
            <h4>お疲れ様でした。</h4>
        </div>
    </div>
    @endif
</div>

<script>
    function updateTime() {
        const now = new Date();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        document.getElementById('current-time').textContent = `${hours}:${minutes}`;
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection