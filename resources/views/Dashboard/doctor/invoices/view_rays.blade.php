@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('Doctors.diagnosis') }}
@stop
@section('css')
    <!-- Internal Data table css -->
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Doctors.rays') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/

                    {{ $rays->Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')


    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{ trans('Doctors.notes') }}</label>
        <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $rays->description_employee }}</textarea>
    </div>
    <!-- Gallery -->
    <div class="demo-gallery">
        <ul id="lightgallery" class="list-unstyled row row-sm pr-0">

            @forelse ($rays->images as $image)
                <li class="col-sm-6 col-lg-4" data-responsive="{{ URL::asset('storage/Rays/' . $image->filename) }}"
                    data-src="{{ URL::asset('assets/img/photos/9.jpg') }}">
                    <a href="">
                        <img width="50" height="350" class="img-responsive" src="{{ URL::asset('storage/Rays/' . $image->filename) }}"
                            alt="Thumb-1">
                    </a>
                </li>
            @empty
                <h2>no data</h2>
            @endforelse
        </ul>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
