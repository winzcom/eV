window.addEventListener('load',function(event) {

    var imgs = document.getElementsByTagName('IMG');  
    createImgObserver();  
});

function createImgObserver() {
    var options = {
        root: null,
        rootMargin: "0px",
        threshold: 0.75
      };
    var observer = new IntersectionObserver(handleIntersect,options);
    observer.observe(imgs);
}

function handleIntersect(entries,observer) {
    entries.forEach(function(entry) {
        (function(entry){
            entry.target.src = entry.target.dataset.src;
        })(entry)
    }, this);
}