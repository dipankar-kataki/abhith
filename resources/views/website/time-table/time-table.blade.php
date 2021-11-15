@extends('layout.website.website')

@section('title', 'Time Table')

@section('head')
    <style>
        #header {
            display: none;
        }

        .sidebar {
            position: sticky;
            top: 150px;
        }

    </style>
@endsection

@section('content')

    <section class="time-table">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Course Name </th>
                                <th> Chapter Name </th>
                                <th> Date </th>
                                <th> Time</th>
                                <th> Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $value) 
                               @foreach ($value as $key2 => $value2)
                                  <tr>
                                      <td>{{$key + 1}}</td>
                                      <td>{{$value2->course->name}}</td>
                                      <td>{{$value2->chapter->name}}</td>
                                      <td>{{$value2->date}}</td>
                                      <td>{{$value2->time}}</td>
                                      <td>
                                          @if ($value2->zoom_link == '')
                                              <span>Link will available 30 minutes before class.</span>
                                          @else
                                            <a href="{{$value2->zoom_link}}" target="_blank"><span style="color:green;">Join Class</span></a>
                                          @endif
                                      </td>
                                  </tr>
                               @endforeach
                               @empty
                                   <h2>No Time Table Found</h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('layout.website.include.modals')

@endsection

@section('scripts')
    @include('layout.website.include.modal_scripts')
@endsection
