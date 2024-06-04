<h6>Home Leader Realty Song</h6>
<style>
    /* Add your custom styles here */
    .audio-player {
        display: flex;
        align-items: center;
        background-color: #fec20f;
        padding: 4px;
        border-radius: 5px;
        width: 231px;
        margin-top: 10px !important;
        margin: 0px auto;
    }
    audio{
        display:none;
    }
    .audio-player button {
        margin-right: 10px;
    }
    #repeatm, #playm{
        background: unset;
        font-size: 26px;
        height: 33px;
        width: 34px;
        padding: 3px;
        color: honeydew;
        border-radius: 25px;
        border:none;
    }
</style>
</head>
<body>
<div class="audio-player">
    <audio id="audioPlayer" src="https://try.wpdownloadmanager.com/download/audio-songs/?ind=1702487586613&filename=sample3.mp3&wpdmdl=6790&refresh=665f2e0e286f41717513742" controls autoplay></audio>
    <button id="playm" onclick="togglePlayPause()" style="background: #df950c;"><svg viewBox="64 64 896 896" focusable="false" data-icon="play-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path d="M719.4 499.1l-296.1-215A15.9 15.9 0 00398 297v430c0 13.1 14.8 20.5 25.3 12.9l296.1-215a15.9 15.9 0 000-25.8zm-257.6 134V390.9L628.5 512 461.8 633.1z"></path></svg></button>
    <button id="repeatm" onclick="repeatAudio()" style="background:unset"><svg viewBox="64 64 896 896" focusable="false" data-icon="undo" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M511.4 124C290.5 124.3 112 303 112 523.9c0 128 60.2 242 153.8 315.2l-37.5 48c-4.1 5.3-.3 13 6.3 12.9l167-.8c5.2 0 9-4.9 7.7-9.9L369.8 727a8 8 0 00-14.1-3L315 776.1c-10.2-8-20-16.7-29.3-26a318.64 318.64 0 01-68.6-101.7C200.4 609 192 567.1 192 523.9s8.4-85.1 25.1-124.5c16.1-38.1 39.2-72.3 68.6-101.7 29.4-29.4 63.6-52.5 101.7-68.6C426.9 212.4 468.8 204 512 204s85.1 8.4 124.5 25.1c38.1 16.1 72.3 39.2 101.7 68.6 29.4 29.4 52.5 63.6 68.6 101.7 16.7 39.4 25.1 81.3 25.1 124.5s-8.4 85.1-25.1 124.5a318.64 318.64 0 01-68.6 101.7c-7.5 7.5-15.3 14.5-23.4 21.2a7.93 7.93 0 00-1.2 11.1l39.4 50.5c2.8 3.5 7.9 4.1 11.4 1.3C854.5 760.8 912 649.1 912 523.9c0-221.1-179.4-400.2-400.6-399.9z"></path></svg></button>
    <input type="range" min="0" max="1" step="0.1" oninput="setVolume(this.value)" />
</div>

<script>
    const audioPlayer = document.getElementById('audioPlayer');

    let isPlaying = true;

    function togglePlayPause() {
        if (isPlaying) {
            pauseAudio();
            document.getElementById("playm").style.background = "#df950c;";
        } else {
            playAudio();
            document.getElementById("playm").style.border = "unset";
        }
        isPlaying = !isPlaying;

        if(isPlaying){
            document.getElementById('playm').style = 'background: #df950c;';
        } else{
            document.getElementById('playm').style = 'background:unset';
        }
    }

    function playAudio() {
        audioPlayer.play();
    }

    function pauseAudio() {
        audioPlayer.pause();
    }

    function repeatAudio() {
        audioPlayer.loop = !audioPlayer.loop;
        if(audioPlayer.loop){
            document.getElementById('repeatm').style = 'background:unset';
        } else{
            document.getElementById('repeatm').style = 'background: #df950c;';
        }
    }

    function setVolume(volume) {
        audioPlayer.volume = volume;
    }
    repeatAudio();
</script>