$(document).ready(function() {


        /*if (document.getElementById('user_state').length > 0) {
            var user_state = document.getElementById('user_state').dataset.userState;
            //alert(user_state);
        }*/

        
        function validateEmail(selector) {
            selector.mailgun_validator({
                api_key: 'pubkey-ca5312e0946a6a724c269a03cee39de7', // replace this with your Mailgun public API key
                in_progress: validation_in_progress,
                success: validation_success,
                error: validation_error,
            });
        }
        
       function mobileAndTabletcheck() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        
        var reg = $('.email');
        var register = $('#register') || $('a[href="#finish"]');
        if(reg !== undefined) {
            console.log(register)
            
            register.attr('disabled', true);

            validateEmail(reg);
        }

          function validation_in_progress() {
                $('#status').html("Validating email....");
                register.attr('disabled', true);
            }

            function validation_success(data) {
                $('#status').html(get_suggestion_str(data['is_valid'], data['did_you_mean']));
                if(data['is_valid']) {
                    register.attr('disabled', false);
                } 
            }

            function validation_error(error_message) {
                $('#status').html(error_message);
            }

            function get_suggestion_str(is_valid, alternate) {
                if (is_valid) {
                    var result = '<span class="success">Address is valid.</span>';
                    if (alternate) {
                        result += '<span class="warning"> (Though did you mean <em>' + alternate + '</em>?)</span>';
                    }
                    return result
                } else if (alternate) {
                    return '<span class="warning">Did you mean <em>' +  alternate + '</em>?</span>';
                } else {
                    return '<span class="error">Email address is invalid.</span>';
                }
            }

        var request_url = $('#myWizard').attr('action');
        var button;
        var v_available = false, noUISliderCreated = false;
        statee = null;

        $('#state').change(function() {

            v_available = true;
            
            statee = $(this).val();
        })

        var form = $("#myWizard");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onInit: function() {
                var next  = $('a[href="#next"]');
                var previous = $('a[href="#previous"]')
                var actions = $('.actions');
                var finish =  $('a[href="#finish"]'); 
                var delivery_option = $('#delivery_option');
                
                delivery_option.addClass('delivery_option');

                next.addClass('btn btn-success pull-right');
                finish.addClass('btn-sm btn-success pull-right');
                previous.addClass('btn-sm btn-danger');

                //$('.modal-footer').append(actions);
                
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                if (currentIndex > newIndex)
                {
                    return true;
                }
                register = $('a[href="#finish"]');
                if(register.attr('aria-hidden') == true) {
                     register.attr('disabled', true);
                } 

                /** newest change to accomodate having event type first */
                if(currentIndex == 0 )
                    if($('#category').val() == '')
                        disableNextButton(true);
                    else $('#category').trigger('change');
                /**end of event type change */
                console.log(currentIndex);
                   
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                //addStateLocality();
                /*alertify.delay(0).log("Request is been sent...").maxLogItems(1);

                //var formData = $('#myWizard').serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {});*/
                var formData = $('#myWizard').serialize();
                console.log(formData);
                var finish =  $('a[href="#finish"]'); 
                finish.html('sending request...');
                finish.addClass('disabled');

                $.ajax({
                    url: request_url,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#myWizard')[0].reset();
                        try {

                            var d = JSON.parse(data);
                            if (d.error) {
                                var html = "<p style='color:white'>Error: " + d.error + "</p>"
                                alertify.closeLogOnClick(true).error(html, function(ev) {
                                    
                                    $('#myModal').modal('show');
                                });
                            } else {
                               
                                var html = "<p style='color:white'>Success: " + d.message + "</p>"
                                alertify.closeLogOnClick(true).success(html);
                            }
                        } catch (e) {
                            
                            alertify.success('Request Sent');
                        }

                        finish.html('finish');
                        finish.removeClass('disabled');
                    },
                    error: function(err) {
                        console.log(err.error);
                        alertify.log(err.error);
                    }
                })
                
            }//onFinished
            
        });

        $('.venue').on('input',function() {
            if($(this).val().length > 10) {
                $('#delivery_option').removeClass('delivery_option');
            } else {
                $('#delivery_option').addClass('delivery_option');
            }
        })

        /*$('#myModal').modalSteps({
            btnCancelHtml: 'Cancel',
            btnPreviousHtml: 'Previous',
            btnNextHtml: 'Next',
            btnLastStepHtml: 'Complete',
            callbacks: {
                '*': function() {
                    console.log('haba')
                    return false;
                }
            },
            completeCallback: function() {*/
                /*** Ajax Call To Submit Form **/

                //console.log($('#myWizard').serialize())
                /*alertify.delay(0).log("Request is been sent...").maxLogItems(1);

                //var formData = $('#myWizard').serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {});
                var formData = $('#myWizard').serialize();
                console.log(formData);

                $.ajax({
                    url: request_url,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken,
                    },
                    success: function(data) {
                        console.log(data);
                        try {

                            var d = JSON.parse(data);
                            if (d.error) {
                                var html = "<p style='color:white'>Error: " + d.error + "</p>"
                                alertify.closeLogOnClick(true).error(html, function(ev) {
                                    $('#myModal').modal('show');
                                });
                            } else {
                                var html = "<p style='color:white'>Error: " + d.message + "</p>"
                                alertify.closeLogOnClick(true).sucess(html);
                            }
                        } catch (e) {
                            alertify.success('Request Sent');
                        }

                    },
                    error: function(err) {
                        console.log(err.error);
                        alertify.log(err.error);
                    }
                })
            }
        }); /***End of Modal Step */



        $('#myModal').on('shown.bs.modal', function(event) {

            var modal = $(this);
            button = $(event.relatedTarget);

            
            var slider_ranger = document.getElementById('slider-range'), amount = document.getElementById('amount');
            
            if(noUISliderCreated === false) {
                noUiSlider.create(slider_ranger, {
                    start: [ 250000, 450000],
                    connect: true,
                    step:500,
                    range: {
                        'min': 1000,
                        'max': 700000
                    }
                });
                noUISliderCreated = true;
            }
            

            slider_ranger.noUiSlider.on('update', function( values, handle ) {
                var value = values[handle];
                var low = (+values[0]).toFixed(0), high = (+values[1]).toFixed(0);
                if(high == 700000) {
                    high = high+'+';
                }else high = high;
                amount.value = low+'-'+high;
        });
            
            try{
            $( "#datepicker" ).datepicker({
                minDate:new Date(new Date().setDate(new Date().getDate()+1))
            });
            }catch(err){

            }

            validateEmail($('#request_email'));

            if (button.data('state') !== undefined && button.data('state') !== '') {
            	
                var state = button.data('state');
                var vicinity_id = null;
                vicinity_id = button.data('vicinity');
                vicinity_id = vicinity_id == 'all' ? 0 : vicinity_id;

                $("#category").trigger("change");
                //checkVendorAvailability($('#category').val(),state,vicinity_id);
                addStateLocality(state, vicinity_id);
            } else {
                 
                if ($('#category').val().length == '') {
                    
                }else {
                    //$("#category").trigger("change");
                    //disableNextButton(true);
                    //checkVendorAvailability($('#category').val(),$('#state').val(),$('#vicinity').val())
                }
            }
            //var cate = $('#category');
            //var c = $('#category option:selected').text().replace('- ','');


            $('#venue').show();
            toggleBudgetFields(false);
        })

        /***Start of Category event Operation */
        $('#category').on('change', function() {

            //disableNextButton();
            $('.themecolor').remove()
            categoryChange($(this));
        }) /***End of Category event Operation */


        /*** Start of event Change operation */

        $('#event').change(function() {
            var self = $(this);

            //$('.themecolor').remove();
            $('.pP').remove();

            var event = $('#event option:selected').text();

            var exists = eventType[event] || null;

            //var category = $('#category option:selected').text().replace(/\s+/g, '');

            
            //exists !== null ? addExtraFormElement(exists, self) : null;

        }) /***End of event Change Event operation */

        $('#browsevendor').change(function() {
            var cat = $(this).val();
            if (!isNaN(cat))
                window.location.href = myUrl + 'browse_vendors/' + cat;
        })


        $('#start_request').submit(function() {

            //display the form wizard;
            
            return false;

        }); /***End of Jquery events changeOperation */

        /***Start of vanilla functions */

        function disableNextButton(disable = false) {
            /*d_orientations = $('.js-btn-step');
            d_orientations.each(function(i, v) {
                if (v.dataset.orientation == 'next')
                    v.disabled = disable;
            })*/

            var next_link = $('a[href="#next"]') || $('a[href="#finish"]');
            next_link.attr('disabled',disable);
        }



        function checkVendorAvailability(cat_id, state = null, locality = null) {

            if (state == null || locality == null) {
                state = $('#start').data('state') || $('#state').val();
                locality = $('#start').data('vicinity') || $('#vicinity').val() || 0;
                cat_id = $('#category').val();
                if (locality == 'all')
                	locality = 0;
            }
            var vendor_available_span = $('.vendor_available');
            var data = { 'state': state, 'locality': locality, 'category': cat_id };
            console.log(data);
            vendor_available_span.css('color', 'blue');
            vendor_available_span.text('Checking vendors available...')
                //alertify.log("Checking if vendors are available").maxLogItems(1);

            $.ajax({
                url: myUrl + 'check_vendor_availabity',
                type: 'GET',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if (data.available == 0) {
                        console.log(data.available)
                        v_available = false;
                        vendor_available_span.css('color', 'red')
                        vendor_available_span.text('no vendors available')
                        disableNextButton(true);
                    } else {

                        vendor_available_span.css('color', 'green')
                        vendor_available_span.text(data.available + ' vendor(s) available')
                        disableNextButton();
                    }
                }
            })
        }

        function categoryChange(self) {

            if ($('.divContainer')) {
                $('.divContainer').remove();
            }

            var category = $('#category option:selected').text();
            category = category.replace(/\s+/g, '');


            var state = $('#state').val() || $('.state').data('state');
            var locality = $('#vicinity').val() || $('.state').data('vicinity');
            checkVendorAvailability(self.val(), state, locality)



            console.log(category)

            var data = formElements[category];
            
            console.log(data);
            if (data) {
            	if(data.placeholder !== undefined){
            		$('#personalmessage').attr('placeholder',data.placeholder);
            	}
                addAdditionalService(data, self,category);
            } else if ($.inArray(category, eventPlanning) != -1) {
                //addThemeColorInputElements($('#div_event'));
            } else if (category == 'Transport') {
                addTransportInputs();
                $('#venue').hide();
            }



        }

        function addStateLocality(state1 = null, vicinity_id = null) {

            var state, locality, stateInput, localityInput, inputs;

            // $('#dynamic_state').remove();
            // $('#dynamic_vicinity').remove();

            if (state1 !== null && vicinity_id !== null) {

                console.log(vicinity_id + ' ' + state1);
                if (vicinity_id == 'all')
                    vicinity_id = 0;

                stateInput = $('<input type="hidden" id="dynamic_state" name="state" value="' + state1 + '" ></input>');
                localityInput = $('<input type="hidden" id="dynamic_vicinity" name="vicinity" value="' + vicinity_id+ '"></input>');
                $('#myWizard').append(stateInput);
                $('#myWizard').append(localityInput);
            } else {

                    state = $('#state').val();
                    locality = $('#vicinity').val();

                    locality = locality == 'all' ? 0 : locality;

                    stateInput = $('<input type="hidden" name="state" value="' + state + '" ></input>');
                    localityInput = $('<input type="hidden" name="vicinity" value="' + locality + '"></input>');
                    $('#myWizard').append(stateInput);
                    $('#myWizard').append(localityInput);
                }
        }


        function addAdditionalService(data, ele,category) {

            var divContainer = $('<div class="control-group divContainer" style="padding-left:10px;"></div>');

            if(data.additional !== undefined){

                var p = $('<p style="text-align:center;">Do you want this additional service(s)</p>');
                if(category == 'SmallChops'){
                    p.text('What do you want in the smallchops');
                }else if(category === 'Cake') {
                    p.text('Please select flavours you want')
                }
                divContainer.html(p);
                var outerDiv = $('<div class="row">');
                 data.additional.forEach(function(element) {

                
                var divContent = $(`<div class="checkbox col-md-3 col-xs-6"></div>`);
                var outerLabel = $('<label>');
               // var className = element.type === 'text' ? '':'';
                var formInput = $('<input type="'+element.type+'" id="'+element.id+'"name="'+element.formname+'"  value="' + element.value + '">')
                        // var formInput = $('<input type="checkbox" name="extra[]" class="" value="'+element.id+'">'+element.name+'</input>')
                    outerLabel.append(formInput)
                    outerLabel.append(element.name)
                    divContent.append(outerLabel)
                    outerDiv.append(divContent);
                    //divContent.append();
                    console.log(formInput); 
                    
                     if(element.clickAction !== undefined) {
                            
                            var div = $('<div class="controls"></div>');
                            var no_of_guest = $('.no_of_guest').parent();
                        (function(formInput){
                            formInput.on('click', function(event) {
                                var label = $('<label>Please specify  '+element.name+' needed e.g coke 20 bottles, orijin 30 cartons </label> ')
                                var obj = element.clickAction;
                                $('#'+obj.id).prev().remove()
                                $('#'+obj.id).remove();
                                var input = $('<input/>');
                                input.attr({
                                    type:'text',
                                    class:'form-control',
                                    name:obj.formname,
                                    id:obj.id
                                })
                                
                                if(event.target.checked){
                                    div.append(label);
                                    div.append(input);
                                }
                                else {
                                    $('#'+obj.id).prev().remove();
                                    $('#'+obj.id).remove();
                                    
                                }
                            });
                        })(formInput);

                        div.insertAfter(no_of_guest);
                        
                    }
                    

                }, this);
                divContainer.append(outerDiv);
            }
            

            
            
            if (data.extras != null) {
                var oDiv = $('<div class="row">');
                 var innerDiv = null;
                var input = null;
                data.extras.forEach(function(ele) {
                    innerDiv = $('<div class="col-xs-6 col-md-4">')
                    if(ele.type === 'text'){
                         input = $('<input>');
                         input.attr({
                            name: ele.formname,
                            class: 'form-control input-sm',
                            value: '',
                            placeholder:ele.placeholder || ''
                         }, this);
                         var label = $('<label>')
                         label.text(ele.name);
                         innerDiv.append(label)
                         innerDiv.append(input);
                         oDiv.append(innerDiv);
                    } else if(ele.type === 'select' && ele.children.length > 0){
                        input = $('<select class="form-control input-sm" name="'+ele.formname+'">');
                        ele.children.forEach(function(e){
                            var option = $('<option>');
                            option.attr({
                                value:e.value
                            })
                            option.text(e.name);
                            input.append(option);
                        })
                        var label = $('<label>')
                        label.text(ele.name);
                        innerDiv.append(label);

                        innerDiv.append(input);
                        oDiv.append(innerDiv);
                    }else{
                        input = $('<input>');
                         input.attr({
                            name: ele.formname,
                            class: '',
                            value: ele.value,
                            type:ele.type
                         }, this);
                         var label = $('<label>')
                         label.text(ele.name);
                         innerDiv.append(label)
                         innerDiv.append(input);
                         oDiv.append(innerDiv);
                    }
                    
                })
                divContainer.append(oDiv);
            }
            if(data.placeholder !== ''){
                var pmtextarea = $('#personalmessage');
                pmtextarea.attr('placeholder',data.placeholder);
            }
            divContainer.insertAfter(ele)
        }

        function addThemeColorInputElements(element) {
            var e = element;

            var divContainer = $(`<div class="control-group themecolor">
                              <label class="control-label" for="inputCity">Please Select Theme and Color</label></br>
                             </div>
                          `);

            var themeQuestionSelect = $('<select name="theme"></select></br>');
            themeQuestionSelect.addClass('form-control input-lg');
            var themeLabel = $('<label class="control-label">Theme</label></br>');


            divContainer.append(themeLabel)
            var options = ['Beach', 'Sand'];

            options.forEach(function(element) {
                var opt = $('<option value="' + element + '">' + element + '</option>');
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

        function addExtraFormElement(e, element) {
            var divC = $('<div>');
            divC.addClass('control-group pP');

            var label = $('<label>');
            var br = $('<br>');
            label.text('Is it a Public or Private Event');




            divC.append(label);
            br.insertAfter(label);

            e.forEach(function(element) {

                var pue = $('<input>')

                pue.attr({
                    name: element.formname,
                    type: element.type,
                    value: element.name,
                    class: 'form-control'
                });

                pue.on('click', function() {

                    if (element.hasOwnProperty('siblings')) {

                        public = true;
                        toggleBudgetFields(public);

                        element.siblings.forEach(function(e) {

                            var sibling = $('<input>');
                            var label = $('<label>');

                            label.attr('class', 'os');
                            label.text(e.name);

                            sibling.attr({
                                name: e.formname,
                                class: 'form-control os',
                            })

                            if (e.name != 'Website')
                                sibling.attr('required', true);

                            divC.append(label);
                            sibling.insertAfter(label);
                        }, this)
                    } else {
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

        function toggleBudgetFields(public) {
            if (public) {
                $('#normalbudget').hide();
                $('#publicbudget').show();
            } else {
                $('#publicbudget').hide();
                $('#normalbudget').show();
            }
        }

        function addTransportInputs() {}



    }) //doument.ready