@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/staff.css') }}" >
@endsection

@section('content')
<div class="staff-content">
    <div class="staff-content-item">
        <div class="staff-content-title">
            <h1>❙ スタッフ一覧</h1>
        </div>
        <div class="staff-list">
            <table>
                <thead class="staff-table-heading">
                    <tr>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>月次勤怠</th>
                    </tr>
                </thead>
                <tbody class="staff-table-items">
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            <a href="{{ route('admin.staff.attendance', $user['id']) }}">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection