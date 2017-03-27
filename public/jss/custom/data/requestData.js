var MargueeAditional = [
                            
                            {name:'Generator Hire',id:'Generator Hire',type:'checkbox',formname:'cateringadditions[]'},
                            {name:'Mobile Toilet',id:'Mobile Toilet',type:'checkbox',formname:'cateringadditions[]'},
                            {name:'Air Conditioning',id:'Air Conditioning',type:'checkbox',formname:'cateringadditions[]'}
    ]



var MargueeExtras = [
                            {name:'Tent Color',formname:'tentcolor',type:'text'},
                            {name:'Tent Liner',formname:'tentliner',type:'text'}
]

var CateringAdditionals = [
                            {name:'Catering Equipment',id:'Catering Equipment',type:'checkbox',formname:'cateringadditions[]'},
                            {name:'TableWare',id:'Catering Equipment',type:'checkbox',formname:'cateringadditions[]'},
                            {name:'Waiting Staffs',id:'Catering Equipment',type:'checkbox',formname:'cateringadditions[]'}
]

var publicPrivateEvents = [{name:'Public Event',type:'radio',formname:'eventtype',siblings:

                          [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                      },
                      {name:'Private Event',type:'radio',formname:'eventtype'}]

    var formElements = {
      'Caterers':{
                    'additional':CateringAdditionals
                },
      'Canapes':{
                     'additional':[{name:'Waiting Staffs',id:'Waiting Staffs'}]
                  },
      'Vegetarian and Vegan Catering':{
                     'additional':[{name:'Waiting Staffs',id:'Waiting Staffs'}]
                  },
      'TableWare':{
                     'additional':[{name:'Catering Equipment',id:'Catering Equipment'}]
                  },
      'Corporate Event Catering':{
                     'additional':[{name:'Waiting Staffs',id:'Waiting Staffs'}]
                  },
      'Buffet':{
                     'additional':CateringAdditionals
                  },
      'Bell Tents': {
                          'additional':MargueeAditional,
                          'extras':MargueeExtras
                      },
      'Party Tents':{
                        'additional':MargueeAditional,
                          'extras':MargueeExtras
                    },
        'Tipi Hire':{
                          'additional':MargueeAditional,
                          'extras':MargueeExtras
                   },
        'Transport':{

                        'extras':[

                                {
                                  name:'Pick-up Location',formname:'pickuplocation',type:'text'
                                },
                                {
                                  name:'Destination',formname:'destination', type:'text'
                                }
                        ]

                    },
    }



    var eventType = {
      'Concert': publicPrivateEvents,
      'Business Event':publicPrivateEvents,
    }