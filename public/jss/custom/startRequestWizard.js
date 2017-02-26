$(document).ready(function(){

    var formElements = {
      'Caterers':[{name:'Catering Equipment',id:1},{name:'TableWare',id:2},{name:'WaitingStaffs',id:3}],
      '- Canapes':[{name:'Waiting Staffs',id:1}],
      '- Vegetarian and Vegan Catering':[{name:'Waiting Staffs',id:1}],
      '- TableWare':[{name:'Catering Equipment',id:1}],
      '- Corporate Event Catering':[{name:'Waiting Staffs',id:1 }],
      '- Buffet':[{name:'Waiting Staffs',id:1}]
    }

    var eventType = {
      'Charity Event':[{name:'Public Event',type:'checkbox'},{name:'Private Event',type:'checkbox'}],
      'Business Event':[{name:'Public Event',type:'checkbox'},{name:'Private Event',type:'checkbox',siblings:
        [{name:'Name of Event',formname:'eventname'}]
      }]
    }


    $('#myModal').on('shown.bs.modal',function(){
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
        else if(category == 'Event Planner'){}
      })// #category

      $('#eventtype').change(function(){
        var event = $('#eventtype option:selected').text();
        //var cat = $('#eventtype option:selected').text();
        if($('.themecolor')){
              $('.themecolor').remove();
        }

        var cat = 'Event Planner';
        var self = $(this);
        if(event == 'Wedding'){
          if(cat == 'Event Planner'){
            addThemeColorInputElements(self);
          }
        }
        else if(e = eventType[event]){

          addExtraFormElement(e);
        }
      })

    })

    


    $('#start_request').submit(function(){
        
        //display the form wizard;
         
        $('#myWizard').Wizard();
        var change = doucment.getElementsByClassName('category');
        alert(change);
         return false;

    });



    function addAdditionalService(data,ele){

        var divContainer = $(`<div class="control-group divContainer">
                              <label class="control-label" for="inputCity">Do You Require Additional Service?</label>
                             </div>
                          `);

              data.forEach(function(element) {
                var divContent = $(`<div class="controls"></div>`)
                var formInput = $('<input type="checkbox" name="extra[]" class="form-control input-lg" value="'+element.id+'">'+element.name+'</input>')
                 divContent.append(formInput);
                 divContainer.append(divContent)
                 divContainer.insertAfter(ele)

              }, this);
    }

    function addThemeColorInputElements(element){
      var element = element.parent().parent();

      var divContainer = $(`<div class="control-group themecolor">
                              <label class="control-label" for="inputCity">Please Select Theme and Color</label>
                             </div>
                          `);

      var themeQuestionSelect = $('<select name="theme"></select>');
      themeQuestionSelect.addClass('form-control input-lg');
      var options = ['Beach','Sand'];

      options.forEach(function(element) {
        var opt = $('<option value="'+element+'">'+element+'</option>');
        themeQuestionSelect.append(opt);
      }, this);

      var colorQuestionInput = $('<input name="color"></input>');
      colorQuestionInput.addClass('form-control input-lg');

      divContainer.append(themeQuestionSelect);
      divContainer.append(colorQuestionInput);

      divContainer.insertAfter(element);

  }

  function addExtraFormElement(e){

    
  }


   
})