$(document).ready(function(){

   $('#show_details').on('show.bs.modal',function(event){

       
       var button = $(event.relatedTarget);
       var review = button.data('review');
       var reply = button.data('reply');
       var reviewer = button.data('reviewer');
       var description = button.data('description');
       var company_name = button.data('companyName');
       var rating = button.data('rating');
       console.log(rating);
       var title = $('#title');

       title.text('Details for '+company_name);

       console.log(Object.keys(review)[0])
       if(Object.keys(review).length > 0 && review[Object.keys(review)[0]] !== null){

           showReviewsAndReply(review,reply,reviewer,rating);
           
       }

       showDescription(description);
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
        
                $.each(reviews,function(key,value){

                var review = document.createElement('p');
                review.innerHTML = value;

                var rev = '<h4>'+reviewer[key]+' '+rating[key]+'</h4>'

                reviewDiv.insertAdjacentHTML('beforeend',rev)
                reviewDiv.appendChild(review);
                //reviewDiv.insertAdjacentHTML('beforeend',review)
                
                if(reply[key] !== '' && reply[key] !== null){

                    
                    var d = `<div class="well">
                        <small>Supplier's Reply</small></br>
                        <i>`+reply[key]+`</i>
                    </div>`;

                    reviewDiv.insertAdjacentHTML('beforeend',d);
                }
                
            })
    }

    function showDescription(description){

        var reviewDiv = document.getElementById('description');

        var desc = '<p>'+description+'</p>';

        reviewDiv.insertAdjacentHTML('afterbegin',desc)
    }


})