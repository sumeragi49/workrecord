<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header_inner">
            <div class="header_title">
                <a href="/attendance">COACHTECH</a>
            </div>
            <nav class="header_nav">
                <ul class="nav_content">
                    @if (Auth::check())
                    <li class="nav_content-list">
                        <a href="/attendance">勤怠</a>
                    </li>
                    <li class="nav_content-list">
                        <a href="/attendance/list">勤怠一覧</a>
                    </li>
                    <li class="nav_content-list">
                        <a href="/stamp_correction_request/list">申請</a>
                    </li>
                    <li class="nav_content-list">
                        <form class="logout_form" action="/logout" method="post">
                            @csrf
                            <button class="header_nav-button">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>