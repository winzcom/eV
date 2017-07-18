@extends('emails.layout.email')

@section('content')

   @inject('service','App\Service\Service')

           <table cellpadding="0" cellspacing="0" border="0" align="center">
                <h3>
                    New Request From {{ $first_name }} {{ $last_name }} for 
                    {{ $category }}
                </h3><br><br>

                
                    @foreach( $requests as $key => $value )
                        <tr>
                            @php 
                                if(is_array($value)) {
                                    echo '<td width="200" valign="top">'.ucfirst(str_replace('_',' ',title_case($key))).'(';
                                        echo implode(',',$value);
                                    echo ')</td>';
                                    continue;
                                } elseif($key == 'price_range') {
                                        list($lower, $higher) = explode('-',$value);
                                        echo str_replace('_',' ',title_case($key)).': &#8358;'.$service->currencyFormatter($lower).'- &#8358;'.$service->currencyFormatter($higher).'<br><br>';
                                        continue;
                                }
                                
                            @endphp
                        <td>{{ ucfirst(str_replace('_',' ',title_case($key))) }} : {{ $value }}</td>
                        </tr><hr><br>
                    @endforeach
                
                Thanks,
                {{ config('app.name') }}
            </table>

@endsection
        