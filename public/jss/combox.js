
//
let state = document.getElementById('state');

if(state){
    toggleDisplayForVicinity(false,state.options[state.selectedIndex].value);
    changeVicinitySelect(state);
}

let count = 0;
let first,tab ; 

if(document.getElementsByClassName("tabsContent")[0])
    first = document.getElementsByClassName("tabsContent")[0].getAttribute('id');

if(document.getElementsByClassName("tablinks")[0])
    tab = document.getElementsByClassName("tablinks")[0];




let email_forms = document.getElementsByClassName('email_forms');
for(i =0; i<email_forms.length;i++){
    email_forms[i].style.display = "none";
}

/*if(document.getElementById("input_with_session_var"))
    openCity(tab,"Review");
else
    openCity(tab,first);
*/
//handleFiles(document.getElementById("fileElem").files);
    

function openCity(obj,cityName) {
    let i = 0;
    let x = document.getElementsByClassName("tabsContent");
    let tabbuttons = document.getElementsByClassName("tablinks");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
        tabbuttons[i].style.borderBottom = "none";
    }

    let d = document.getElementById(cityName);
    d.style.display = "block"; 
    obj.style.borderBottom = "solid black 5px";

    if(cityName == "Map" && count ==0){
        //initMap();
        //google.trigger.event(map,'resize');
    }
        

}

 function openMail(id){
     let form = document.getElementById(id);
     form.style.display = "block";
     form.setAttribute('class','w3-modal')
 }


function initMap() {
         map = new google.maps.Map(document.getElementById('Map'), {
          zoom: 16,
          center: {lat: -34.397, lng: 150.644}
        });

        var infowindow = new google.maps.InfoWindow();        
        var geocoder = new google.maps.Geocoder();
        
            google.maps.event.trigger(map, 'onload');
        

        geocodeAddress(geocoder,map,infowindow);
      }

    function geocodeAddress(geocoder, resultsMap,infowindow) {
        
        var address = document.getElementById('address').textContent;
        var company_name = document.getElementById('company_name').textContent;
        //var description = document.getElementById('Description').children[1].textContent
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });

                infowindow.setContent(company_name+" "+address);
                 marker.addListener('click', function(resultsMap) {
                    infowindow.open(resultsMap, marker);
                });

            } else {
                alert('Address of Company cannot be verified ' + status);
            }
        });
    }
    var fileArray;

    function handleFiles(files){

         
        if(files !== null && files.length !== 0 ){
                fileArray = [].slice.call(files);

            var gallery_info = document.getElementById("alert");
            var gallery_view = document.getElementById('gallery_view');

            var preview =  document.getElementById("preview")
            preview.innerHTML = "";
            preview.style.overflowY = "scroll";
            preview.style.maxHeight = "400px";

             var fileElem = document.getElementById("fileElem")
             
             var imageType = /^image\//;

             if(gallery_info)
                gallery_info.remove();

        for(var i=0; i<files.length; i++){
            var file = files[i];
           
            if(!imageType.test(file.type)){
                continue;
            }

            var coldiv = document.createElement("div");
            coldiv.setAttribute("class","col-sm-12");
           

            var img = document.createElement("img");
            img.setAttribute("class","img-thumbnail");
            img.file = file;
            
            var input = document.createElement("textarea");
            input.setAttribute('class','w3-margin-top form-control caption');
            input.setAttribute('placeholder','A lttle caption to describe the image e.g range of price 200-4000 ');
            input.setAttribute('name','caption[]');

             var size = file.size;
             var span = document.createElement('span');
             var s= size/1024;
             span.innerText =  s<1000 ? '['+s.toFixed(2) + ' KB]' : '['+(s/1024).toFixed(2)+' MB]'
            coldiv.appendChild(span)
            coldiv.appendChild(img);
            coldiv.appendChild(input);
            preview.appendChild(coldiv);

            (function(img,span,input,coldiv,index){
                img.addEventListener('click',function(){
                    coldiv.removeChild(span);
                    coldiv.removeChild(this);
                    coldiv.removeChild(input);
                    fileArray = fileArray.filter(function(file){
                        return file.name !== img.file.name;
                    });

                    if(fileArray.length == 0){
                        if(!gallery_view.hasChildNodes()){
                            var g = `<div class="alert alert-success" id="alert">No Galleries Available</div>`;
                            document.getElementById('start_div').insertAdjacentHTML('beforeend',g);
                        }
                            
                        preview.innerHTML = '<div class="alert alert-success">No Image Selected</div>';
                    }
                })//end of IIEF

            })(img,span,input,coldiv,i)

            var reader = new FileReader();
            reader.onload = (function(aImg){
                return function(e){
                    aImg.src = e.target.result;
                }
            })(img);
            reader.readAsDataURL(file);

        }

        }
      
    }//end of handleFiles

function sendFiles(e){

    event.preventDefault();
    if(fileArray.length !== 0){


        var submit_button = document.getElementById("form_upload_button");
        submit_button.value = 'uploading...'
        submit_button.disabled = true;
        var uri = "/eWeb/public/gallery_upload";

        var captions = document.getElementsByClassName('caption');

        var fd = new FormData();
        for(var i=0; i<fileArray.length; i++){
            fd.append('photo[]',fileArray[i],fileArray[i].name);
            fd.append('caption[]',captions[i].value);
            console.log(captions[i].value);
        }

        

        $.ajax({
            url:uri,
            contentType:false,
            beforeSend:function(request){
                request.setRequestHeader('X-CSRF-TOKEN',document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'))
            },
            type:"POST",
            dataType:'json',
            data:fd,
            processData:false,
            success:function(data){
                submit_button.value = 'upload'
                submit_button.disabled = false;
                console.log(data.paths[0][1]);
                fileArray.length = 0;
                document.getElementById("fileElem").value = '';
                addImageToView(data.paths);
                removeChildFromPreview()
            },
            error:function(err){
                console.log(err)

                handleError(err.responseText)
                submit_button.value = 'upload'
                submit_button.disabled = false;
            }
        })//end of Ajax Call
    }//end of If
    return false;   
}

function handleError(datatext){
    
}

function addImageToView(image_paths){

    var content = '';
    var image_container = document.getElementById('gallery_view');
    var array = [].slice.call(image_paths);

    for(var i=0;i<array.length;i++){

       
        content = `<div class="col-md-4">                                
                                    <div class="w3-card">                           
                                        <img src= "storage/images/`+array[i][0]+`" width="100%" height="190"/>
                                        <p class="w3-margin">`
                                            +array[i][1]+
                                        `</p>
                                        <div id="details" class="w3-container w3-teel w3-margin">
                                            <input type="checkbox" value="`+array[i][0]+`" class="w3-check" name="images[]"/>
                                        </div>
                                    </div>
                    </div>` ;
            image_container.insertAdjacentHTML('afterbegin',content);
    }
        
    
}

function removeChildFromPreview(){

    
    var preview =   document.getElementById("preview");
    while(preview.hasChildNodes()){
        preview.removeChild(preview.lastChild);
    }

}

function lonLngToDist(lat1,lng1,lat2,lng2,unit = 'M'){

    var radlat1 = Math.PI * lat1/180;
    var radlat2 = Math.PI * lat2/180;
    var radlng1 = Math.PI * lng1/180;
    var radlng2 = Math.PI * lng2/180;
    var theta = lng1-lng2;
    var radtheta = Math.PI * theta/180;

    var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);

    dist = Math.acos(dist);
    dist = dist * 180/Math.PI;
    dist = dist * 60 * 1.1515

    if(unit == "K")
        dist = dist*1.609344;
    if(unit == "N")
        dist = dist*0.8684;

    return dist;
}

function changeVicinitySelect(e){
    
    let vicinites = document.getElementsByClassName('vicinities');
    let len=vicinites.length;
    let toggle = true;

    for(i=0; i<len; i++){
            vicinites[i].style.display = "";
        }

    if(e.options[e.selectedIndex].value !== 'all'){
        toggleDisplayForVicinity(toggle,e.options[e.selectedIndex].value)

        for(i=0; i<len; i++){
            if(vicinites[i].dataset.stateId != e.options[e.selectedIndex].dataset.id){
                vicinites[i].style.display = "none";
            }
        }
        
    }
        
    else{

        toggle = false;
        toggleDisplayForVicinity(toggle,e.options[e.selectedIndex].value)
    }
        

}

function toggleDisplayForVicinity(display = false,state = 'all'){
   
    if(!display || state == 'all'){
        document.getElementById('vicinity').disabled = !display;
    }
    else document.getElementById('vicinity').disabled = !display;
}