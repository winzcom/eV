@component('mail::message')


New Request From {{$data['customer']->first_name}} {{$data['customer']->last_name}} For 
{{$data['users_data']->first()->categories()->where('categories.id',$data['category'])->first()->name}}

@component('mail::panel')
  @foreach($data['request'] as $key=>$value)
        @php
            if(is_array($value)){
                echo 'Additional Services ( ';
                foreach($value as $val){
                    echo $val.' ';
                }
                echo ' )<br><br>';
                continue;
            } 
        @endphp
        {{title_case($key)}} : {{$value}}<hr>
            
@endforeach
@endcomponent

Thanks,<br>

@endcomponent
