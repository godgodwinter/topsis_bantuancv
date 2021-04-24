@extends('admin.main')

@section('title','Dashboard')

@section('headernav')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Dashboard</h4>
                    <span>Selamat datang di Halaman Beranda
                        @php
    if((Auth::user()->current_team_id)==1){
        echo"Kepala Desa";
    }else{
        echo"Administrator";
    }
@endphp
                        .</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">@yield('title')</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('container')


  <!-- Page-body start -->
  <div class="page-body">
    <div class="row">

  <!-- widget-statstic start -->
  <div class="col-md-12 col-xl-4">
    <div class="card widget-statstic-card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Keuntungan</h5>
                <p class="p-t-10 m-b-0 text-c-yellow">From Last Month</p>
            </div>
        </div>
        <div class="card-block">
            <i class="feather icon-sliders st-icon bg-c-yellow"></i>
            <div class="text-left">
                <h3 class="d-inline-block">5,456</h3>
                <i class="feather icon-arrow-up f-30 text-c-green"></i>
                <span class="f-right bg-c-yellow">23%</span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4">
    <div class="card widget-statstic-card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Stok</h5>
                <p class="p-t-10 m-b-0 text-c-pink">This Month</p>
            </div>
        </div>
        <div class="card-block">
            <i class="feather icon-users st-icon bg-c-pink txt-lite-color"></i>
            <div class="text-left">
                <h3 class="d-inline-block">3,874</h3>
                <i class="feather icon-arrow-down text-c-pink f-30 "></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4">
    <div class="card widget-statstic-card">
        <div class="card-header">
            <div class="card-header-left">
                <h5>Penjualan</h5>
                <p class="p-t-10 m-b-0 text-c-blue">54% From last month</p>
            </div>
        </div>
        <div class="card-block">
            <i class="feather icon-shopping-cart st-icon bg-c-blue"></i>
            <div class="text-left">
                <h3 class="d-inline-block">5,456</h3>
                <i class="feather icon-arrow-up text-c-green f-30 "></i>
            </div>
        </div>
    </div>
</div>
<!-- widget-statstic end -->

<!-- Seluruh Menu Start -->
  <div class="col-md-12 col-xl-12">
<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5>Menu-Menu A27-Shop</h5>
        </div>

    </div>
    <div class="card-block">
        <p>Use Class <code>.btn-mat</code> inside button to make matrialized Button.</p>
        <button class="btn btn-mat btn-primary ">Primary Button</button>
        <button class="btn btn-mat btn-success">Success Button</button>
        <button class="btn btn-mat btn-info ">Info Button</button>
        <button class="btn btn-mat btn-warning ">Warning Button</button>
        <button class="btn btn-mat btn-danger ">Danger Button</button>
        <button class="btn btn-mat btn-inverse ">Inverse Button</button>
        <button class="btn btn-mat btn-disabled disabled">Disabled Button</button>
    </div>
    <div class="card-block">
        <!-- button Default -->
        <p>Use Class <code>btn-outline-*</code> inside button to make Border Button.</p>
        <button class="btn btn-primary btn-outline-primary"><i class="icofont icofont-user-alt-3"></i>Primary Button</button>
        <button class="btn btn-success btn-outline-success"><i class="icofont icofont-check-circled"></i>Success Button</button>
        <button class="btn btn-info btn-outline-info"><i class="icofont icofont-info-square"></i>Info Button</button>
        <button class="btn btn-warning btn-outline-warning"><i class="icofont icofont-warning-alt"></i>Warning Button</button>
        <button class="btn btn-danger btn-outline-danger"><i class="icofont icofont-eye-alt"></i>Danger Button</button>
        <button class="btn btn-inverse btn-outline-inverse"><i class="icofont icofont-exchange"></i>Inverse Button</button>
        <button class="btn btn-disabled btn-outline-disabled disabled"><i class="icofont icofont-not-allowed"></i>Disabled Button</button>
    </div>
</div>
</div>
<!-- Seluruh Menu end -->

</div>
</div>
<!-- page body -->
@endsection
