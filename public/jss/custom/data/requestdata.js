    var MargueeAditional = [
                            
                            {name:'Generator Hire',value:'Generator Hire',type:'checkbox',formname:'extra[]',label:'Do you need this additional service'},
                            {name:'Mobile Toilet',value:'Mobile Toilet',type:'checkbox',formname:'extra[]'},
                            //{name:'Air Conditioning',value:'Air Conditioning',type:'checkbox',formname:'extra[]'},
                            {name:'Tables and Chairs',value:'Tables and Chairs',type:'checkbox',formname:'extra[]'}
    ]



var Margueeextra = [
                            
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
                            {name:'Service Staffs',value:'Catering Equipment',type:'checkbox',formname:'extra[]'},
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
                             {name:'Asun',value:'Mosa',type:'checkbox',formname:'extra[]'},
                             {name:'Puff Puff',value:'Puff Puff',type:'checkbox',formname:'extra[]'},
                            //  {name:'Beer Battered Fish',value:'Beer Battered Fish',type:'checkbox',formname:'extra[]'}
                            // {name:'tell us more',type:'text',formname:'iwantthisincludedalsointhesmallchops',value:''}
]

var DrinksAdditional = [
  {
    name :'Alcohol', value: 'Alcohol', type:'checkbox', formname:'drinks[]', id:'Alcohol', clickAction:{
      name:'Number of Alcohol Drinks you want', formname:'number_of_alcohol_drinks',value:'', id:'number_of_alcohol'
    }
  },
  {
    name :'Non-Alcohol', value: 'Non-Alcohol', type:'checkbox', id:'Non-Alcohol', formname:'drinks[]', clickAction:{
       name:'Number of Non-Alcohol Drinks you want', formname:'number_of_non_alcohol_drinks',value:'', id:'number_of_non_alcohol'
    }
  }
]

var DecoratorAdditional = [
  { name :'Event Theme(eg traditional)', value:'', type:'text', formname: 'event_theme',label: 'Any particular theme in mind'},
  {name:'Theme Color', value:'', type:'color', formname:'theme_color',label: 'Please select a color'}
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



var Cateringextra = [
                        {name:'Dietary requirement',value:'',type:'text',formname:'dietary_requirement', placeholder:'vegan, vegetarian'},
                        {
                              name:'Do you want starter and desserts',formname:'starters_desserts',type:'select',children:[
                                {name:'Starters',value:'Starters'},
                                {name:'Desserts',value:'Desserts'},
                                {name:'Both',value:'Both'},
                                {name:'None',value:'None'}
                
                              ]
                        },
                        {
                              name:'Venue type',formname:'venue_type',type:'select',children:[
                                {name:'Outdoors',value:'Outdoors'},
                                { name: 'Indoor', value:'Indoor'}
                                // {name:'Indoors with domestic kitchen facilities',value:'Indoors with domestic kitchen facilities'},
                                // {name:'Indoors with commercial kitchen facilities',value:'Indoors with commercial kitchen facilities'},
                                // {name:'Indoors without domestic kitchen facilities',value:'Indoors without domestic kitchen facilities'}
                
                              ]
                        },
                        {
                          name:'Menu', formname:'menu[]',type:'select',class:'menu',children:[
                            { name:'Jollof Rice',value:'Jollof Rice'},
                            { name:'Fried Rice',value:'Fried Rice'},
                            { name:'Fried Plantain',value:'Fried Plantain'},
                            { name:'Assorted Meats in Stews',value:'Assorted Meats in Stews'},
                            { name:'Chicken in Stew',value:'Chicken in Stew'},
                            { name:'Ofada Rice',value:'Ofada Rice'},
                            { name:'Moin Moin',value:'Moin Moin'},
                            { name:'Pounded Yam',value:'Pounded Yam'},
                            { name:'Amala',value:'Amala'},
                            { name:'Starch',value:'Starch'},
                            { name:'Efo- riro',value:'Efo- riro'},
                            { name:'Small Chops – Puff Puff, Spring Rolls, Asun, Samosa',value:'Small Chops – Puff Puff, Spring Rolls, Asun, Samosa'}
                            
                          ]
                        }
                        //{name:'Allergies we need to know about',value:'',type:'text',formname:'allergies'}
]

var Cakeextra = [
                    //{ name:'Number of Tier (the number of layers)',value:'',type:'text',formname:'cake_tier', placeholder:'1-tier, 2-tier (specifies the number of layers)'},
                    { name: 'Cake Shape', value:'', type:'select', formname:'cake_Shape', children:[
                      { name:'Oval',value:'Oval'},
                      { name:'Round',value:'Round'},
                      { name:'Heart',value:'Heart'},
                      { name:'Square',value:'Square'}
                    ]
                  },
                  { name:'Other Shape',value:'Other Shape', value:'', type:'text'},
                  { name: 'Cake Size', value:'', type:'select', formname:'cake_Size', children:[
                      { name:'6" inches',value:'6" inches'},
                      { name:'8" inches',value:'8" inches'},
                      { name:'10" inches',value:'10" inches'},
                      { name:'12" inches',value:'12" inches'},
                      { name:'14" inches',value:'14" inches'},
                      { name:'18" inches',value:'18" inches'},
                      { name:'20" inches',value:'20" inches'},
                    ]
                  },
]

var CakeAdditional = [
                    {name:'Sugar',value:'Sugar',type:'checkbox',formname:'flavours[]',label:'Please select your flavour from the list'},
                    {name:'Chocolate',value:'Chocolate',type:'checkbox',formname:'flavours[]'},
                    {name:'Vanilla',value:'Vanilla',type:'checkbox',formname:'flavours[]'},
                    {name:'Butter',value:'Butter',type:'checkbox',formname:'flavours[]'},
                    {name:'Cocoa',value:'Cocoa',type:'checkbox',formname:'flavours[]'},
                    {name:'Custom(flavours)',value:'',type:'text',formname:'flavours_i_want_included'},
                    
        
]

var publicPrivateEvents = [{name:'Public Event',type:'radio',formname:'eventtype',siblings:

                          [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                      },
                      {name:'Private Event',type:'radio',formname:'eventtype'}]
  
var eventPlanning = ['EventPlanner','WeddingPlanner']; var cateringPlaceholder = 'Please tell us more about your needs e.g your main meals, side meals what type of drinks you want etc'; var placeholder = 'Please tell us more about your events, extra needs and services';

    var formElements = {
      'Caterers':{
                    additional:CateringAdditionals,
                     extra:Cateringextra,
                     placeholder:'Do you want this additonal service' 
                },
        'Drinks':{
          additional:DrinksAdditional,
          /**Code to comment out */
          /** */
        },
      'SmallChops':{
                      additional:SmallChopsAdditional,
                      placeholder:'What do you want in the smallchops'
      },
      'Canapes':{
                     additional:CateringAdditionals,
                      extra:Cateringextra,
                      placeholder:placeholder 
                  },
      'VegetarianandVeganCatering':{
                     additional:CateringAdditionals,
                      extra:Cateringextra,
                      placeholder:placeholder 
                  },
      'TableWare':{
//additional:CateringAdditionals
                  },
      'CorporateEventCatering':{
                     additional:CateringAdditionals,
                      extra:Cateringextra,
                      placeholder:placeholder
                  },
      'Buffet':{
                     additional:CateringAdditionals,
                      extra:Cateringextra,
                      placeholder:placeholder
                  },
      'Decorator':{
        extra:DecoratorAdditional,
        placeholder:'Any particular theme and color'
      },
      'Cake':{
                      additional:CakeAdditional,
                      extra:Cakeextra,
                      placeholder:'Select from the following options '
                  },
      
      'BellTents': {
                          additional:MargueeAditional,
                          extra:Margueeextra
                  },
        'EventPlanner':{
                          additional:CateringAdditionals.concat(eventPlannerAdditional),
                          extra:Margueeextra
        },
       'BusinessLunchCatering':{
                                      additional:CateringAdditionals,
                                       extra:Cateringextra,
                                       placeholder:placeholder
                                },
      'PartyTents':{
                        additional:MargueeAditional,
                          extra:Margueeextra
                    },
        'TipiHire':{
                          additional:MargueeAditional,
                          extra:Margueeextra
                   },
        'Transport':{

                        extra:[

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

