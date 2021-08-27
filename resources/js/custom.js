$(function () {

    // 
    if(this.location.href.indexOf('sample') != -1 ){

        $('#cut_in_outer').animate({
            'left': '100px',
            'top': '200px'
        },{
            'duration': 1200,
            'easing': 'swing'
            //'easing': 'linear'
        });

        /*
        for(var i=0; i < 1000; i++){

            var leftPostion = "'left: " + (1500 - i) + "px;'";

            $('#cut_in_outer').css(leftPosition);
            console.log('leftPostion: ' + leftPostion);
        }
        */
    }

})