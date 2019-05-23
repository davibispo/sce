(function () {
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        photo = document.getElementById('photo');
        
        //vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =   (navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia);
    navigator.getMedia({
        video: true,
        audio: false
    }, function (stream) {
        attachMediaStream(video, stream);
        //video.src = vendorUrl.createObjectURL(stream);
        //video.play();
    }, function (error) {
        //an error occured
        //error code
    });
    
    document.getElementById('capture').addEventListener('click', function(stream){
        //alert('Estou aqui!');
        context.drawImage(video,0,0,300,200);
        photo.setAttribute('src',canvas.toDataURL('image/png'));
    });
    
})();


