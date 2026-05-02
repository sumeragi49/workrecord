@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div class="date-content">
    <div class="date-content-item">
        <div class="date-title">
            <h1>❙ 勤怠一覧</h1>
        </div>
        <form class="index-date-calender" action="{{ route('admin.attendance.index') }}" method="get">
            <div class="prev-date">
                <a href="{{ route('admin.attendance.index', ['date' => $prevDate]) }}">← 前日</a>
            </div>
            <div class="this-date">
                <input type="date" name="date" value="{{ $dateStr }}" onchange="this.form.submit()">
            </div>
            <div class="next-date">
                <a href="{{ route('admin.attendance.index', ['date' => $nextDate]) }}">翌日 →</a>
            </div>
        </form>
        <div class="index_container">
            <table class="table_content">
                <thead class="table_heading">
                    <tr>
                        <th>名前</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩</th>
                        <th>合計</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody class="table_items">
                    @foreach($users as $user)
                        @php
                            $attendance = $user->attendances->first();
                        @endphp
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ optional($attendance)->time_start ? \Carbon\Carbon::parse($attendance->time_start)->format('H:i') : '' }}</td>
                            <td>{{ optional($attendance)->time_end ? \Carbon\Carbon::parse($attendance->time_end)->format('H:i') : '' }}</td>
                            <td>
                                @if($attendance && $attendance->break_total_minutes)
                                    {{ ($attendance->break_total_minutes) }}
                                @endif
                            </td>
                            <td>
                                @if($attendance && $attendance->work_total_minutes)
                                    {{ ($attendance->work_total_minutes) }}
                                @endif
                            </td>
                            <td>
                                @if($attendance)
                                    <a class="detail_attendance-link" href="{{ route('admin.attendance.show', $attendance['id']) }}">詳細</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection