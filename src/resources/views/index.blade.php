@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" >
@endsection

@section('content')
<div class="index_content">
    <div class="index_content-item">
        <div class="index_title">
            <h1>❙ 勤怠一覧</h1>
        </div>
        <form class="index_calender" action="{{ route('attendances.index') }}" method="get">
            <div class="prev_month">
                <span>←</span>
                <span>前月</span>
            </div>
            <div class="this_month">
                <input type="month" name="month" value="{{ $month }}" onchange="this.form.submit()">
            </div>
            <div class="next_month">
                <span>来月</span>
                <span>→</span>
            </div>
        </form>
        <div class="index_container">
            <table class="table_content">
                <thead class="table_heading">
                    <tr>
                        <th>日付</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩</th>
                        <th>合計</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody class="table_items">
                    @foreach($days as $day)
                        <tr>
                            <td>{{ $day['date'] }}</td>
                            <td>{{ $day['attendance']?->time_start?->format('H:i') ?? '' }}</td>
                            <td>{{ $day['attendance']?->time_end?->format('H:i') ?? '' }}</td>
                            <td>{{ $day['total_break'] > 0 ? $day['total_break'] . '分' : '' }}</td>
                            <td>
                                @if($day['attendance'] && $day['attendance']->time_end)
                                {{ $day['attendance']->work_duration }}
                                @endif
                            </td>
                            <td>
                                @if($day['attendance'])
                                    <a class="detail_attendance-link">詳細</a>
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