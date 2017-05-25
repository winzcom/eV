$(document).ready(function(){

  

    $("#event_date").datepicker();

    $('.slick-carousel').slick({
        //infinite: false,
        //slidesToShow: 3,
        //slidesToScroll: 3,
        adaptiveHeight:true,
        //mobileFirst:true,
        arrows:true
    });


    $( "#slider-range" ).slider({
      range: true,
      min: 500,
      max: 200000,
      step:100,
      values: [ 500,20,000000 ],
      slide: function( event, ui ) {
        $("#amount").text( "Budget : N" + ui.values[ 0 ] + " - N" + ui.values[ 1 ]);
        $( "#budget" ).val(ui.values[ 0 ] + "-" +ui.values[ 1 ] );
      }
    });
    /*$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );*/
        
      var dateFormat = "yy-mm-dd",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          dateFormat:dateFormat,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:dateFormat
      })
      //.on( "change", function() {
        //from.datepicker( "option", "maxDate", getDate( this ) );
      //});
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }

    $('#offdays').submit(function(){
      event.preventDefault();
      
      var submit_date = document.getElementById('submit_date');
      submit_date.value = "Adding..."
      submit_date.disabled = true;
      var from_date = $('input[name=from_date]').val(), to_date = $('input[name=to_date]').val();

      var uri = "/eWeb/public/add/offdays";
      $.ajax({
            url:uri,
            beforeSend:function(request){
                request.setRequestHeader('X-CSRF-TOKEN',document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'))
            },
            type:"POST",
            dataType:'json',
            data:{'from_date':from_date,'to_date':to_date},
            success:function(data){
                submit_date.value = 'Add Date'
                submit_date.disabled = false;
                addDate(data);
            },
            error:function(err){
                console.log(err)
                handleError(err.responseText)
                submit_date.value = 'Add Date'
                submit_date.disabled = false;
            }
        })
    })

    function addDate(data){

        let span = document.createElement('span');
        span.setAttribute('class','glyphicon glyphicon-remove');

        let spandate = document.createElement('span');
        spandate.setAttribute('class','glyphicon glyphicon-chevron-right');

        let text = document.createTextNode(data.from_date+'--'+data.to_date);

        let button = document.createElement('button');
        button.setAttribute('class','w3-btn-floating-small w3-red li');
        button.appendChild(span);

        let li = document.createElement('li');
        li.setAttribute('class','list-group-item li line');
        li.setAttribute('data-date',data.date_id);
        li.appendChild(spandate);
        li.appendChild(text);
        li.appendChild(button);

        let div = document.createElement('div');
        div.setAttribute('class','');
        div.appendChild(li);

        

        var ul = document.getElementById('offdays_ul');
        ul.appendChild(div);

        (function(li,id){
          button.addEventListener('click',function(){
            removeDate(li,id);
          })
        })(li,data.date_id)

              //ul.insertAdjacentHTML('afterbegin',content);
    }//endofaddDate


    $('.remove_off_day').click(function(){
        let self = $(this);
        let parent = self.parent();
        let id = parent.data('date');
        removeDate(parent,id);
    })

    function removeDate(parent,id){
      let uri = '/eWeb/public/remove/offdays'
        $.ajax({
            url:uri,
            beforeSend:function(request){
                request.setRequestHeader('X-CSRF-TOKEN',document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'))
            },
            type:"GET",
            dataType:'json',
            data:{'date_id':id},
            success:function(data){
              parent.fadeOut("slow",function(){
                $(this).remove();
              })
              $('input[name=from_date]').val('') ;$('input[name=to_date]').val('')
              alert(data.status);
            },
            error:function(err){
                console.log(err)
            }
        })//end of ajax call
    }

    

});// document ready
