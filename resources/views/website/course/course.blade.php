@extends('layout.website.website')

@section('content')

<section class="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <div class="subheader-image"><img src="{{asset('asset_website/img/course/banner.png')}}" class="w100"></div>
                <div class="subheader-image-desc">
                    <h2 class="heading-black">Our Courses<br>
                        <span class="heading-blue">Study Beyond The Classroom</span></h2>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-courses">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <h2 class="heading-black">All Course</h2>
            </div>
            <div class="col-lg-5 p0">
                <ul class="list-inline course-btn-list">
                    <li>
                        <div class="course-select">
                            <div class="selectBtn" data-type="planningStage">Subjects</div>
                            <div class="selectDropdown">
                                <div class="option" data-type="Subjects">-- Select Subjects --</div>
                                @foreach ($subjects as $item)
                                    <div class="option" data-type="{{$item->name}}">{{$item->name}}</div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li><input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Course">
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 p-0">
                <ul class="list-inline courses-list">
                    @foreach ($publishCourse as $item)
                    <li>
                        <div class="course-pic"><img src="{{asset($item['course_pic'])}}" class="w100"></div>
                        <div class="course-desc"><span class="icon-clock-09 clock-icon"></span><span>{{$item['duration']}}</span>
                            <div class="block-ellipsis5"><h4 class="small-heading-black">{{$item['name']}}</h4></div>
                            <span>₹{{$item['final_price']}}</span>
                            <a href="{{route('website.course.details',['id'=>\Crypt::encrypt($item['id'])])}}"  class="enroll">Enroll now</a>
                        </div>
                    </li>

                    @endforeach
                </ul>
                {{-- <div style="float:right;margin-top:10px;">
                    {{$publishCourse->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script>
    const select = document.querySelectorAll('.selectBtn');
    const option = document.querySelectorAll('.option');
    let index = 1;

    select.forEach(a => {
        a.addEventListener('click', b => {
            const next = b.target.nextElementSibling;
            next.classList.toggle('toggle');
            next.style.zIndex = index++;
        })
    })
    option.forEach(a => {
        a.addEventListener('click', b => {
            b.target.parentElement.classList.remove('toggle');

            const parent = b.target.closest('.course-select').children[0];
            parent.setAttribute('data-type', b.target.getAttribute('data-type'));
            parent.innerText = b.target.getAttribute('data-type');
        })
    })
</script>

@endsection
