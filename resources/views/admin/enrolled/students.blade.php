@extends('layout.admin.layoout.admin')

@section('title','Enrolled Students')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span>Enrolled Students
        </h3>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Course Name </th>
                                <th> Chapter Name </th>
                                <th> Enroll Status </th>
                                <th> Date of Enrollment </th>
                                {{-- <th>Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($details as $key =>  $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->user->firstname}} {{$item->user->lastname}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td>{{$item->course->name}}</td>
                                    <td>{{$item->chapter->name}}</td>
                                    <td>
                                        @if ($item->payment_status == 'paid')
                                            <span style="color: green;">Enrolled</span>
                                        @else
                                            <span style="color: red;">Not Enrolled (payment {{$item->payment_status}})</span>
                                        @endif
                                    </td>
                                    <td>{{$item->updated_at->format('Y-M-d')}}</td>
                                    {{-- <td><a href="#">view</a></td> --}}
                                </tr>
                           @empty
                               <div class="text-center">
                                   <p>No Data Found</p>
                               </div>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

@endsection
