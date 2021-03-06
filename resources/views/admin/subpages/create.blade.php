@extends('admin.layouts.app')

@section('content')

    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                            <form action="{{route('admin.subpages.post')}}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="info">
                                    <h6 class="">Add New subPage</h6>
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
                                                                <label for="fullName">name_ar</label>
                                                                <input type="text" class="form-control mb-4" id="name_ar" name="name_ar" placeholder="name_ar" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">name_en</label>
                                                                <input type="text" class="form-control mb-4" id="name_en" name="name_en" placeholder="name_en" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">content</label>
                                                                <textarea class="form-control mb-4" id="demo1" cols="40" rows="10" name="content" placeholder="content" value=""></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">select Page</label>
                                                                <select name="page_id" class="form-control">
                                                                    @foreach($pages as $page)
                                                                        <option value="{{$page->id}}"> {{$page->name_en}} </option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="fas fa-angle-down"></i>
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
