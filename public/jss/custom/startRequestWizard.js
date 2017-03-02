$(document).ready(function(){


    var formElements = {
      'Caterers':{
                    'additional':[
                            {name:'Catering Equipment',id:27,type:'checkbox',formname:'cateringadditions[]'},
                            {name:'TableWare',id:19,type:'checkbox',formname:'cateringadditions[]'},
                            {name:'Waiting Staffs',id:3,type:'checkbox',formname:'cateringadditions[]'}
                          ]
                },
      '- Canapes':{
                     'additional':[{name:'Waiting Staffs',id:1}]
                  },
      '- Vegetarian and Vegan Catering':{
                     'additional':[{name:'Waiting Staffs',id:1}]
                  },
      '- TableWare':{
                     'additional':[{name:'Catering Equipment',id:27}]
                  },
      '- Corporate Event Catering':{
                     'additional':[{name:'Waiting Staffs',id:1}]
                  },
      '- Buffet':{
                     'additional':[{name:'Waiting Staffs',id:1}]
                  },
      '- Bell Tents': {
                          'additional':[
                            {name:'Catering Equipment',id:27,type:'checkbox',formname:'cateringadditions[]'},
                            {name:'TableWare',id:19,type:'checkbox',formname:'cateringadditions[]'},
                            {name:'Waiting Staffs',id:3,type:'checkbox',formname:'cateringadditions[]'}
                          ],
                          'extras':[
                                    {name:'Tent Color',formname:'tentcolor',type:'text'},
                                    {name:'Tent Liner',formname:'tentliner',type:'text'}
                                  ]
                      }

    }

    var eventType = {
      'Concert':[
                      {name:'Public Event',type:'radio',formname:'eventtype',siblings:

                          [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                      },
                      {name:'Private Event',type:'radio',formname:'eventtype'}
                  ],
      'Business Event':[
                        {name:'Public Event',type:'checkbox',formname:'eventtype'},
                        {name:'Private Event',type:'checkbox',
                          siblings:
                               [{name:'Name of Event',formname:'eventname'}]
      }]
    }


    $('#myModal').on('shown.bs.modal',function(){
      //addStateLocality();
      $('#venue').show();
      toggleBudgetFields(false);

      /***Start of Category event Operation */
      $('#category').change(function(){
        if($('.divContainer')){
          $('.divContainer').remove();
        }
        var category = $('#category option:selected').text();
        var self = $(this);
        var data = formElements[category];
        if(data){
          addAdditionalService(data,self);
        }
        else if(category == 'Event Planner'){

        }
        else if(category == 'Transport'){
          addTransportInputs();
          $('#venue').hide();
        }
      })/***End of Category event Operation */


/*** Start of event Change Event */

    $('#event').change(function(){
      var self = $(this);

      $('.themecolor').remove();
      $('.pP').remove();

       var event = $('#event option:selected').text();
       var exists = eventType[event] || null;

       if(event == 'Wedding'){
         addThemeColorInputElements(self);
       }
       else if(exists != null ){
         addExtraFormElement(exists,self)
       }
    })
  })/***End of event Change Event */

    $('#browsevendor').change(function(){
      var cat = $(this).val();
      window.location.href ='http://localhost/eventing/public/browse_vendors/'+cat;
    })


    $('#start_request').submit(function(){
        
        //display the form wizard;
         return false;

  });/***End of Jquery events Operation */

  /***Start of vanilla functions */

   function addBudgetInputs(){


    }

    function addStateLocality(){

      var state,locality,stateInput,localityInput, inputs
      inputs = $('#start_request :input');
      if( inputs !== undefined && inputs !== null && inputs !=={} && inputs !== ''){
          state = inputs[0].value;
          locality = inputs[1].value;

          stateInput = $('<input type="hidden" name="state" value="'+state+'" ></input>');
          localityInput = $('<input type="hidden" name="vicinity" value="'+locality+'"></input>');
      }
      

      $('#myWizard').append(stateInput);
      $('#myWizard').append(localityInput);
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

      divContainer.insertAfter(e);

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

     
      divC.insertAfter(element);
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