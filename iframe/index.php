
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<meta name="description" content="Radio Station">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
<link rel="image_src" href="assets/img/favicon.png"/>
<link rel="SHORTCUT ICON" href="assets/img/favicon.png" type="image/png"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Radio Station"/>
<meta property="og:description" content="Listen live to "/>
<meta property="og:url" content="https://radioplayer.link/iframe/index.php?autoplay=&name=&logo=assets/img/radiologo.gif&bgcolor=&textcolor=&v=&stream="/>
<meta property="og:site_name" content=""/>
<meta property="og:image" content="assets/img/favicon.png"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="Listen live to "/>
<meta name="twitter:title" content="Listen live to "/>
<meta name="twitter:site" content="@magic_streams"/>
<meta name="twitter:url" value="https://radioplayer.link/iframe/index.php?autoplay=&name=&logo=assets/img/radiologo.gif&bgcolor=&textcolor=&v=&stream="/>
<meta name="twitter:image" content="assets/img/favicon.png"/>
<meta name="twitter:creator" content="@magic_streams"/>
 
<link id="maintheme" href="assets/css/html5-tranparent.css" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" type="text/css">
 
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-32x32.png">
<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.jplayer.min.js"></script>
<script type="text/javascript">
//<![CDATA[
	   $(document).ready(function(){
	   var streammagic = {
	       mp3: ""
       },
       ready = false;
       $("#jquery_jplayer_magic").jPlayer({
	       ready: function (event) {
		       ready = true;
		       $(this).jPlayer("setMedia", streammagic).jPlayer("");
	       },
	       play: function() {
		       $(this).jPlayer("pauseOthers", 0);
			$('#volumemagic').css('visibility','visible');
	       },
	       pause: function() {
		       $(this).jPlayer("clearMedia");
			$('#volumemagic').css('visibility','hidden');
	       },
	       error: function(event) {
		       if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
			       $(this).jPlayer("setMedia", streammagic).jPlayer("play");
		       }
	       },
	       swfPath: "jPlayer/dist/jplayer",
	       supplied: "mp3",
		   cssSelectorAncestor: "#jp_container_magic",
	       preload: "none",
	       globalVolume: "true",
	       volume: "0.99"
       });
});
//]]>

$(document).ready(function() {

  refreshTable();
  loadArtist();

  $("#jquery_jplayer_magic").on(
    $.jPlayer.event.ready + ' ' + $.jPlayer.event.play,
    function(event) {


      /* === VOLUME DRAGGING ==== */

      $('.jp-volume-bar').mousedown(function() {
          var parentOffset = $(this).offset(),
            width = $(this).width();
          $(window).mousemove(function(e) {
            var x = e.pageX - parentOffset.left,
              volume = x / width
            if (volume > 1) {
              $("#jquery_jplayer_magic").jPlayer("volume", 1);
            } else if (volume <= 0) {
              $("#jquery_jplayer_magic").jPlayer("mute");
            } else {
              $("#jquery_jplayer_magic").jPlayer("volume", volume);
              $("#jquery_jplayer_magic").jPlayer("unmute");
            }
          });
          return false;
        })
        .mouseup(function() {
          $(window).unbind("mousemove");
        });

      /* === ENABLE DRAGGING ==== */

      var timeDrag = false; /* Drag status */
      $('.jp-play-bar').mousedown(function(e) {
        timeDrag = true;
        updatebar(e.pageX);
      });
      $(document).mouseup(function(e) {
        if (timeDrag) {
          timeDrag = false;
          updatebar(e.pageX);
        }
      });
      $(document).mousemove(function(e) {
        if (timeDrag) {
          updatebar(e.pageX);
        }
      });

      //update Progress Bar control
      var updatebar = function(x) {

        var progress = $('.jp-progress');
        //var maxduration = myPlaylist.duration; //audio duration

        var position = x - progress.offset().left; //Click pos
        var percentage = 100 * position / progress.width();

        //Check within range
        if (percentage > 100) {
          percentage = 100;
        }
        if (percentage < 0) {
          percentage = 0;
        }

        $("#jquery_jplayer_magic").jPlayer("playHead", percentage);

        //Update progress bar
        $('.jp-play-bar').css('width', percentage + '%');
      };


    }); // end jplayer event ready

}); // end document ready
function refreshTable(){
    $('').load('', function(){
       setTimeout(refreshTable, 180000);
    });
}

function loadArtist(){
$('.artist-preload').show();
        $.ajax({
            url: "lastfm.php?stream=",
          	cache: false,
            success: function(data){
        	console.log(data);

			pub = '';
			target = '';
			$('#promo').removeAttr('href');

if(!data) { data = 'assets/img/radiologo.gif';
			pub = 'https://www.magicstreams.services';
			target = '_blank';
			$('#promo').attr('target', target);
			$('#promo').attr('href', pub);
 }
 
 
			$('#imagine').attr('src', data);




$('.artist-preload').hide();
            }
        })
$.ajaxSetup({ cache: false });
}
setInterval(loadArtist,180000);

</script>
</head>
<body style="background-color:#;color:#;">
 
<div class="main-container" style="margin: middle !important;">
 
<div class="stats main" style="text-align: middle !important;">
<div class="artist-image">
<div><a id="promo"><img id="imagine" width="120" height="120" src="assets/img/radiologo.gif"></a></div>
<div class="artist-preload" style="display: none;"></div>
</div>
<div class="onair">
<div class="artist"><font color=""></font></div>
<div id="stats"></div>
</div>
</div>
<div class="stats history" style="display: none;"></div>
</div>
 
<div class="jp-jplayer" id="jquery_jplayer_magic" style="width: 0px; height: 0px;">
<img id="jp_poster_magic" style="width: 0px; height: 0px; display: none;">
<audio id="jp_audio_magic" preload="none" src=""></audio>
</div>
<div aria-label="media player" role="application" class="player jp-audio-stream" id="jp_container_magic" style="margin: middle !important;">
 
<div id="jplayer-object"></div>
 
<div class="playback">
<div class="jp-play play" title="Play">
<svg width="68" height="68" version="1.0" id="button" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 68 68" xml:space="preserve">
<circle cx="34" cy="34" r="32"/>
<path fill="#FFFFFF" d="M47.9,32.9L31.4,20c-0.9-0.9-2.5-0.9-3.4,0l0,0c-0.4,0.4-0.9,0.9-0.9,1.3v25.3c0,0.4,0.4,0.9,0.9,1.3l0,0 c0.9,0.9,2.5,0.9,3.4,0L47.9,35C48.7,34.6,48.7,33.8,47.9,32.9L47.9,32.9z"/>
</svg>
</div>
<div class="jp-pause stop" style="display: none;" title="Stop">
<svg width="68" height="68" version="1.1" id="button" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 68 68" xml:space="preserve">
<circle cx="34" cy="34" r="32"/>
<path fill="#FFFFFF" d="M42.7,44.7H25.3c-1.1,0-1.9-0.9-1.9-1.9V25.3c0-1.1,0.9-1.9,1.9-1.9h17.5c1.1,0,1.9,0.9,1.9,1.9v17.5 C44.7,43.8,43.8,44.7,42.7,44.7z"/>
</svg>
</div>
</div>
 
<div class="volume-control">
<div class="jp-mute volume-icon" title="Mute">
<svg id="volume" height="28" width="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#525252"><path d="M6 18v12h8l10 10V8L14 18H6zm27 6c0-3.53-2.04-6.58-5-8.05v16.11c2.96-1.48 5-4.53 5-8.06zM28 6.46v4.13c5.78 1.72 10 7.07 10 13.41s-4.22 11.69-10 13.41v4.13c8.01-1.82 14-8.97 14-17.54S36.01 8.28 28 6.46z"/><path d="M0 0h48v48H0z" fill="none"/></svg>
</div>
<div class="jp-unmute volume-icon" style="display: none;" title="Unmute">
<svg id="muted" height="28" width="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#525252"><path d="M33 24c0-3.53-2.04-6.58-5-8.05v4.42l4.91 4.91c.06-.42.09-.85.09-1.28zm5 0c0 1.88-.41 3.65-1.08 5.28l3.03 3.03C41.25 29.82 42 27 42 24c0-8.56-5.99-15.72-14-17.54v4.13c5.78 1.72 10 7.07 10 13.41zM8.55 6L6 8.55 15.45 18H6v12h8l10 10V26.55l8.51 8.51c-1.34 1.03-2.85 1.86-4.51 2.36v4.13c2.75-.63 5.26-1.89 7.37-3.62L39.45 42 42 39.45l-18-18L8.55 6zM24 8l-4.18 4.18L24 16.36V8z"/><path d="M0 0h48v48H0z" fill="none"/></svg>
</div>
<div class="volume-slider">
<div class="jp-volume-bar progress vol-progress">
<div class="jp-volume-bar-value progress-bar active progress-bar-striped progress-bar-success vol-bar">
<div class="circle-control" title="Volume"></div>
</div>
</div>
<div class="player-status" ><font color="">Playing  <span class="jp-current-time" role="timer">00:00</font></span></div>
</div>
</div>
<div class="playlists">
<span>Listen in your favourite player</span>
<a tabindex="1" target="_blank" href="playlist.php?stream=&title=&name=Listen.pls" title="Winamp"><img width="32" height="32" src="assets/img/player-winamp-icon.svg"></a>
<a tabindex="1" target="_blank" href="playlist.php?stream=&title=&name=Listen.asx" title="Windows Media Player"><img width="32" height="32" src="assets/img/player-wmp-icon.svg"></a>
<a tabindex="1" target="_blank" href="playlist.php?stream=&title=&name=Listen.m3u" title="QuickTime"><img width="32" height="32" src="assets/img/player-quicktime-icon.svg"></a>
<a tabindex="1" target="_blank" href="playlist.php?stream=&title=&name=Listen.m3u" title="VLC Player"><img width="32" height="32" src="assets/img/player-vlc-icon.svg"></a>
</div>
<small style="bottom: 8px;font-size: 8px;position: fixed;right: 8px;text-shadow: 0px 0px 4px rgba(0, 0, 0, 1);z-index: 1004;"><b><a style="color:#fff;text-decoration: none;" target="_blank" href="https://magicstreams.services" title="Radio Streaming">Magic Streams</a></b></small>
</div>
</body>
</html>
