$(document).ready(function() {

        $('#novtst').hide();
        /*if (document.getElementById('user_state').length > 0) {
            var user_state = document.getElementById('user_state').dataset.userState;
            //alert(user_state);
        }*/

        /**Code to comment out */
        // var observer = new MutationObserver(function(mutations) {
        //     mutations.forEach(function(mutation) {
        //     //addedNodes contains all detected new controls
        //         if (mutation && mutation.addedNodes) {
        //             mutation.addedNodes.forEach(function(elm) {
        //             //only apply select2 to select elements
        //                 if (elm && elm.nodeName === "SELECT" && ($(elm).attr('id') == 'menu')) {
        //                     console.log(elm)
        //                     var label = $('<label>')
        //                     label.html('Select Menus');
        //                     label.insertBefore(elm);
        //                     $(elm).select2();
        //                 }
        //             });
        //         }
        //     });
        // });

        // observer.observe(
        //     document.querySelector('#myWizard'),
        //     {
        //         characterData:true,
        //         subtree:true
        //     }
        // )
        /** end of mutationobserver */

        //Check if we are on the origin page
        //Then add select plugin to the category select element
        if( window.location.pathname === '/') 
            //add select plugin to select element.
            //$('#category').prop('multiple','multiple');
            // $('#category').prop('class','').select2({
            //     multiple:true,
            //     //dropdownParent: $('#myModal'),
            //     //allowClear:true,
            //     maximumSelectionLength:5
            // });

        function numberFormat(n) {
        //    return Number.prototype.toFixed(n,2).replace(/./g,function(c,i,a){
        //         return i && c!=="." && ((a.length - i) % 3 === 0) ? ',' + c : c;
        //     });
            return Number.prototype.toLocaleString.call(+n);
        }

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
        var doubleEmailVerification = function() {
            var cloned = reg.clone();
            cloned.attr({
                'name':'verify_email',
                'required':true,
            }).insertAfter(reg).blur(function(){
                $(this).val() === reg.value ? register.attr('disabled',false) : register.attr('disabled',true);
            }).bind('paste',function(e){
                e.preventDefault();
            }).before($(`<label>Verify Email</label>`));
        }

        // if(reg !== undefined) { 
        //     register.attr('disabled', true);
        //     validateEmail(reg);
        // }
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
            errorPlacement: function errorPlacement(error, element) { element.before(error); console.log(error) },
            // rules: {
            //     confirm: {
            //         equalTo: "#password"
            //     }
            // }
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
                finish.addClass('btn btn-success pull-right');
                previous.addClass('btn-sm btn-danger');

                //$('.modal-footer').append(actions);
                
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                
                if (currentIndex > newIndex)
                {
                    disableNextButton(false);
                }
                else if(currentIndex == 1 && $('#category').val() == ''){
                    disableNextButton(true);
                }
                    
                /**end of event type change */
                   
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            // onFinishing: function (event, currentIndex)
            // {
            //     console.log('finishing')
            //     form.validate().settings.ignore = ":disabled";
            //     return form.valid();
            // },
            onFinished: function (event, currentIndex)
            {
                //addStateLocality(null,null);
                /*alertify.delay(0).log("Request is been sent...").maxLogItems(1);
                
                //var formData = $('#myWizard').serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {});*/
                var formData = $('#myWizard').serialize();
                var finish =  $('a[href="#finish"]'); 
                var fm = new FormData(document.forms['myWizard']);
                if( form.valid() ) {
                    finish.html('sending request...');
                    finish.addClass('disabled');
                        $.ajax({
                        url: request_url,
                        type: 'POST',
                        processData:false,
                        contentType:false,
                        data: fm,
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': Laravel.csrfToken,
                        },
                        statusCode:{
                            500: function() {
                                var html = "<p style='color:red;'>Message: Request could not be sent an error occured</p>"
                                $('.message').html(html);
                                //alertify.log('An error occurred request can not be sent at the moment');
                                finish.html('finish');
                                finish.removeClass('disabled');
                            },
                            401:function() {
                                alert('session has expired, please login again');
                                finish.html('finish');
                                finish.removeClass('disabled');
                            }
                        },
                        success: function(data) {
                            console.log(data);
                            
                            //try {

                                var d = Object.assign({},data);
                                if (d.status == 'failed') {
                                    var html = "<p>Error: " + 'An Error occured' + "</p>"
                                    // alertify.closeLogOnClick(true).error(html, function(ev) {
                                    //     $('.message').html(html);
                                    //     $('#myModal').modal('show');
                                    // });
                                        $('.message').html(html);
                                        $('a[href="#finish"]').attr('disabled',false).text('Send Request');
                                        return;
                                    //   $('#myModal').modal('show');  
                                } else {
                                    
                                    var html = "<p style='color:green;'>Success: " + d.message + "</p>"
                                    alertify.closeLogOnClick(true).success(html);
                                    $('#myWizard')[0].reset();
                                    $('.message').html(html);
                                }
                            // //} catch (e) {
                            //      var html = "<p style='color:green;'>Message: Request Sent</p>"
                            //     $('.message').html(html);
                            //     $('#myWizard')[0].reset();
                            //     alertify.success('Request Sent');
                            // }

                            setTimeout(function() {
                                $('.message').html('');
                                $('.vendor_available').html('');
                            }, 3000);

                            finish.html('finish');
                            finish.removeClass('disabled');
                        },
                        error: function(err) {
                            console.log(err.error);
                            var html = "<p style='color:red;'>Error sending this request</p>"+err
                            $('.message').html(html);
                            alertify.log('An Error occurred request can not be sent at the moment');
                            finish.html('finish');
                            finish.removeClass('disabled');
                        }
                    })
                }
                
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

            try{
            $( "#datepicker" ).datepicker({
                minDate:new Date(new Date().setDate(new Date().getDate()+1))
            });
            }catch(err){

            }

            //validateEmail($('#request_email'));

            if (button.data('state') !== undefined && button.data('state') !== '') {
            	
                var state = button.data('state');
                var vicinity_id = null;
                vicinity_id = button.data('vicinity');
                vicinity_id = vicinity_id == 'all' ? 0 : vicinity_id;

                $("#category").trigger("change");
                //checkVendorAvailability($('#category').val(),state,vicinity_id);
                addStateLocality(state, vicinity_id);
            } else {
                 addStateLocality(null,null);
                if ($('#category').val() !== '') {
                     $("#category").trigger("change");
                }else {
                    
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

            //disableNextButton(false);
            $('.themecolor').remove()
            categoryChange($(this));
        }) /***End of Category event Operation */


        /*** Start of event Change operation */
        $("#other_event").hide();
        $("#other_event").val(''); 

        $('#event').change(function() {
            var self = $(this);
            //$('.themecolor').remove();
            $('.pP').remove();

            var event = $('#event option:selected').text();
            var exists = eventType[event] || null;

            if(event == "Other") {
                $("#other_event").show();
                $("#other_event_input").attr('required',true);
            } else {
                $("#other_event").hide();
                $('#other_event_input').val('');
                $("#other_event_input").attr('required',false);  
            }

            //var category = $('#category option:selected').text().replace(/\s+/g, '');

            
            //exists !== null ? addExtraFormElement(exists, self) : null;

        }) /***End of event Change Event operation */

        /** comment out to use vue js  */
        var states = '';
        $('#browsevendor').change(function(e) {
            var cat = $(this).val(); var state = $('#state').val();
            if (!isNaN(cat))
                window.location.href = myUrl + 'browse_vendors/' + cat+'/'+state;
        });

        $('.states').change(function(e) {
            states = $(this).val();
        })

        $('#search_button').click(function(e){
           
            if($('#browsevendor').val() != '' && $('#state').val() != '') {
                var cat = $('#browsevendor').val(); var state = $('#state').val();
                if (!isNaN(cat))
                    window.location.href = myUrl + 'browse_vendors/' + cat+'/'+states;
            }
           
        })


        $('#start_request').submit(function(e) {

            //display the form wizard;
            e.preventDefault();
            return false;

        }); /***End of Jquery events changeOperation */

        /***Start of vanilla functions */

        function disableNextButton(disable) {
            /*d_orientations = $('.js-btn-step');
            d_orientations.each(function(i, v) {
                if (v.dataset.orientation == 'next')
                    v.disabled = disable;
            })*/

            var next_link = $('a[href="#next"]') || $('a[href="#finish"]');
            next_link.attr('disabled',disable);
        }



        function checkVendorAvailability(cat_id, state, locality) {

            if (state == null || locality == null) {
                state = $('#start').data('state') || $('#state').val();
                locality = $('#start').data('vicinity') || $('#vicinity').val() || 0;
                //cat_id = $('#category').val();
                if (locality == 'all')
                	locality = 0;
            }
            var vendor_available_span = $('.vendor_available');
            var data = { 'state': state, 'locality': locality, 'category': cat_id };
            // var novtst = $('#novtst');
            // var nots = $('#number_of_vendor_to_send_to');
            console.log(data);
            vendor_available_span.css('color', 'blue').text('Checking vendors available...')
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
                        vendor_available_span.text('no vendors available');
                        // nots.val('');
                        // novtst.hide();
                        disableNextButton(true);
                    } else {

                        vendor_available_span.css('color', 'green')
                        vendor_available_span.text(data.available + ' vendor(s) available');
                        // nots.val(data.available);
                        // nots.attr('max',data.available);
                        // novtst.show();
                        disableNextButton(false);
                    }
                }
            })
        }

        function categoryChange(self) {

            // if ($('.divContainer')) {
            //     $('.divContainer').remove();
            // }

             if(document.querySelector('.ui-accordion') != undefined)
                var accordions = $('.ui-accordion');

            var category = $('#category option:selected');
            var length = $('#category option:selected').length;
                if($('.menu')) 
                $('.menu').remove();
            //if($('#service.accordion') === undefined)
            swapBudgetField(category,length);
            if(length == 1) {
                accordions !== undefined ? accordions.each(function(index,acc) {
                    if($(acc).attr('id') !== category.val()+'_')
                        $(acc).remove();
                }) : null;
                displayService(category,getAccordionDiv());
            }
            else if(length > 1) {
                var accordion_ids = [].slice.call(accordions).map(function(accordion) {
                    return parseInt($(accordion).attr('id'));
                });
                var category_val = [].slice.call(category).map(function(cat) {
                    return parseInt($(cat).val());
                });
                var diff = _.difference(accordion_ids,category_val)
                 _.forEach(diff,function(id) {
                     $('#'+id+'_').remove();
                 });
                category.each(function(index,cat) {
                    displayService(cat,getAccordionDiv());
                })
            }
            //displayService start
            function displayService(cat,accordion) {
                var category = $(cat).text().replace(/\s+/g, '');
                var prefix = $(cat).val()+'_';
                accordion.attr('id',prefix);
                if(document.getElementById(accordion.attr('id')) == undefined) {
                    accordion.insertAfter(self);
                }
                // if(category === 'Caterers') {
                //     $('#single_budget').hide();
                //     $('.caterer_budget').show();
                // } else {
                //     $('#single_budget').show();
                //     $('.caterer_budget').hide();
                // }
                var state = $('#state').val() || $('.state').data('state');
                var locality = $('#vicinity').val() || $('.state').data('vicinity');
                _.defer(checkVendorAvailability.bind(null,$(cat).val(),state,locality));   

                var data = formElements[category] || null;
                
                if (data) {
                    if(typeof data.placeholder !== undefined){
                        $('#personalmessage').attr('placeholder',data.placeholder);
                    }
                    addAdditionalService(data, self,category,prefix,accordion);
                } else if ($.inArray(category, eventPlanning) != -1) {
                    //addThemeColorInputElements($('#div_event'));
                } else if (category == 'Transport') {
                    addTransportInputs();
                    $('#venue').hide();
                }
            }// end of function displayService
        }

        function addStateLocality(state1, vicinity_id) {

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


        function addAdditionalService(data, ele,category,prefix = '',accordion = null) {
            var divContainer = $('<div class="control-group divContainer" style="padding-left:10px;"></div>');
            // var menu = $('.menu')
            // menu.remove();
            $('select2-selection').parents('select2').remove();

            if(data.hasOwnProperty('additional')){

                var p = $('<p style="text-align:center;">Do you want this additional service(s)</p>');
                if(data.hasOwnProperty('placeholder')){
                    p.text(data.placeholder);
                }
                divContainer.html(p);
                var outerDiv = $('<div class="row">');
                 data.additional.forEach(function(element) {

                
                var divContent = $(`<div class="checkbox col-md-3 col-xs-6"></div>`);
                var outerLabel = $('<label>');
               // var className = element.type === 'text' ? '':'';
                var formInput = $('<input type="'+element.type+'" id="'+element.id+'"name="'+prefix+element.formname+'"  value="' + element.value + '">')
                        // var formInput = $('<input type="checkbox" name="extra[]" class="" value="'+element.id+'">'+element.name+'</input>')
                    outerLabel.append(formInput)
                    outerLabel.append(element.name)
                    divContent.append(outerLabel)
                    outerDiv.append(divContent);
                    //divContent.append();
                    console.log(formInput); 
                    
                     if(element.hasOwnProperty('clickAction')) {
                            
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
                                    name:prefix+obj.formname,
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
            

            
            
            if (data.hasOwnProperty('extra')) {
                var oDiv = $('<div class="row">');
                 var innerDiv = null;
                var input = null;
                data.extra.forEach(function(ele) {
                    innerDiv = $('<div class="col-sm-4 col-md-3 col-lg-4">')
                    
                    /** Code likely to comment out */
                    if(ele.hasOwnProperty('attach')) {
                        if(ele.hasOwnProperty('children')) {
                            innerDiv = $('<div class="menu">')
                            input = $(`<select class="form-control" id = "menu" multiple name="${prefix+ele.formname}'">`);
                            ele.children.forEach(function(e){
                                var option = $('<option>');
                                option.attr({
                                    value:e.value
                                })
                                option.text(e.name);
                                input.append(option);
                            });
                        }
                        else {
                            innerDiv = $('<div class="menu">')
                            input = $('<input class="form-control" name="'+prefix+ele.formname+'">');
                        }
                        var label = $('<label>')
                        label.html(ele.name+` (${category})`);
                        var eventElement = document.querySelector('#date');
                        innerDiv.append(input);
                        innerDiv.insertBefore(eventElement);
                        ele.type == 'select' ? input.select2() : null;
                        label.insertBefore(input);
                        return;
                    }/** end of code to comment out */
                    else if(ele.type === 'text'){
                         input = $('<input>');
                         input.attr({
                            name: prefix+ele.formname,
                            class: 'form-control',
                            value: '',
                            placeholder:ele.placeholder || ''
                         }, this);
                         var label = $('<label>')
                         label.text(ele.name);
                         innerDiv.append(label)
                         innerDiv.append(input);
                         oDiv.append(innerDiv);
                    } else if(ele.type === 'select' && ele.children.length > 0){
                        input = $('<select class="form-control input-sm" name="'+prefix+ele.formname+'">');
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
                            name: prefix+ele.formname,
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
            //divContainer.insertAfter(ele);
            accordion.append(divContainer);
            divContainer.before($(`<h4 class="${category}">Additional Service for ${category}</h4>`));
            accordion.accordion( "refresh" );
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

        function getAccordionDiv() {
            return $('<div class="accordion"></div>').accordion({
                active:false,
                collapsible:true,
                header:'h4',
                heightStyle:'content'
            });
        }

        $( "#search" ).autocomplete({
            source: window.location.origin+'/type_search',
            minLength:2,
            autoFocus:true,
            select: function( event, ui ) {
              var url = window.location.origin+'/detail/'+ui.item.slug+'/'+ui.item.cat_id;
              url = encodeURI(url);
              window.location.href = url;
            }
        });

        function swapBudgetField(category,length) {
            var cateringOPtions = ['Caterers','BusinessLunchCatering','Canapes'];
            if(length > 1){
                // var categories = [].map.call(category,function(value,index){
                //     return $(value).text().replace(/\s+/g, '');
                // });
                // var catName;
                // var catererIndex = _.findIndex(categories,function(val){
                //    return cateringOPtions.forEach(function(option,index){
                //         if(val === option)
                //             return true;
                //    })
                // });
                var intersection = _.intersectionWith(category,cateringOPtions,function(a,b){
                    return $(a).text().replace(/\s/g,'') === b;
                });
                if(intersection.length > 0) {
                    $('.single_budget').remove();
                    $('.caterer_budget').remove();
                    intersection.forEach(function(value){
                        _addCatererOrNormalBudget('caterer',value);
                    })
                    // if(document.querySelectorAll('.caterer_budget').length == 0)
                    //     _addCatererOrNormalBudget('caterer',$(intersection.slice(0,1)[0]).val());
                } else {
                    $('.caterer_budget').remove();
                    if(document.querySelectorAll('.single_budget').length == 0)
                        _addCatererOrNormalBudget('');
                }
            } else {
                var index = cateringOPtions.indexOf($(category).text().replace(/\s+/g, ''));
                if(index > -1) {
                    $('.single_budget').remove();
                    if(document.querySelectorAll('.caterer_budget').length == 0)
                        _addCatererOrNormalBudget('caterer',category);
                } else {
                    $('.caterer_budget').remove();
                    if(document.querySelectorAll('.single_budget').length == 0)
                        _addCatererOrNormalBudget('');
                }
            }
        }

        function _addCatererOrNormalBudget(type,value=null) {
            var callback = function() {
                if($(this).find('input').val().length >= 4) {
                    var number = $(this).find('input').val().split(',');
                    number = [].join.call(number,'');
                    $(this).find('input').val(numberFormat(number));
                }
            }
            if(type == 'caterer')
                 $(`<div class="caterer_budget">
                    <label for="">Budget Per Head(e.g &#8358 100 per guest) for ${$(value).text()}</label>
                    <input type="text" class="form-control price_budget" name ="${$(value).val()}_budget_per_head" id="max_amount">
                </div>`
                ).appendTo($('#normalbudget')).on('input',callback);
            else {
                $(`<div id="single_budget" class="single_budget">
                        <label for="budget">Your Budget (&#8358)</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                            &#8358
                            </span>
                            <input type="text" class="form-control" name ="budget" >
                        </div>
                    </div>`
                ).appendTo($('#normalbudget')).on('input',callback);
            }
        }    
        $('#start_time').timepicker();

    }) //doument.ready