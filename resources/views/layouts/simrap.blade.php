<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | SIMRAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#F5F7FB;
    font-family:'Segoe UI',sans-serif;
    overflow-x:hidden;
}

/* ============================
            SIDEBAR
============================ */

.sidebar{

    width:260px;

    height:100vh;

    position:fixed;

    left:0;

    top:0;

    background:linear-gradient(180deg,#0E5F59,#11786F,#1CB5A3);

    color:white;

    box-shadow:5px 0 20px rgba(0,0,0,.15);

    z-index:999;

}

.logo{

    text-align:center;

    padding:35px 20px 25px;

}

.logo img{

    width:65px;

    margin-bottom:15px;

}

.logo h1{

    color:white;

    font-size:52px;

    font-weight:800;

    letter-spacing:2px;

    margin-bottom:10px;

}

.logo-subtitle{

    color:white;

    font-size:15px;

    font-weight:600;

    margin-bottom:12px;

    line-height:22px;

}

.logo-instansi{

    color:rgba(255,255,255,.85);

    font-size:13px;

    line-height:21px;

}

.sidebar hr{

    border-color:rgba(255,255,255,.15);

    margin:18px 0;

}

.sidebar a,
.logout-btn{

    display:flex;

    align-items:center;

    gap:14px;

    width:100%;

    padding:16px 25px;

    color:white;

    text-decoration:none;

    border:none;

    background:none;

    font-size:16px;

    font-weight:600;

    transition:.25s;

}

.sidebar a i,
.logout-btn i{

    font-size:22px;

    width:26px;

    text-align:center;

}

.sidebar a:hover,
.logout-btn:hover{

    background:rgba(255,255,255,.12);

    border-left:5px solid #FFD54F;

    padding-left:20px;

}

.sidebar a.active{

    background:rgba(255,255,255,.18);

    border-left:5px solid #FFD54F;

    padding-left:20px;

}

.content{

    margin-left:260px;

    padding:28px;

}

/* ============================
            TOPBAR
============================ */

.topbar{

    background:linear-gradient(90deg,#136A63,#11786F,#20C4B5);

    color:white;

    border-radius:18px;

    padding:22px 30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    margin-bottom:30px;

}

.topbar h3{

    font-size:48px;

    font-weight:800;

    margin-bottom:6px;

}

.topbar p{

    margin:0;

    color:rgba(255,255,255,.9);

    font-size:15px;

}

.user-info{

    text-align:right;

}

.user-info strong{

    display:block;

    font-size:18px;

}

.user-info small{

    color:rgba(255,255,255,.9);

}

/* ============================
            CARD
============================ */

.card{

    border:none;

    border-radius:18px;

    box-shadow:0 8px 20px rgba(0,0,0,.08);

}

.card-header{

    background:white;

    border-bottom:1px solid #ECECEC;

    font-weight:700;

}

/* ============================
            TABLE
============================ */

.table{

    border-radius:12px;

    overflow:hidden;

}

.table thead{

    background:#EAF8F5;

}

.table thead th{

    color:#0F766E;

    font-weight:700;

}

.table tbody tr:hover{

    background:#F6FCFB;

}

/* ============================
            BUTTON
============================ */

.btn-success{

    background:linear-gradient(90deg,#0F766E,#16B4A4);

    border:none;

}

.btn-success:hover{

    background:#115E59;

}

.btn-primary{

    background:#0F766E;

    border:none;

}

.btn-primary:hover{

    background:#115E59;

}

.btn-warning{

    color:white;

}

.btn-warning:hover{

    color:white;

}

.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select{

    border-radius:8px;

}

</style>

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <img src="{{ asset('images/logo-sumut.png') }}" alt="Logo">

        <h1>SIMRAP</h1>

        <div class="logo-subtitle">

            Sistem Informasi Manajemen Rapat

        </div>

        <div class="logo-instansi">

            Dinas Komunikasi dan Informatika

            <br>

            Provinsi Sumatera Utara

        </div>

    </div>

    <hr>

    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

        <i class="bi bi-speedometer2"></i>

        Dashboard

    </a>

    <a href="{{ route('agenda.index') }}"
       class="{{ request()->routeIs('agenda.*') ? 'active' : '' }}">

        <i class="bi bi-calendar-event"></i>

        Data Agenda

    </a>

    <a href="{{ route('laporan.index') }}"
       class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">

        <i class="bi bi-printer"></i>

        Cetak Laporan

    </a>

    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button class="logout-btn" type="submit">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </button>

    </form>

</div>
<div class="content">

    <div class="topbar">

        <div>

            <h3>@yield('title')</h3>

            <p>
                Sistem Informasi Manajemen Rapat (SIMRAP)
            </p>

        </div>

        <div class="user-info">

            <strong>

                <i class="bi bi-person-circle"></i>

                {{ Auth::user()->name }}

            </strong>

            <small>

                {{ Auth::user()->email }}

            </small>

        </div>

    </div>

    @yield('content')

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')

</body>

</html>