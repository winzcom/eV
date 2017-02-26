<li><a href="{{ url('/home') }}" <?php 
    if(Request::url() == url('/home')) echo "style = 'border-bottom:solid 3px #333333; color:#fff;'"
?> class="cat" style="color:#fff;">Home</a>
</li>
<!--<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
       Profile <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{url('/profile/edit',Auth::user()->name_slug)}}">
                Edit Profile
            </a>
        </li>

        <li>
            <a href="{{ url('/gallery') }}">
                Gallery
            </a>
        </li>

        <li>
            <a href="{{ url('/account') }}">
                Account
            </a>
        </li>

    </ul>
</li>-->
<?php $url = Request::url();?>

<li><a href="{{ url('/profile/edit') }}" <?php 
    if($url == url('/profile/edit',Auth::user()->name_slug)) echo "style = 'border-bottom:solid 3px #333333; color:#fff;'"
?> class="cat" style="color:#fff;">Profile</a>
</li>

<li><a href="{{ url('/reviews') }}" class="cat"  <?php 
    if($url == url('/reviews') || $url == url('/reviews/gt') || $url == url('/reviews/lt')) 
    echo "style = 'border-bottom:solid 3px #333333; color:#fff;'"
?> style="color:#fff;">Reviews</a>
</li>

<li><a href="{{ url('/quotes') }}" <?php 
    if($url == url('/quotes')) echo "style = 'border-bottom:solid 3px #333333; color:#fff;'"
?> class="cat" style="color:#fff;">Quotations</a>
</li>

<li><a href="{{ url('/gallery') }}" <?php 
    if($url == url('/gallery')) echo "style = 'border-bottom:solid 3px #333333; color:#fff;'"
?> class="cat" style="color:#fff;">Gallery</a>
</li>