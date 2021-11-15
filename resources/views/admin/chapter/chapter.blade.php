@extends('layout.admin.layoout.admin')

@section('title','Chapter')

@section('head')

@endsection

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Chapter </h4>
            <form id="createCourse" action="{{route('admin.creating.chapter')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{\Crypt::encrypt($course_id)}}">
                <table class="table table-bordered footable footable-1 footable-paging footable-paging-center breakpoint-lg" id="dynamic_field" style="">
                    <tbody>
                        <tr>
                            <td class="footable-first-visible" style="width: 40%; display: table-cell;"><input type="text" name="name[]" placeholder="Enter Chapter" class="form-control name_list" required></td>
                            <td class="footable-first-visible" style="width: 40%; display: table-cell;"><input type="text" name="price[]" placeholder="Enter Price" class="form-control name_list" required></td>
                            <td class="footable-last-visible" style="display: table-cell;"><button type="button" name="add" id="adding" class="btn btn-success">Add More</button></td>
                        </tr>
                    </tbody>
                    <tfoot></tfoot>
                </table>

                <button class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
      var i = 1;
    $(document).on('click', '#adding', function() {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter Chapter" class="form-control name_list" required/></td><td><input type="text" name="price[]" placeholder="Enter Price" class="form-control name_list" required/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>

@endsection
