
        @component('mail::message')
        
        @component('mail::panel')
        
                        New Request From {{ $data['customer']->first_name }} {{ $data['customer']->last_name }} for 
                        {{ $data['users_data']->first()->categories()->where('categories.id',$data['category'])->first()->name }}
                


                @foreach( $data['request'] as $key => $value )
                        @php 
                            if(is_array($value)) {
                                echo $key.'(';
                                    echo implode(',',$value);
                                echo ')<br>';
                                continue;
                            }
                            
                        @endphp
                    {{ ucfirst(str_replace('_',' ',title_case($key))) }} : {{ $value }}<hr>
                @endforeach
            @component('mail::button',['url' => ''])
                Login to reply
            @endcomponent
            Thanks,<br>
            {{ config('app.name') }}
            @endcomponent
        @endcomponent

