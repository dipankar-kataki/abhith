@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<style>
    .sidebar {
        position: sticky;
        top: 150px;
    }
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
    #purchase_history_table_filter{
        margin-top:-40px;
    }
    #forum-search-bar{
        display:none;
    }
</style>

@endsection

@section('content')
@include('layout.website.include.forum_header')

<section class="account-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="knowledge-forum-right1 sidebar">
                    <div class="knowledge-forum-profile-top"><img src="{{asset('asset_website/img/knowladge-forum/bg.png')}}" class="w100"></div>
                    <div class="knowledge-forum-profile-bottom1">
                        <div class="knowledge-pic">
                            @if($user_details != null)
                                <img src="{{asset('/files/profile/'.$user_details->image)}}" onerror="this.onerror=null;this.src='{{asset('asset_website/img/noimage.png')}}';" style="border:3px solid white;"  height="110px" width="110px" class="rounded-circle">
                                
                            @else
                                <img src="{{asset('asset_website/img/knowladge-forum/image1.png')}}" class="w100">
                            @endif
                        </div>
                        <div class="knowledge-desc mt-2">
                            <h4 class="small-heading-black text-center mb0">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4>
                            @if($user_details != null)
                                <p class="text-center">{{$user_details->education}}</p>
                            @else
                                <p class="text-center">Msc</p>
                            @endif
                        </div>
                    </div>

                    <ul class="nav nav-tabs flex-column profile-tab" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photo" role="tab" aria-controls="photo">Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#account" role="tab" aria-controls="account">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payment" role="tab" aria-controls="payment">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#notification" role="tab" aria-controls="notification">Notification <span class="notification-badge">4</span></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#purchase" role="tab" aria-controls="purchase">Purchase History</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="profile-form">
                            <form class="row" id="profileForm">
                                @csrf
                                <div class="col-lg-6 col-6">
                                    <h4 class="small-heading-black">Profile</h4>
                                </div>
                                <div class="col-lg-6 col-6 text-right ">
                                    <a class="btn btn-default edit-btn" href="#" style="border: 1px solid #bbb6b6;">Edit Profile</a>&nbsp;
                                    <a class="btn btn-warning cancel-edit-btn" href="#">Cancel Edit</a>
                                </div>
                                @if($user_details != null)
                                    <div class="form-group col-lg-6 pr10">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name" id="firstname" pattern="^([a-zA-Z]+)\s?([a-zA-z]+)" title="Please Enter Letters only." value="{{Auth::user()->firstname}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" id="lastname" pattern="^([a-zA-Z]+)\s?([a-zA-z]+)" title="Please Enter Letters only." value="{{Auth::user()->lastname}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pr10">
                                        <label>Email ID</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="{{Auth::user()->email}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pr10">
                                        <label>Mobile number</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone" id="phone" pattern="(0|91)?[6-9][0-9]{9}" title="Phone number should start with 6 or 7 or 8 or 9 and 10 chars long. ( e.g 7896845214)" value="{{$user_details->phone}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Education</label>
                                        <input type="text" class="form-control" name="education" placeholder="Enter Education" id="education" value="{{$user_details->education}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="{{$user_details->gender}}">{{$user_details->gender}}</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group col-lg-6 pr10">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name" id="firstname" pattern="^([a-zA-Z]+)\s?([a-zA-z]+)" title="Please Enter Letters only." value="{{Auth::user()->firstname}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" id="lastname" pattern="^([a-zA-Z]+)\s?([a-zA-z]+)" title="Please Enter Letters only." value="{{Auth::user()->lastname}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pr10">
                                        <label>Email ID</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="{{Auth::user()->email}}" required>
                                    </div>
                                    <div class="form-group col-lg-6 pr10">
                                        <label>Mobile number</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone" id="phone" pattern="(0|91)?[6-9][0-9]{9}" title="Phone number should start with 6 or 7 or 8 or 9  and 10 chars long.( e.g 7896845214)" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Education</label>
                                        <input type="text" class="form-control" name="education" placeholder="Enter Education" id="education" required>
                                    </div>
                                    <div class="form-group col-lg-6 pl10">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-lg-12">
                                    <div class="button-div"><button type="submit" class="btn btn-block knowledge-link profile-save-btn">Save</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="photo" role="tabpanel">
                        <form class="row" enctype="multipart/form-data" id="photoUploadForm">
                            @csrf
                            <div class="col-lg-12 col-12">
                                <h4 class="small-heading-black">Preview Photo</h4>
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <p class="heading-form">Add / Change Image</p>
                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" required>
                                        <label for="imageUpload"></label>
                                        <div class="btn-div2"><button type="submit" class="btn btn-md knowledge-link upload-photo-btn">Save</button></div>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                    <div class="avatar-preview">
                                        <img id="outputImage" src="{{asset('/asset_website/img/imgPreview.png')}}" alt="" >
                                        {{-- <div id="outputImage" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="account" role="tabpanel">
                        <div class="account-form">
                            <form class="row" id="updatePasswordForm">
                                @csrf
                                <div class="col-lg-12 col-6">
                                    <h4 class="small-heading-black">Password</h4>
                                </div>

                                <div class="form-group col-lg-12">
                                    <input type="password" class="form-control" name="currentPassword"  placeholder="Enter Current Password" id="currentPassword" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="password" class="form-control" name="newPassword" placeholder="Enter New Password" id="newPassword" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" id="confirmPassword" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="button-div1"><button type="submit" class="btn btn-block knowledge-link change-password-btn">Change Password</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="payment" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h4 class="small-heading-black">Card Saved</h4>
                            </div>
                            <div class="col-lg-12">
                                <ul class="list-inline card2-list">
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>
                                    <li>
                                        <div>
                                            <div class="card-img"><img src="{{asset('asset_website/img/cart/visa.png')}}" class="w100"></div>
                                            <div class="card-desc">
                                                <p class=""><span class="f14">ICICI CREDIT CARD5267-</span> <br />
                                                    <span class="f12">XXXXXXXX-3499 </span><br />
                                                    <span class="f10">VALID TILL 08/23</span>
                                                </p>
                                            </div>
                                            <div class="name-on-card">Hirak jyoti das</div>
                                            <div class="remove-card"><a href="">REMOVE</a></div>
                                        </div>

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="notification" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h4 class="small-heading-black">Notification</h4>
                            </div>
                            <div class="col-lg-12">
                                <ul class="list-inline notification-list">
                                    <li>
                                        <div>
                                            <h4 class="small-heading-black mb0">New Course Add. please Check it .</h4>
                                            <p class="text-justify mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h4 class="small-heading-black mb0">New Course Add. please Check it .</h4>
                                            <p class="text-justify mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h4 class="small-heading-black mb0">New Course Add. please Check it .</h4>
                                            <p class="text-justify mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="purchase" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <h4 class="small-heading-black">Purchase History</h4>
                            </div>
                            <div class="col-lg-12">
                                <table id="purchase_history_table" class="table table-striped">
                                    @if(!$purchase_history->isEmpty())
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl No.</th>
                                            <th>Course Name</th>
                                            <th>Chapter Name</th>
                                            <th>Price ( <i class="fa fa-inr" aria-hidden="true" style="color:green;"></i> )</th>
                                            <th>Purchase Date</th>
                                        </tr>
                                    </thead>
                                    @endif
                                    <tbody>
                                        @forelse ($purchase_history as $key =>  $item)
                                            <tr class="text-center">
                                                <td>{{$key + 1}}</td>
                                                <td>{{$item->course->name}}</td>
                                                <td>{{$item->chapter->name}}</td>
                                                <td>{{$item->chapter->price}}</td>
                                                <td>{{$item->updated_at->format('d-M-Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <div class="text-center">
                                                    <p>Oops! No items purchased yet.</p>
                                                    <div class="shipping-div text-center"><a href="{{route('website.course')}}" class="shipping-btn">Continue shoping</a></div>
                                                </div>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.website.include.modals')
@endsection

@section('scripts')
    @include('layout.website.include.modal_scripts')
    <script>

        function previewImage(event){
            let reader = new FileReader();
            reader.onload = function(){
                let output = document.getElementById('outputImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        



    /******************  For Profile Section ******************/    
        $('#gender').attr("disabled", true); 
        $('.profile-save-btn').attr("disabled", true); 
        $('.profile-save-btn').addClass('knowledge-link-old');
        $('.profile-save-btn').removeClass('knowledge-link');
        $('#profileForm input').attr('readonly', 'readonly');
        $('.cancel-edit-btn').hide();
        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $('.edit-btn').on('click',function(){
            $('#gender').attr("disabled", false); 
            $('.profile-save-btn').attr("disabled", false); 
            $('#profileForm input').attr('readonly', false);
            $('.edit-btn').hide();
            $('.cancel-edit-btn').show();
            $('.profile-save-btn').addClass('knowledge-link');
            $('.profile-save-btn').removeClass('knowledge-link-old');
        });

        $('.cancel-edit-btn').on('click',function(){
            $('.edit-btn').show();
            $('.cancel-edit-btn').hide();
            $('#gender').attr("disabled", true); 
            $('.profile-save-btn').attr("disabled", true); 
            $('#profileForm input').attr('readonly', 'readonly');
            $('.profile-save-btn').addClass('knowledge-link-old');
            $('.profile-save-btn').removeClass('knowledge-link');
        });


        $('#profileForm').on('submit',function(e){
            e.preventDefault();

            $('.profile-save-btn').text('saving...');

            $.ajax({
                url:"{{route('website.user.details')}}",
                type:"POST",
                data:$('#profileForm').serialize(),
                
                success:function(data){
                    toastr.success(data.message);
                    $('#gender').attr("disabled", true); 
                    $('.profile-save-btn').attr("disabled", true); 
                    $('#profileForm input').attr('readonly', 'readonly');
                    $('.profile-save-btn').text('save');
                    $('.cancel-edit-btn').hide();
                    $('.edit-btn').show();
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Oops! Something went wrong while saving.');
                    }
                    $('.cancel-edit-btn').hide();
                    $('.edit-btn').show();
                    $('.profile-save-btn').text('save');
                }
            });
        });



        /*******************************User Photo Upload*****************************/
        $('#photoUploadForm').on('submit',function(e){
            e.preventDefault();

            let formData = new FormData(this);
            $('.upload-photo-btn').text('uploading...');

            let photoName = $('#imageUpload').val();
            let extension = photoName.split('.').pop();

            if( ! (extension == 'jpg'  || extension == 'png' || extension == 'jpeg') ){
                toastr.error('Oops! Not an image. Allowed extensions JPG, PNG, JPEG');
                $('#photoUploadForm')[0].reset();
                $('.upload-photo-btn').text('save');
            }else{
                $.ajax({
                    url:"{{route('website.user.upload.photo')}}",
                    type:"POST",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:formData,
                    success:function(data){
                        toastr.success(data.message);
                        $('#photoUploadForm')[0].reset();
                        $('.upload-photo-btn').text('save');
                        location.reload(true);
                    },
                    error:function(xhr, status, error){
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! Something went wrong while saving.');
                        }
                        $('#photoUploadForm')[0].reset();
                        $('.upload-photo-btn').text('save');
                    }
                });
            }
        });

    /**************************** Update Password Section **************************/    
        $('#updatePasswordForm').on('submit',function(e){
            e.preventDefault();
            $('.change-password-btn').text('please wait...')

            let crntPwd = $('#currentPassword').val();
            let newPwd = $('#newPassword').val();
            let confPwd = $('#confirmPassword').val();

            if(crntPwd == newPwd){
                toastr.error('Oops! New Password and Current Password should not be same');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            }else if(newPwd.length < 4){
                toastr.error('Oops! password length should not be less than 4 characters');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            }else if(newPwd != confPwd){
                toastr.error('Oops! password not matched');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            }else{
                $.ajax({
                    url:"{{route('website.update.password')}}",
                    type:"POST",
                    data:$('#updatePasswordForm').serialize(),
                    success:function(data){
                        if(data.status == 1){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                        $('#updatePasswordForm')[0].reset();
                        $('.change-password-btn').text('Change Password');
                    },
                    error:function(xhr, status, error){
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! Something went wrong while saving.');
                        }
                        $('#updatePasswordForm')[0].reset();
                        $('.change-password-btn').text('Change Password');
                    }
                });
            }
        });

        /*******************************  Purchase History***************************************/
        $(document).ready( function () {
            $('#purchase_history_table').DataTable({
                "processing": true,
                dom: 'Bfrtip',
                buttons: [ 'excel', 'pdf', 'print'
                    // {
                    //     extend:'pdfHtml5',
                    //     title:'Purchase History',
                    //     orientation:'landscape',
                    //     header:true,

                    //     customize:function(doc){
                    //         let colCount = new Array();
                    //         $('#purchase_history_table').find('tbody tr:first-child td').each(function(){
                    //             if($(this).attr('colspan')){
                    //                 for(let i=1;i<=$(this).attr('colspan'); i++){
                    //                     colCount.push('*');
                    //                 }
                    //             }else{
                    //                 colCount.push('*');
                    //             }
                    //         });
                    //         doc.content[1].table.widths = colCount;
                    //     }

                    // }
                ]
            });
        });
    </script>
@endsection
