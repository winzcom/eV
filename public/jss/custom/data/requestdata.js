    var MargueeAditional = [
                            
                            {name:'Generator Hire',value:'Generator Hire',type:'checkbox',formname:'extra[]',label:'Do you need this additional service'},
                            {name:'Mobile Toilet',value:'Mobile Toilet',type:'checkbox',formname:'extra[]'},
                            //{name:'Air Conditioning',value:'Air Conditioning',type:'checkbox',formname:'extra[]'},
                            {name:'Tables and Chairs',value:'Tables and Chairs',type:'checkbox',formname:'extra[]'}
    ]



var MargueeExtras = [
                            
                            {name:'Style of Party',formname:'party_style',type:'select',children:[
                              {name:'Banquet Party(e.g seat with round table)',value:'Banquet Party'},
                              {name:'Theatrical party(e.g seat with no table)', value:'Theatrical party'}
                            ]},
                            {name:'Tent Flooring',formname:'tentflooring',type:'select',children:[
                              {name:'No ',value:'No ground flooring'},
                              {name:'Yes',value:'Yes want flooring'},
                            ]},
                            {
                              name:'Do you need tent liner or pole cover',formname:'tent_liner_or_pole_cover',type:'select',children:[
                                {name:'Tent liner',value:'Tent Liner'},
                                {name:'Pole Cover',value:'Pole Cover'},
                                {name:'Tent Liner and Pole Cover',value:'Tent Liner and Pole Cover'},
                                {name:'Undecided',value:'Undecided'},
                                {name:'None',value:'None'}
                              ]
                            }
]

var CateringAdditionals = [
                            
                            //{name:'Catering Equipment',value:'Catering Equipment',type:'checkbox',formname:'extra[]',label:'Do you need this additional service'},
                            {name:'TableWare',value:'Catering Equipment',type:'checkbox',formname:'extra[]'},
                            {name:'Waiting Staffs',value:'Catering Equipment',type:'checkbox',formname:'extra[]'},
                            {name:'Bar Service',value:'Bar Service',type:'checkbox',formname:'extra[]'},
                            //{name:'Rental/Setup',value:'Rental/Setup',type:'checkbox',formname:'extra[]'},
                            //{name:'Chair Covers',value:'Chair Covers',type:'checkbox',formname:'extra[]'}
                            
]

var SmallChopsAdditional = [
                             {name:'Spring Rolls',value:'Sprinkle',type:'checkbox',formname:'extra[]',label:'What do you want in your small chops'},
                             {name:'Samosa',value:'Samosa',type:'checkbox',formname:'extra[]'},
                             {name:'Gizzard',value:'Gizzard',type:'checkbox',formname:'extra[]'},
                             {name:'Fish',value:'Fish',type:'checkbox',formname:'extra[]'},
                             {name:'Chicken',value:'Chicken',type:'checkbox',formname:'extra[]'},
                             {name:'Meat',value:'Mosa',type:'checkbox',formname:'extra[]'},
                             {name:'Puff Puff',value:'Puff Puff',type:'checkbox',formname:'extra[]'},
                             {name:'Beer Battered Fish',value:'Beer Battered Fish',type:'checkbox',formname:'extra[]'}
                            // {name:'tell us more',type:'text',formname:'iwantthisincludedalsointhesmallchops',value:''}
]

var eventPlannerAdditional = [
                            {name:'MC',value:'MC',type:'checkbox',formname:'extra[]',label:'Do you need this additional service'},
                            {name:'Catering',value:'Catering',type:'checkbox',formname:'extra[]'},
                            {name:'Photography',value:'Photography',type:'checkbox',formname:'extra[]'},
                            {name:'Video Coverage',value:'Video Coverage',type:'checkbox',formname:'extra[]'},
                            {name:'Music/Bands',value:'Music/Bands',type:'checkbox',formname:'extra[]'},
                            {name:'Outfits',value:'Outfits',type:'checkbox',formname:'extra[]'}
]

var placeholder = `please tell us about the type of meal, dietery requirement we need to know about if any, 
                   do you want the food cooked before the event and stored in a warm container or cooked on site
                   tell us about water access any catering equipment you want
                                 `



var CateringExtras = [
                        //{name:'Dietary requirement',value:'',type:'text',formname:'dietary_requirement'},
                        //{name:'Allergies we need to know about',value:'',type:'text',formname:'allergies'}
]

var CakeExtras = [
                    { name:'Number of Tier (the number of layers)',value:'',type:'text',formname:'cake_tier', placeholder:'1-tier, 2-tier (specifies the number of layers)'},
]

var CakeAdditional = [
                    {name:'Sugar',value:'Sugar',type:'checkbox',formname:'flavours[]',label:'Please select your flavour from the list'},
                    {name:'Chocolate',value:'Chocolate',type:'checkbox',formname:'flavours[]'},
                    {name:'Vanilla',value:'Vanilla',type:'checkbox',formname:'flavours[]'},
                    {name:'Butter',value:'Butter',type:'checkbox',formname:'flavours[]'},
                    {name:'Cocoa',value:'Cocoa',type:'checkbox',formname:'flavours[]'},
                    {name:'Other(flavours)',value:'',type:'text',formname:'flavours_i_want_included'},
                    
        
]

var publicPrivateEvents = [{name:'Public Event',type:'radio',formname:'eventtype',siblings:

                          [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                      },
                      {name:'Private Event',type:'radio',formname:'eventtype'}]
  
var eventPlanning = ['EventPlanner','WeddingPlanner']; var cateringPlaceholder = 'Please tell us more about your needs e.g your main meals, side meals what type of drinks you want etc'; var placeholder = 'Please tell us more about your events, extra needs and services';

    var formElements = {
      'Caterers':{
                    'additional':CateringAdditionals,
                     extras:CateringExtras,
                     placeholder:cateringPlaceholder 
                },
      'SmallChops':{
                      'additional':SmallChopsAdditional,
                      placeholder:placeholder
      },
      'Canapes':{
                     'additional':CateringAdditionals,
                      extras:CateringExtras,
                      placeholder:placeholder 
                  },
      'VegetarianandVeganCatering':{
                     'additional':CateringAdditionals,
                      extras:CateringExtras,
                      placeholder:placeholder 
                  },
      'TableWare':{
                     'additional':CateringAdditionals
                  },
      'CorporateEventCatering':{
                     'additional':CateringAdditionals,
                      extras:CateringExtras,
                      placeholder:placeholder
                  },
      'Buffet':{
                     'additional':CateringAdditionals,
                      extras:CateringExtras,
                      placeholder:placeholder
                  },
      'CakeMakers':{
                      'additional':CakeAdditional,
                      'extras':CakeExtras
                  },
      'BellTents': {
                          'additional':MargueeAditional,
                          'extras':MargueeExtras
                  },
        'EventPlanner':{
                          'additional':CateringAdditionals.concat(eventPlannerAdditional),
                          'extras':MargueeExtras
        },
       'BusinessLunchCatering':{
                                      'additional':CateringAdditionals,
                                       'extras':CateringExtras,
                                       placeholder:placeholder
                                },
      'PartyTents':{
                        'additional':MargueeAditional,
                          'extras':MargueeExtras
                    },
        'TipiHire':{
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
          'Event Planner':{

          }
    }



    var eventType = {
      'Business Event':publicPrivateEvents,
    }

