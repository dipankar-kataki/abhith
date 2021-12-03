@extends('layout.admin.layoout.admin')

@section('title','Enrolled Students')

@section('head')
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
    #enrolled_students_table_filter{
        margin-top:-30px;
    }
</style>

@endsection

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
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="enrolled_students_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Course Name </th>
                                <th> Chapter Name </th>
                                <th> Enroll Status </th>
                                <th>Payment Status</th>
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
                                            <span style="color: red;">Not Enrolled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->payment_status == 'paid')
                                            <span style="color: green;">{{$item->payment_status}}</span>
                                        @else
                                            <span style="color: red;">{{$item->payment_status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->updated_at->format('d, M Y')}}</td>
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
                {{-- <div style="float:right;margin-top:10px;">
                    {{  $details->links() }}
              </div> --}}
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
         $(document).ready( function () {
            $('#enrolled_students_table').DataTable({
                "processing": true,
                dom: 'Bfrtip',
                buttons: [ 
                    'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
