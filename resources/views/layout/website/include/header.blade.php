@php
    use App\Models\Cart;
    use Illuminate\Support\Facades\Auth;
    if(Auth::check()){
        $cart_items = Cart::where('user_id', Auth::user()->id)->count();
    }
@endphp


<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-8">HELPING CREATE SUCCESS</div>
            <div class="col-lg-5 col-4">
                <ul class="list-inline header-social  mb0">
                    <li><a href="#"><span class="icon-facebook-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-linkdin-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-twitter-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-instagram-07 header-social-icon"></span></a></li>
                </ul>
            </div>
            @auth
            <div class="col-lg-4  col-12">
                <ul class="list-inline login-details">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle login-text" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="icon-user-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>{{Auth::user()->firstname}}<span class="caret"></span></a>
                        <ul class="dropdown-menu account-list">
                            <li class="ac-list"><a href="{{route('website.user.account')}}" class="login-text1">My Account</a></li>
                            <li class="ac-list">
                                <form action="{{route('website.auth.logout')}}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-default" style="margin-left:-10px;color:black;font-weight:500;border:none;font-size:13px;">Sign Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('website.cart')}}" class="login-text"><span class="icon-cart-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>Cart ( {{ $cart_items }} )</a>                            
                    </li>
                </ul>
            </div>
            @endauth
            @guest
                <div class="col-lg-4 col-12">
                    <ul class="list-inline login-details">
                        <li>
                            <a href="{{route('website.login')}}" class="login-text" target="_parent"><span class="icon-user-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>Login/Sign Up</a>
                        </li>
                        <li>
                            <a href="{{route('website.cart')}}" class="login-text"><span class="icon-cart-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>Cart</a>
                        </li>
                    </ul>

                </div>
            @endguest
        </div>
    </div>
</div>
