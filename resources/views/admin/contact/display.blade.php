@extends('admin.layouts.app')

@section('content')


    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Contact us</h4>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="style-3" class="table style-3  table-hover">
                            <thead>
                            <tr>
                                <th> Record Id </th>
                                <th> address </th>
                                <th> city </th>
                                <th> phone1 </th>
                                <th> phone2 </th>
                                <th> fax </th>
                                <th> email </th>
                                <th> site </th>
                                <th> map </th>

                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($contacts)
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td> {{ $contact->id }} </td>
                                        <td>{{$contact->address}}</td>
                                        <td>{{$contact->city}}</td>
                                        <td>{{$contact->phone_c1}}</td>
                                        <td>{{$contact->phone_c2}}</td>
                                        <td>{{$contact->fax}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->site}}</td>
                                        <td>{{$contact->map}}</td>

                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li><a href="{{url('/dashboard/contact/edit/'.$contact->id)}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>                                   
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
