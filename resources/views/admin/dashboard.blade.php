@extends('admin.layouts.app_forms')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Client Total -->
                        <div class="col-xl-4 col-md-3 col-sm-6">
                            <div class="card info-card sales-card">
                                <a href="javascript:void(0)">
                                    <div class="card-body hover-effect">
                                        <h5 class="card-title">Clients</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totals['clientTotal'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Projects Total -->
                        <div class="col-xl-4 col-md-3 col-sm-6">
                            <div class="card info-card sales-card">
                                <a href="javascript:void(0)">
                                    <div class="card-body hover-effect">
                                        <h5 class="card-title">Projects</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fa-regular fa-folder-open"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totals['projectTotal'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Employees Total -->
                        <div class="col-xl-4 col-md-3 col-sm-6">
                            <div class="card info-card sales-card">
                                <a href="javascript:void(0)">
                                    <div class="card-body hover-effect">
                                        <h5 class="card-title">Employees</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totals['employeeTotal'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Shop -->
                        <div class="col-xl-4 col-md-3 col-sm-6">
                            <div class="card info-card sales-card">
                                <a href="javascript:void(0)">
                                    <div class="card-body hover-effect">
                                        <h5 class="card-title">Tasks</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-list-task"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totals['taskTotal'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
