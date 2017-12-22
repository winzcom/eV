var vm = new Vue({
    el:"#reviews",
    data:{
        paginatedData:{},
        items:[],
        observer:null,
        img: window.location.origin+'/img/defaultRequest.jpg',
        dataAvailable:false,
        showLoader:false
    },
    methods:{
        getReviews: function() {
                var url = window.location.origin;
                $.ajax({
                    url:url,
                    success:function(response) {
                        this.paginatedData = response;
                        this.items = typeof this.paginatedData.data !== 'undefined' ? this.paginatedData.data.map(function(item) {
                            //item.url = window.location.origin+'/detail/'+item.name_slug+'/'+item.categories[0].id;
                            //item.currentState = state.value;
                            //item.currentCategory = category.value;
                            return item;
                        }) : [];

                        this.dataAvailable = this.items.length > 0;
                        //this.dataAvailable === true ? this.observer.observe(document.querySelectorAll('.vendor-img')) : null;
                        this.showLoader = false;
                    }.bind(this)
                });
        },
        goToDetail: function(url) {
            window.location.href = url;
        },
        getMoreReviews: function(entries, observer) {
            Array.prototype.forEach.call(entries,function(entry) {
                if( entry.intersectionRatio > 0 ) {
                    /** Load more vendors to view */
                    //bus.$emit('loadVendors');
                    if(entry.target.tagName == 'IMG') {
                        entry.target.src = '/img/defaultRequest.jpg';
                        this.loadImage(entry.target);
                    }
                    else
                        this.loadReviews();
                    //document.querySelector('#vendor').insertAdjacentElement('beforeend',document.querySelector('#sentel'));
                }
            }.bind(this));
        },
        loadReviews: function() {
            var self = this;
            if( this.paginatedData.next_page_url !== null && typeof this.paginatedData.next_page_url !== 'undefined' ) {
                $.ajax({
                    url: self.paginatedData.next_page_url,
                    status: {
                        500: function(err){
                            console.log(err)
                        },
                    },
                    success: function(response) {
                        self.paginatedData = response;
                        response.data.forEach(function(vendor) {
                            self.items.push(vendor);
                        });

                        self.dataAvailable = self.items.length > 0 ? true : false;
                    }
                })
            }
        },
        loadImage: function(img) {
            img.setAttribute('src',img.src);
        }
    },
    
    mounted () {
        var options = {
            root:null,
            rootMargin: '0px',
            threshold: 1.0
          }
          this.observer = new IntersectionObserver(this.getMoreVendor, options);
          this.observer.observe(document.querySelector('#sentel'));
          //observer.observe(document.querySelectorAll('.vendor-img'));
          //bus.$on('loadVendors', this.loadVendors);
    }
});
