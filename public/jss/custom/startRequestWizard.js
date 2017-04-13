$(document).ready(function(){

    var request_url = $('#myWizard').attr('action');
    var button;
    var v_available = true;
    statee = null;

    $('#state').change(function(){

        v_available = !v_available;
        statee = $(this).val();
    })
    
		$('#myModal').modalSteps({
			btnCancelHtml: 'Cancel',
			btnPreviousHtml: 'Previous',
			btnNextHtml: 'Next',
			btnLastStepHtml: 'Complete',
      callbacks: {
        '2': function(){

            var category_value = $('#category').val();
            
            if(category_value == ''){
              $('#myModal').modal('hide')
              alertify.alert('Please Select a Category')
            }
            else if(!v_available){
                checkVendorAvailability(category_value,$('#state').val(),$('#vicinity').val())
                v_available = true;
            } 
            
        }
    },
			disableNextButton: false,
			completeCallback: function(){
				/*** Ajax Call To Submit Form **/

					console.log($('#myWizard').serialize())
					alertify.delay(0).log("Request is been sent...").maxLogItems(1);

				$.ajax({
					url:request_url,
					type:"POST",
					data:$('#myWizard').serialize(),
          dataType:'json',
					contentType:"application/x-www-form-urlencoded",
					headers:{
						'X-CSRF-TOKEN':Laravel.csrfToken
					}
				})
				.done(function(data){
					$('#myModal').modal('hide');
					alertify.success(data.message);
          console.log(data);
				})
				.fail(function(data){
          console.log(data);
					alertify.log('An Error Occured Request Could Not Be Sent '+data.message);
				})

			}
		});/***End of Modal Step */



    $('#myModal').on('shown.bs.modal',function(event){
      var modal = $(this);
      button  = $(event.relatedTarget);

      if(button.data('state') !==  undefined && button.data('state') !== ''){
        var state = button.data('state');
        var vicinity_id = null;
        if(button.data('vicinity') !== '' && button.data('vicinity') !== undefined) vicinity_id = button.data('vicinity');
        else vicinity_id = 0;

        addStateLocality(state,vicinity_id);
      }
      else{
        addStateLocality();
      }
    
      
      //var cate = $('#category');
      //var c = $('#category option:selected').text().replace('- ','');
    

      $('#venue').show();
      toggleBudgetFields(false);
  })

    /***Start of Category event Operation */
       $('#category').on('change',function(){
         $('.themecolor').remove()
        categoryChange($(this));
    })/***End of Category event Operation */


    /*** Start of event Change operation */

    $('#event').change(function(){
      var self = $(this);

      //$('.themecolor').remove();
      $('.pP').remove();

       var event = $('#event option:selected').text();
    
       var exists = eventType[event] || null;

       //var category = $('#category option:selected').text().replace(/\s+/g, '');

        if(exists != null ){
         addExtraFormElement(exists,self)
       }
    })/***End of event Change Event operation */

    $('#browsevendor').change(function(){
      var cat = $(this).val();
      window.location.href ='http://localhost/eventing/public/browse_vendors/'+cat;
    })


    $('#start_request').submit(function(){
        
        //display the form wizard;
         return false;

  });/***End of Jquery events changeOperation */

  /***Start of vanilla functions */


   function checkVendorAvailability(cat_id,state = null,locality = null){

     if(state == null || locality == null){
       state = button.data('state') || $('#state').val();
       locality = button.data('vicinity') || $('#vicinity').val() || 0;
       if(locality == 'all');
         locality = 0;
     }
      var data = {'state':state,'locality':locality,'category':cat_id};
      console.log(data);

      alertify.log("Checking if vendors are available").maxLogItems(1);
    
        $.ajax({
          url:myUrl+'check_vendor_availabity',
          type:'GET',
          data:data,
          success:function(data){
            if(data.available == 0){
              console.log(data.available)
              v_available = false;
              $('#myModal').modal('hide')
              alertify.alert('No vendor for available for the criteria')
              alertify.log('No vendors available')
            }
            else alertify.log(''+data.available+' vendor(s) available')
          }
        })
   }

    function categoryChange(self){

        if($('.divContainer')){
          $('.divContainer').remove();
        }

        var category = $('#category option:selected').text();
         category = category.replace(/\s+/g, '');


        var state = $('#state').val(); var locality = $('#vicinity').val();
        checkVendorAvailability(self.val(),state,locality)

       
        
        console.log(category)
        
        var data = formElements[category];
            console.log(data);
            if(data){
              addAdditionalService(data,self);
            }
            else if($.inArray(category,eventPlanning) != -1){
                addThemeColorInputElements($('#div_event'));
            }
            else if(category == 'Transport'){
              addTransportInputs();
              $('#venue').hide();
            }
        
          
        
    } 
    function addStateLocality(state1 = null,vicinity_id = null){

      var state,locality,stateInput,localityInput, inputs;

          if(state1 !== null && vicinity_id !== null){

            alert(state1 + " "+ vicinity_id);
                state = state1; locality = vicinity_id;
                console.log(vicinity_id+' '+state1 );
                 if(locality == 'all')
                     locality = 0;

                stateInput = $('<input type="hidden" name="state" value="'+state+'" ></input>');
                localityInput = $('<input type="hidden" name="vicinity" value="'+locality+'"></input>');
                $('#myWizard').append(stateInput);
                $('#myWizard').append(localityInput);
          }
          else{

                   state = $('#state').val()
                   locality = $('#vicinity').val();

                  if(state == undefined || state == ''){
                          
                        $('#myModal').modal('hide');
                        alertify.alert('Please select a state and locality')
                          
                      }
                      else{

                          if(locality == 'all')
                             locality = 0;
                          stateInput = $('<input type="hidden" name="state" value="'+state+'" ></input>');
                          localityInput = $('<input type="hidden" name="vicinity" value="'+locality+'"></input>');
                          $('#myWizard').append(stateInput);
                          $('#myWizard').append(localityInput);
                      }
            }
    }
    

    function addAdditionalService(data,ele){

        var divContainer = $(`<div class="control-group divContainer">
                              <label class="control-label" for="inputCity">Do You Require Additional Service?</label>
                             </div>
                          `);

              data.additional.forEach(function(element) {

                /**<div class="checkbox">
												<label>
													<input type="checkbox" value="">
													Option one is this and that&mdash;be sure to include why it's great
												</label>
											</div>*/


                var divContent = $(`<div class="checkbox"></div>`);
                var outerLabel = $('<label></label');
                var formInput =  $('<input type="checkbox" name="extra[]"  value="'+element.id+'">'+element.name+'</input>')
             // var formInput = $('<input type="checkbox" name="extra[]" class="" value="'+element.id+'">'+element.name+'</input>')
                 outerLabel.append(formInput);
                 divContent.append(outerLabel);
                 
                 //divContent.append();
                 divContainer.append(divContent)

              }, this);

        if(data.extras != null){
                  data.extras.forEach(function(ele){
                      var input = $('<input>');
                      var label = $('<label>')
                      label.text(ele.name);
                      divContainer.append(label);

                      input.attr({
                        name:ele.formname,
                        class:'form-control input-lg',
                        value:''
                      },this).append('<br>');
                      divContainer.append(input);
                  })
        }
        divContainer.insertAfter(ele)
    }

    function addThemeColorInputElements(element){
      var e= element;

      var divContainer = $(`<div class="control-group themecolor">
                              <label class="control-label" for="inputCity">Please Select Theme and Color</label></br>
                             </div>
                          `);

      var themeQuestionSelect = $('<select name="theme"></select></br>');
      themeQuestionSelect.addClass('form-control input-lg');
      var themeLabel = $('<label class="control-label">Theme</label></br>');


      divContainer.append(themeLabel)
      var options = ['Beach','Sand'];

      options.forEach(function(element) {
        var opt = $('<option value="'+element+'">'+element+'</option>');
        themeQuestionSelect.append(opt);
      }, this);

      divContainer.append(themeQuestionSelect);
      
      var colorQuestionInput = $('<input name="color"></input>');
      colorQuestionInput.addClass('form-control input-lg');
      var colorLabel = $('<label class="control-label">Color</label></br>');
      divContainer.append(colorLabel);

      
      divContainer.append(colorQuestionInput);

      $('#eventtype').append(divContainer);
     // divContainer.insertAfter(e);

  }

  function addExtraFormElement(e,element){
      var divC = $('<div>');
      divC.addClass('control-group pP');

      var label = $('<label>');
      var br = $('<br>');
      label.text('Is it a Public or Private Event');
      
      


      divC.append(label);
      br.insertAfter(label);
     
      e.forEach(function(element){

          var pue = $('<input>')
          
          pue.attr({
            name:element.formname,
            type:element.type,
            value:element.name,
            class: 'form-control'
          });

          pue.on('click',function(){
            
              if(element.hasOwnProperty('siblings')){

                public  = true;
                toggleBudgetFields(public);
                
                element.siblings.forEach(function(e){

                    var sibling = $('<input>');
                    var label = $('<label>');

                    label.attr('class','os');
                    label.text(e.name);

                    sibling.attr({
                      name:e.formname,
                      class:'form-control os',
                    })

                    if(e.name != 'Website')
                      sibling.attr('required',true);

                    divC.append(label);
                    sibling.insertAfter(label);
                },this)
              }
              else {
                    $('.os').remove();
                    public = false;
                    toggleBudgetFields(public)
              }
          })

          var pLabels = $('<label>');
          pLabels.text(element.name);

          divC.append(pLabels);

          divC.append(pue);
      })
      $('#eventtype').append(divC);
        //divC.insertAfter(next);
  }

  function toggleBudgetFields(public){
    if(public){
      $('#normalbudget').hide();
      $('#publicbudget').show();
    }
    else{
      $('#publicbudget').hide();
      $('#normalbudget').show();
    }
  }

  function addTransportInputs(){}
  

   
})//doument.ready