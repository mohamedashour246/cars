@extends('admin.layouts.app')

@section('content')

    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                            <form action="{{route('admin.links.post')}}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="info">
                                    <h6 class="">Add New link</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="upload mt-4 pr-md-4">
                                                        <input type="file" name="image" id="input-file-max-fs" class="dropify" data-default-file="{{asset('assets/img/200x200.jpg')}}" data-max-file-size="2M" />
                                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">content_ar</label>
                                                                <textarea class="form-control mb-4" id="demo1" name="content_ar" placeholder="content_ar" value=""></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">content_en</label>
                                                                <textarea class="form-control mb-4" id="demo2" name="content_en" placeholder="content_en" value=""></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">link</label>
                                                                <input type="text" class="form-control mb-4" id="link" name="link" placeholder="link" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="switch s-icons s-outline s-outline-default mr-2">
                                                                    <input type="checkbox" checked name="active" value="1">
                                                                    <span class="slider round">Active</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection
