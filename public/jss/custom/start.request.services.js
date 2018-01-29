var ServiceRenderer = (function(window){

    var ServiceRenderer = {
        properties:{
            accordionDiv:this.createAccordion()
        },
        createAccordion:function() {
            return $('div').attr('id','service.accordion').accordion({
                active:false,
                collapsible:true,
                heightStyle:'content'
            });
        },
        renderAdditionalService:function(selectedOptions) {
            this.additionalServiceRenderer(selectedOptions);
        },
        renderAdditionalSelections:function(additionalData) {

        },
        additionalServiceRenderer:function(selectedOptions) {
            var selectionArray = Array.from(selectOptions);
            var length = selectionArray.length;
            if(length === 0 )
                return;
            
            else if(length == 1) {
                return '';
            } else if(length > 1){
                selectionArray.forEach(function(categorySelected,index,copySelectionArray) {
                    /* return an accordion of the additional services 
                       and additional data for each of the category selected
                    **/
                    var divContainer = $('<div class="control-group divContainer" style="padding-left:10px;"></div>');
                    $('select2-selection').parents('select2').remove();
                    this.properties.accordionDiv.append(divContainer);
                })
            }
        }
    };

    return {
        renderAdditionalSelections:ServiceRenderer.renderAdditionalSelections,
        additionalServiceRenderer:ServiceRenderer.additionalServiceRenderer
    }

})(window)