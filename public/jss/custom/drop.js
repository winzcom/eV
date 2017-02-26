var drop = (function(){

var drop = {

        handleFiles: function(files){

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

        },//end of handlefiles

        sendFiles: function(e){

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
                    request.
                    setRequestHeader('X-CSRF-TOKEN',document.getElementsByTagName('meta')['csrf-token'].getAttribute('content'))
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

                    this.addImageToView(data.paths);
                    this.removeChildFromPreview()
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

        },// end of sendFiles

        addImageToView:function(image_paths){
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
        },// addImageToView

        removeChildFromPreview:function(){
                var preview =   document.getElementById("preview");
                while(preview.hasChildNodes()){
                preview.removeChild(preview.lastChild);
            }
        }
}


return drop;

})();
