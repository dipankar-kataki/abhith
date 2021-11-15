@extends('layout.website.auth')

@section('title', 'User | Login')

@section('main')

    <section class="login-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-div">
                        <div class="login-logo"><img src="{{ asset('asset_website/img/home/logo.png') }}"
                                class="w100"></div>

                        <a onclick="goBack()" class="page-close"><span class="icon-cancel-30"></span></a>
                        <div class="login-cover">
                            <ul class="nav nav-tabs login-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">Log In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">Sign Up</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form class="row" action="{{route('website.auth.login')}}" method="POST" id="loginForm">
                                        @csrf
                                        <div class="form-group col-lg-12">
                                            <input type="email"name="email"  class="form-control" placeholder="Email" id="email" required>
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input type="password" name="password" class="form-control" placeholder="password"
                                                id="password" required>
                                            <span class="text-danger">@error('password'){{$message}}@enderror</span>
                                        </div>
                                        <span class="text-danger ml-2">
                                            @if($errors->any())
                                                {{$errors->first()}}
                                            @endif
                                        </span>
                                        <div class="form-group mb0 col-lg-12">
                                            <button type="submit" class="btn btn-block login-btn" id="loginBtn">Login</button>
                                        </div>
                                        <div class="col-lg-12 forgot-div"><a href="{{ route('website.forgot.password') }}"
                                                class="text-center">Forgot Password</a></div>
                                    </form>

                                    <div class="google-div"><a href="#" class="google-btn"><span
                                                class="icon-google-30 google-icon"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span><span
                                                    class="path6"></span></span>Continue with Google</a></div>
                                    <div class="facebook-div"><a href="#" class="facebook-btn"><span
                                                class="icon-facebook-07 facebook-icon"></span>Continue with Facebook</a>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form class="row" id="signupForm">
                                        @csrf
                                        <div class="form-group col-lg-12">
                                            <input type="text" class="form-control" name="fname" placeholder="First Name" id="fname" pattern="^([a-zA-Z]+)$" title="Please Enter Letters only." value="{{old('fname')}}" required>
                                            <span class="text-danger">@error('fname'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" id="lname" pattern="^([a-zA-Z]+)$" title="Please Enter Letters only." value="{{old('lname')}}" required>
                                            <span class="text-danger">@error('lname'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input type="email" name="email" class="form-control" placeholder="Email" id="p_number1" value="{{old('email')}}" required>
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input type="password" name="password" class="form-control" placeholder="Password" id="pwd" required>
                                            <span class="text-danger">@error('password'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                                                id="confPwd" required>
                                        </div>
                                        <div class="form-group mb0 col-lg-12">
                                            <button type="submit" class="btn btn-block sign-btn" id="signupBtn">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
   
    <script>
        $('#signupForm').on('submit',function(e){
            e.preventDefault();

            $('#signupBtn').text('Please wait...');

            let pass = $('#pwd').val();
            let confirm_pass = $('#confPwd').val();

            if(pass != confirm_pass){
                toastr.error('Oops! password not matched');
                $('#signupBtn').text('Sign up');
            }else if(pass.length < 5 ){
                toastr.error('Oops! password must be 5 characters long');
                $('#signupBtn').text('Sign up');
            }else{
                $.ajax({
                    url:"{{route('website.auth.signup')}}",
                    type:"POST",
                    data:$('#signupForm').serialize(),
                    success:function(data){
                        if(data.status == '201'){
                            toastr.success(data.message);
                        }else if(data.status == '403'){
                            toastr.error(data.message);
                        }else{
                            toastr.error('Oops! Something went wrong');
                        }
                        $('#signupForm')['0'].reset();
                        $('#signupBtn').text('Sign up');
                    
                    },
                    error: function(xhr, status, error) {
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! something went wrong');
                        }
                        $('#signupForm')['0'].reset();
                        $('#signupBtn').text('Sign up');
                    }

                });
            }
        })
    </script>
@endsection



</body>

</html>
