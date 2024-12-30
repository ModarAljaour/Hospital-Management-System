@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.doctors') }}
@stop
@section('css')
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.doctors') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('main-sidebar_trans.view_all') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href="{{ route('doctor.create') }}" class="btn btn-primary" role="button"
                        aria-pressed="true">{{ trans('doctors.add_doctor') }}</a>
                    <button type="button" class="btn btn-danger"
                        id="btn_delete_all">{{ trans('doctors.delete_select') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><input name="select_all" id="example-select-all" type="checkbox" /></th>
                                    <th>{{ trans('Doctors.img') }}</th>
                                    <th>{{ trans('doctors.name') }}</th>
                                    <th>{{ trans('doctors.email') }}</th>
                                    <th>{{ trans('doctors.section') }}</th>
                                    <th>{{ trans('doctors.phone') }}</th>
                                    <th>{{ trans('doctors.appointments') }}</th>
                                    <th>{{ trans('doctors.Status') }}</th>
                                    <th>{{ trans('doctors.created_at') }}</th>
                                    <th>{{ trans('doctors.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="checkbox" name="delete_select" value="{{ $doctor->id }}"
                                                class="delete_select">
                                        </td>
                                        <td>
                                            @if ($doctor->image)
                                                <img src="{{ Url::asset('storage/doctors/' . $doctor->image->filename) }}"
                                                    height="50px" width="50px" alt="">
                                            @else
                                                <img src="{{ Url::asset('Dashboard/img/doctor_default.png') }}"
                                                    height="50px" width="50px" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->section->name }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>
                                            @foreach ($doctor->appointments as $appointments)
                                                {{ $appointments->name }}
                                            @endforeach
                                        </td>
                                        {{-- <td>{{ $doctor->price }}</td> --}}
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $doctor->status == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                        </td>
                                        <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ trans('doctors.Processes') }}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href="{{ route('doctor.edit', $doctor->id) }}"><i
                                                            style="color: #0ba360"
                                                            class="text-success ti-user"></i>&nbsp;&nbsp;
                                                        {{ trans('Doctors.edit') }}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_password{{ $doctor->id }}"><i
                                                            class="text-primary ti-key"></i>&nbsp;&nbsp;
                                                        {{ trans('Doctors.update_password') }}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_status{{ $doctor->id }}"><i
                                                            class="text-warning ti-back-right"></i>&nbsp;&nbsp;
                                                        {{ trans('Doctors.Status_change') }}
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $doctor->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;
                                                        {{ trans('Doctors.delete_doctor') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Doctors.delete')
                                    {{-- @include('Dashboard.Doctors.edit') --}}
                                    @include('Dashboard.Doctors.delete_select')
                                    @include('Dashboard.Doctors.update_password')
                                    @include('Dashboard.Doctors.update_status')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('Dashboard/js/table-data.js') }}"></script>

    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#select_all").click(function() {
                $("input[name='delete_select']").prop('checked', this.checked);
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn_delete_all").click(function() {
                var selected = [];
                $("input[name='delete_select']:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show');
                    $('#delete_select_id').val(selected.join(","));
                } else {
                    alert("{{ trans('doctors.select_at_least_one') }}");
                }
            });
        });
    </script>



@endsection