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
        
        
        
        var reg = $('.email');
        var register = $('#register') || $('a[href="#finish"]');
        if(reg !== undefined) {
            console.log('hala')
            
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
        var v_available = false;
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

                next.addClass('btn btn-success pull-right');
                finish.addClass('btn btn-success pull-right');
                previous.addClass('btn btn-danger');


                //$('.modal-footer').append(actions);
                
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                if (currentIndex > newIndex)
                {
                    return true;
                }
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
                console.log($('#myWizard').serialize())
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
                })*/
            }//onFinished
        });



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


            var slider_ranger = $( "#slider-range" ), amount = $( "#amount" );

            if(slider_ranger !== undefined && amount !== undefined) {

                slider_ranger.slider({
                    range: true,
                    min: 0,
                    step:500,
                    max: 1000000,
                    values: [ 100000, 400000 ],
                    slide: function( event, ui ) {
                            var h_value = ui.values[1];

                            if(ui.values[1] === 1000000) {
                                h_value = ui.values[1]+"+";
                            } else h_value = ui.values[1];
                                amount.val(
                                    ui.values[ 0 ] + " - " + h_value
                                );
                    }
                });

                amount.val( "$" + slider_ranger.slider( "values", 0 ) +
                    " - $" + slider_ranger.slider( "values", 1 ) );
            }





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
                if (button.data('vicinity') !== '' && button.data('vicinity') !== undefined) vicinity_id = button.data('vicinity');
                else vicinity_id = 0;
                 $("#category").trigger("change");
                 //checkVendorAvailability($('#category').val(),state,vicinity_id);
                addStateLocality(state, vicinity_id);
            } else {
                 
                if ($('#category').val() == '') {
                    disableNextButton(true);
                }else if(($('#category').val() !== '' && v_available == true) || $('#category').val() !== ''){
                    $("#category").trigger("change");
                    disableNextButton(true);
                    checkVendorAvailability($('#category').val(),$('#state').val(),$('#vicinity').val())
                }
                addStateLocality();
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

            if (exists !== null) {
                //addExtraFormElement(exists, self)
            }
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

            var next_link = $('a[href="#next"]');
            next_link.attr('disabled',disable);
        }



        function checkVendorAvailability(cat_id, state = null, locality = null) {

            if (state == null || locality == null) {
                state = $('#start').data('state') || $('#state').val();
                locality = $('#start').data('vicinity') || $('#vicinity').val() || 0;
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


            var state = $('#state').val();
            var locality = $('#vicinity').val();
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

            if (state1 !== null && vicinity_id !== null) {

                console.log(vicinity_id + ' ' + state1);
                if (vicinity_id== 'all')
                    vicinity_id= 0;

                stateInput = $('<input type="hidden" name="state" value="' + state1 + '" ></input>');
                localityInput = $('<input type="hidden" name="vicinity" value="' + vicinity_id+ '"></input>');
                $('#myWizard').append(stateInput);
                $('#myWizard').append(localityInput);
            } else {

                state = $('#state').val()
                locality = $('#vicinity').val();

                if (state == undefined || state == '') {

                    $('#myModal').modal('hide');
                    alertify.alert('Please select a state and locality')

                } else {

                    if (locality == 'all')
                        locality = 0;
                    stateInput = $('<input type="hidden" name="state" value="' + state + '" ></input>');
                    localityInput = $('<input type="hidden" name="vicinity" value="' + locality + '"></input>');
                    $('#myWizard').append(stateInput);
                    $('#myWizard').append(localityInput);
                }
            }
        }


        function addAdditionalService(data, ele,category) {

            var divContainer = $('<div class="control-group divContainer" style="padding-left:10px;"></div>');

            if(data.additional !== undefined){

                var p = $('<p style="text-align:center;">Do you want this additional service(s)</p>');
                if(category == 'SmallChops'){
                    p.text('What do you want in the smallchops');
                }
                divContainer.html(p);
                var outerDiv = $('<div class="row">');
                 data.additional.forEach(function(element) {

                
                var divContent = $(`<div class="checkbox col-md-3 col-xs-6"></div>`);
                var outerLabel = $('<label>');
                var className = element.type === 'text' ? '':'';
                var formInput = $('<input type="'+element.type+'" name="'+element.formname+'"  value="' + element.value + '">')
                        // var formInput = $('<input type="checkbox" name="extra[]" class="" value="'+element.id+'">'+element.name+'</input>')
                    outerLabel.append(formInput)
                    outerLabel.append(element.name)
                    divContent.append(outerLabel)
                    outerDiv.append(divContent);
                    //divContent.append();
                    
                    

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
                            value: ''
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
                            class: 'form-control input-sm',
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