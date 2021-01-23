@extends('admin.layouts.app')

@section('content')


    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>All Links</h4>
                        </div>

                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <a href="{{route('admin.links.add')}}">
                                <button class="btn btn-primary"> Add </button>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="style-3" class="table style-3  table-hover">
                            <thead>
                            <tr>
                                <th> Record Id </th>
                                <th>content_ar</th>
                                <th>content_en</th>
                                <th>image</th>
                                <th>link</th>

                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($links)
                                @foreach($links as $link)
                                    <tr>
                                        <td> {{ $link->id }} </td>
                                        <td>{{$link->content_ar}}</td>
                                        <td>{{$link->content_en}}</td>
                                        <td>
                                            <span><img src="{{asset('assets/uploads/links/'.$link->image)}}" class="rounded-circle profile-img" alt="avatar"></span>

                                        </td>
                                        <td> {{$link->link}} </td>

                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li><a href="" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                                <li><a href="" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
