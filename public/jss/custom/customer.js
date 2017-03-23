$(document).ready(function(){



    $('.pop_over_details').popover({

        html:true,
        container:'body'
    })  

    $('.pop_over_details').on('shown.bs.popover', function () {
       
        $('.rate').each(function(i,e){
            
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

        $('.slick').slick();
    })

    $('.pop_over_details').on('hidden.bs.popover', function () {
       

        $('.slick').slick('unslick');
    })

    var ph = $('#reply').data('ph');
    var product = document.getElementById('slick_slider');
        
    var slick = $('.slickslider');  

   $('#show_details').on('show.bs.modal',function(event){


       
       var button = $(event.relatedTarget);
       var review = button.data('review');
       var reply = button.data('reply');
       var reviewer = button.data('reviewer');
       var description = button.data('description');
       var company_name = button.data('companyName');
       var rating = button.data('rating');
       var gallery = button.data('gallery');

       console.log(gallery);
       //console.log(rating);

       var title = $('#title');

       title.text('Details for '+company_name);

       console.log(Object.keys(review)[0])
       if(Object.keys(review).length > 0 && review[Object.keys(review)[0]] !== null){

           showReviewsAndReply(review,reply,reviewer,rating);
           
       }

       if((Object.keys(gallery).length > 0 && gallery[Object.keys(gallery)[0]] !== null) || gallery.length > 0){

           
           showGallery(gallery);
           
       }
       else{
            var product = document.getElementById('slick_slider');
            product.innerHTML = '';
       }

       showDescription(description);
       
   })

  /* $('[href="#gallery"]').on('shown.bs.tab', function (e) {
        $('.gallery').resize();
    });*/

   $('body').on('hidden.bs.modal',function(event){

        var reviewDiv = document.getElementById('review');
        reviewDiv.innerHTML = '';
        var reviewDiv = document.getElementById('description');
        reviewDiv.innerHTML = '';
        
        

        $('.slickslider').slick('unslick');

        $(this).removeData('bs.modal');
        
        
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

    function showGallery(gallery_names){

        
        var img = ''
        product.innerHTML = '';
        
        $.each(gallery_names,function(key,value){
            console.log(value)
            if(value != null){
                img += '<img src="'+ph+'/'+value+'"/>';
            }
           
        })
        
            
           //product.insertAdjacentHTML('beforeend',img);
           slick.slick();
           slick.slick('slickAdd',img);
           slick.slick('setPosition')
          
          
    }

})