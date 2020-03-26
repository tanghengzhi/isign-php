function audioAutoPlay(id){
                var audio = document.getElementById(id);
                audio.play();
                document.addEventListener("WeixinJSBridgeReady", function () {
                    audio.play();
                }, false);
                document.addEventListener('YixinJSBridgeReady', function() {
                    audio.play();
                }, false);
            }
        audioAutoPlay('Jaudio');
		    if (/i(Phone|P(o|a)d)/.test(navigator.userAgent)) {
      $(document).one('touchstart',
        function(e) {
            $('#Jaudio').get(0).touchstart = true;
            $('#Jaudio').get(0).play();
            return false;
        });
    }
		

