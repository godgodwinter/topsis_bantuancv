{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>

</x-app-layout>


- --}}

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
                        .</span>.</span>
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

<!-- widget-statstic end -->

<!-- Seluruh Menu Start -->
<!-- Seluruh Menu end -->

</div>
</div>
<!-- page body -->
@endsection
