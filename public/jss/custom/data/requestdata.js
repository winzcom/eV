 var _MyDataModule = (function(window){

     var _myData = {
        categorySelection:{
                'Caterers':[
                        {name:'Catering Equipment',id:27,type:'checkbox',formname:'cateringadditions[]'},
                        {name:'TableWare',id:19,type:'checkbox',formname:'cateringadditions[]'},
                        {name:'Waiting Staffs',id:3,type:'checkbox',formname:'cateringadditions[]'}
                    ],
        '- Canapes':[{name:'Waiting Staffs',id:1}],
        '- Vegetarian and Vegan Catering':[{name:'Waiting Staffs',id:1}],
        '- TableWare':[{name:'Catering Equipment',id:27}],
        '- Corporate Event Catering':[{name:'Waiting Staffs',id:1 }],
        '- Buffet':[{name:'Waiting Staffs',id:1}],
        '- Bell Tents':
                            {
                            'extras':[
                                        {name:'Tent Color',formname:'tentcolor',type:'text'},
                                        {name:'Tent Liner',formname:'tentliner',type:'text'}
                                    ]
                            }

        },

        eventSelection:{

                'Concert':[
                    {name:'Public Event',type:'radio',formname:'eventtype[]',siblings:

                        [{name:'Name of Event',formname:'eventname'},{name:'Website',formname:'eventwebsite'}]                          
                    },
                    {name:'Private Event',type:'radio',formname:'eventtype[]'}
                ],
                'Business Event':[
                        {name:'Public Event',type:'checkbox',formname:'eventtype[]'},
                        {name:'Private Event',type:'checkbox',
                        siblings:
                            [{name:'Name of Event',formname:'eventname'}]
            }]
        }
    }

    return {
        _myData:_myData
    }

})(window);






