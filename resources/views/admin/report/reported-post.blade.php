@extends('layout.admin.layoout.admin')

@section('title', 'Reported Post')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi  mdi-alert menu-icon"></i>
            </span> Reported Posts
        </h3>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Subjects List</h4> --}}
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Post Name </th>
                                <th>Number Of Reports</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reportedPosts as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td id="postId">{{ $item->knowledgeForumPost->question }}</td>
                                    <td>{{ $item->report_count }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" type="button"  data-toggle="dropdown" style="font-size:18px;color:black;"> <i class="mdi mdi-menu"></i></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item move-to-trash" href="#" style="font-size:15px;color:black;">Move To Trash</a>
                                                {{-- <a class="dropdown-item" href="#" style="font-size:15px;">Permanent Delete</a> --}}
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                            @empty 
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">No Reported Post's Found.</div>
                                    </td>
                                </tr>
                            @endforelse
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- scripts --}}
@section('scripts')
    <script>
        $('.move-to-trash').on('click',function(e){
            e.preventDefault();
            let postId = $('#postId').text();
            $.ajax({
                url:"{{route('website.remove.reported.post')}}",
                type:'POST',
                data:{ '_token': '{{ csrf_token() }}','postId' : postId},
                success:function(result){
                    if(result.success){
                        toastr.success(result.success);
                        location.reload();
                    }else{
                        toastr.error(result.error);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Oops! Something went wrong while reporting.');
                    }
                }
            });
        });
    </script>
{{-- <script>
    $(document.body).on('change', '#testingUpdate', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        // console.log(status);
        var formDat = {
            catId: user_id,
            active: status
        }
        // console.log(formDat);
        $.ajax({
            type: "post",

            url: "{{ route('admin.active.blog') }}",
            data: formDat,

            success: function(data) {
                console.log(data)
            }
        });
    });
</script> --}}
@endsection
