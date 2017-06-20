
<html>
    <head>
        
    </head>
    <body>
        @component('mail::message')
        <div>
        @component('mail::panel')
            <div>
                    <h3>
                        New Request From {{ $data['customer']->first_name }} {{ $data['customer']->last_name }} for 
                        {{ $data['users_data']->first()->categories()->where('categories.id',$data['category'])->first()->name }}
                    </h3>
            </div>


            <div>
                @foreach( $data['request'] as $key => $value )
                    <div class="col-xs-6 col-sm-6 col-md-4">
                        @php 
                            if(is_array($value)) {
                                echo $key.'(';
                                    echo implode(',',$value);
                                echo ')</br>';
                                continue;
                            }
                            
                        @endphp
                    </div>
                    {{ ucfirst(str_replace('_',' ',title_case($key))) }} : {{ $value }}
                @endforeach
            </div>
            @component('mail::button',['url' => ''])
                Login to reply
            @endcomponent
            Thanks,<br>
            {{ config('app.name') }}
            @endcomponent
        </div>
        @endcomponent
    </body>
</html>

