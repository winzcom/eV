@foreach($categories as $category)

    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="{{url('/category/')}}/{{$category->name}}" class="fh5co-card-item">
                            <figure>
                                <div class="overlay"><!--<i class="ti-plus"></i>--></div>
                                <img src="{{asset('savatory/images/img_1.jpg')}}" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>{{$category->name}}</h2>
                                <!--<p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                <p><span class="price cursive-font">$19.15</span></p>-->
                            </div>
                        </a>
    </div>
@endforeach
