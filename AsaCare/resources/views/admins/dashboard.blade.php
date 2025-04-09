@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-danger">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">Hospital</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-house-heart-fill"></i></span>
                            </div>
                            <a href="{{route('admin.rumahsakit.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">Doctor</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-person-heart"></i></span>
                            </div>
                            <a href="{{route('admin.dokter.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-warning">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">Service</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-heart-pulse-fill"></i></span>
                            </div>
                            <a href="{{route('admin.layanan.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 3-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 4-->
                        <div class="small-box text-bg-primary">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">User</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-person-fill-gear"></i></span>
                            </div>
                            <a href="{{route('admin.user.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-6 col-6">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-success">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">Specialization</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-file-earmark-medical-fill"></i></span>
                            </div>
                            <a href="{{route('admin.spesialisasi.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-6 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-info">
                            <div class="inner d-flex justify-content-between align-items-center">
                                <h3>44</h3>
                                <h3 class="mb-0">Medical Record</h3>
                                <span class="fs-1"><i class="nav-icon bi bi-journal-medical"></i></span>
                            </div>
                            <a href="{{route('admin.dokter.index')}}"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                {{-- <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-7 connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Sales Value</h3>
                            </div>
                            <div class="card-body">
                                <div id="revenue-chart"></div>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>
                                <div class="card-tools">
                                    <span title="3 New Messages" class="badge text-bg-primary"> 3 </span>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" title="Contacts"
                                        data-lte-toggle="chat-pane">
                                        <i class="bi bi-chat-text-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the start -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                            <span class="direct-chat-timestamp float-end"> 23 Jan 2:00 pm </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="../../dist/assets/img/user1-128x128.jpg"
                                            alt="message user image" />
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    <!-- Message to the end -->
                                    <div class="direct-chat-msg end">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                            <span class="direct-chat-timestamp float-start"> 23 Jan 2:05 pm </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="../../dist/assets/img/user3-128x128.jpg"
                                            alt="message user image" />
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">You better believe it!</div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    <!-- Message. Default to the start -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                            <span class="direct-chat-timestamp float-end"> 23 Jan 5:37 pm </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="../../dist/assets/img/user1-128x128.jpg"
                                            alt="message user image" />
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Working with AdminLTE on a great new app! Wanna join?
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    <!-- Message to the end -->
                                    <div class="direct-chat-msg end">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                            <span class="direct-chat-timestamp float-start"> 23 Jan 6:10 pm </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="../../dist/assets/img/user3-128x128.jpg"
                                            alt="message user image" />
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">I would love to.</div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                </div>
                                <!-- /.direct-chat-messages-->
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user1-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-end"> 2/28/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> How have you been? I was...
                                                    </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user7-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-end"> 2/23/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> I will be waiting for...
                                                    </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user3-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-end"> 2/20/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> I'll call you back at...
                                                    </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user5-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-end"> 2/10/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> Where is your new... </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user6-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-end"> 1/27/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> Can I take a look at...
                                                    </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="../../dist/assets/img/user8-128x128.jpg" alt="User Avatar" />
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-end"> 1/4/2023
                                                        </small>
                                                    </span>
                                                    <span class="contacts-list-msg"> Never mind I found... </span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contacts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..."
                                            class="form-control" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.direct-chat -->
                    </div>
                    <!-- /.Start col -->
                    <!-- Start col -->
                    <div class="col-lg-5 connectedSortable">
                        <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">Sales Value</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm"
                                        data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="world-map" style="height: 220px"></div>
                            </div>
                            <div class="card-footer border-0">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1" class="text-dark"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2" class="text-dark"></div>
                                        <div class="text-white">Online</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3" class="text-dark"></div>
                                        <div class="text-white">Sales</div>
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                        </div>
                    </div>
                    <!-- /.Start col -->
                </div> --}}
                <!-- /.row (main row) -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
