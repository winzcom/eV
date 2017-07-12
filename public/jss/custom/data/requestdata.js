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
                        {name:'Dietary requirement',value:'',type:'text',formname:'dietary_requirement'},
                        {name:'Venue Type',type:'select',formname:'venue_type',children:[
                            {name:'Indoor',value:'Indoor'},
                            {name:'Outdoor',value:'Outdoor'}
                        ],
                    },
                    {name:'Do you need starter and dessert',type:'select',formname:'starter_dessert',children:[
                        {name:'None',value:'None'},
                        {name:'Starter Only',value:'Starter Only'},
                        {name:'Dessert Only',value:'Dessert Only'},
                        {name:'Both',value:'Both'},
                    ]},
                    {name:'Menu',type:'select',formname:'Menu',children:[
                        {name:'Jollof Rice',value:'Jollof Rice'},
                        {name:'Fried Rice',value:'Fried Rice'},
                        {name:'Amala',value:'Amala'},
                        {name:'Pounded Yam',value:'Pounded Yam'},
                        {name:'Egusi',value:'Egusi'}
                    ]}
                        //{name:'Allergies we need to know about',value:'',type:'text',formname:'allergies'}
]

/*var CakeExtras = [
                    {
                      name:'Flavours',formname:'cake_flavours',type:'select',children:[
                        {name:'Sugar',value:'Sugar'},
                        {name:'Chocolate',value:'Chocolate'},
                        {name:'Cocoa',value:'Cocoa'},
                        {name:'Butter',value:'Butter'},
                        {name:'Vanilla',value:'Vanilla'}
                      ]
                    }
]*/

var CakeAdditional = [
                    {name:'Sugar',value:'Sugar',type:'checkbox',formname:'flavours[]',label:'Please select your flavour from the list'},
                    {name:'Chocolate',value:'Chocolate',type:'checkbox',formname:'flavours[]'},
                    {name:'Vanilla',value:'Vanilla',type:'checkbox',formname:'flavours[]'},
                    {name:'Butter',value:'Butter',type:'checkbox',formname:'flavours[]'},
                    {name:'Cocoa',value:'Cocoa',type:'checkbox',formname:'flavours[]'},
                    {name:'Other(flavour)',value:'Other',type:'text',formname:'flavours_i_want_included'}
        
]

var cakeExtras = [
    {name:'Cake Shape',type:'select',formname:'cake_shape',children:[
        {name:'Round',value:'Round'},
        {name:'Square',value:'Square'},
        {name:'Heart',value:'Heart'},
        {name:'Oval',value:'Oval'},
        {name:'Hexagon',value:'Hexagon'},
        ]
    },
    {name:'Custom Shape',value:"",type:'text',formname:'custom_shape'},
    {name:'Cake Size',value:'',type:'select',formname:'cake_size',children:[
            {name:'6"inches',value:'6"inches'},
            {name:'8"inches',value:'8"inches'},
            {name:'10"inches',value:'10"inches'},
            {name:'12"inches',value:'12"inches'},
            {name:'14"inches',value:'14"inches'},
            {name:'20"inches',value:'20"inches'},
        ]
    }
]

var drinkAdditional = [
    {
        name:'Alcohol', value:'Alcohol',type:'checkbox',formname:'drink[]',clickAction:{id:'alcohol',formname:'alcohol_needed'},
    },
    {
        name:'Non-Alcohol', value:'Non-Alcohol',type:'checkbox',formname:'drink[]',clickAction:{id:'non-alcohol',formname:'non_alcohol_needed'}
    }
]

var publicPrivateEvents = [{name:'Public Event',type:'radio',formname:'eventtype',siblings:

                          [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                      },
                      {name:'Private Event',type:'radio',formname:'eventtype'}]
  
var eventPlanning = ['EventPlanner','WeddingPlanner']; var cateringPlaceholder = 'Please tell us more about your needs e.g your main meals, side meals what type of drinks you want etc'; var placeholder = 'Please tell us more about your events, extra needs and services';

    var formElements = {
      'Caterers':{
                    additional:CateringAdditionals,
                     extra:CateringExtras,
                     placeholder:cateringPlaceholder 
                },
      'SmallChops':{
                      additional:SmallChopsAdditional,
                      placeholder:placeholder
      },
      'Drinks':{
        additional:drinkAdditional
      },
      'Canapes':{
                     additional:CateringAdditionals,
                      extra:CateringExtras,
                      placeholder:placeholder 
                  },
      'VegetarianandVeganCatering':{
                     additional:CateringAdditionals,
                      extra:CateringExtras,
                      placeholder:placeholder 
                  },
      'TableWare':{
                     additional:CateringAdditionals
                  },
      'CorporateEventCatering':{
                     additional:CateringAdditionals,
                      extra:CateringExtras,
                      placeholder:placeholder
                  },
      'Buffet':{
                     additional:CateringAdditionals,
                      extra:CateringExtras,
                      placeholder:placeholder
                  },
      'Cake':{
                      additional:CakeAdditional,
                      extra:cakeExtras
                  },
      'BellTents': {
                          additional:MargueeAditional,
                          extra:MargueeExtras
                  },
        'EventPlanner':{
                          additional:CateringAdditionals.concat(eventPlannerAdditional),
                          extra:MargueeExtras
        },
       'BusinessLunchCatering':{
                                      additional:CateringAdditionals,
                                       extra:CateringExtras,
                                       placeholder:placeholder
                                },
      'PartyTents':{
                        additional:MargueeAditional,
                          extra:MargueeExtras
                    },
        'TipiHire':{
                          additional:MargueeAditional,
                          extra:MargueeExtras
                   },
        'Transport':{

                        extras:[

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

