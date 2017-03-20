$(document).ready(function(){

   $('#show_details').on('show.bs.modal',function(event){

       
       var button = $(event.relatedTarget);
       var review = button.data('review');
       var reply = button.data('reply');
       var reviewer = button.data('reviewer');
       var description = button.data('description');
       var company_name = button.data('companyName');
       var rating = button.data('rating');

       var title = $('#title');

       title.text('Details for '+company_name);

       if(review !== null){

           showReviewsAndReply(review,reply,reviewer,rating);
           showDescription(description);
       }
   })

   $('#show_details').on('hidden.bs.modal',function(event){

        var reviewDiv = document.getElementById('review');
        reviewDiv.innerHTML = '';
        var reviewDiv = document.getElementById('description');
        reviewDiv.innerHTML = '';

   })


   $('.rating').each(function(i,e){

        var self = $(this);
        var rating = self.data('rating');

        if(rating !=''){
            self.rateYo({
                rating:rating,
                readOnly:true,
                starWidth:'20px'
            })
        }
    })

    function showReviewsAndReply(reviews,reply,reviewer,rating){

        var reviewDiv = document.getElementById('review');
        console.log(reviews)
        
        if(!$.isEmptyObject(reviews)){

                $.each(reviews,function(key,value){
                console.log(rating)
                var review = '<p>'+value+'</p><span class="rating" data-rating="'+rating[key]+'"></span>'
                //console.log(reply)
                var rev = '<h4>'+reviewer[key]+'</h4>'

                reviewDiv.insertAdjacentHTML('beforeend',rev)
                reviewDiv.insertAdjacentHTML('beforeend',review)
                //console.log(value)
                if(reply[key] !== '' && reply[key] !== null){

                    //console.log(reply[key])
                    var d = `<div class="well">
                        <small>Supplier's Reply</small></br>
                        <i>`+reply[key]+`</i>
                    </div>`;

                    reviewDiv.insertAdjacentHTML('beforeend',d);
                }
                
            })
        }
    }

    function showDescription(description){

        var reviewDiv = document.getElementById('description');

        var desc = '<p>'+description+'</p>';

        reviewDiv.insertAdjacentHTML('afterbegin',desc)
    }


})