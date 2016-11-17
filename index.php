<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Speech recognition Testing</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">

  </head>
  <body style="background: #eee">
    <div style="padding: 20px;" >
      <div class="controller" style="padding: 10px; border: 1px solid #eee; background: #bbb" >
        <button onclick="startButton(this)" type="button" name="button_start" id="button-start" >Start</button>
        <button onclick="stopButton(this)" type="button" name="button_stop" id="button-stop" >Stop</button>
      </div>


      <textarea name="name" rows="8" style="width: 395px; text-align: left !important; display: none" id="textarea-show" >Say something....
      </textarea>

      <div class="h-log" style="width: 0100%; height: 400px; overflow-y: scroll; background: black; color:#52ff52; font-family: 'Ubuntu Mono', monospace;" id="h-log"  >

      </div>


    </div>
  </body>

  <script type="text/javascript">
    // included function
      var two_line = /\n\n/g;
      var one_line = /\n/g;
      function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
      }

      var first_char = /\S/;
      function capitalize(s) {
        return s.replace(first_char, function(m) { return m.toUpperCase(); });
      }



    console.log('tik tok..');
    if (!('webkitSpeechRecognition' in window)) {
      console.log('upgrade');

    }
    else{
      var recognition = new webkitSpeechRecognition();
      recognition.continuous = true;
      recognition.interimResults = true;

      recognition.onstart = function() {
        hlog("Recognition is started");
      }

      recognition.onresult = function(event) {
        console.log("Recognition have a Result");
        var interim_transcript = '';

        for (var i = event.resultIndex; i < event.results.length; ++i) {
          if (event.results[i].isFinal) {
            final_transcript += event.results[i][0].transcript;
          } else {
            interim_transcript += event.results[i][0].transcript;
          }
        }
        final_transcript = capitalize(final_transcript);
        //final_span.innerHTML = linebreak(final_transcript);
        //interim_span.innerHTML = linebreak(interim_transcript);

        hlog( "Final Span : " + linebreak(final_transcript));
        hlog("Interim Span : "+ linebreak(interim_transcript) );



      }
      recognition.onerror = function(event) {
        hlog("Recognition is Error");
      }
      recognition.onend = function() {
        hlog("Recognition is end");
      }
    }
    // .......................................

    function startButton(event) {
      final_transcript = '';
      recognition.lang = 'en-US'; //select_dialect.value;
      recognition.start();
    }

    function stopButton(event){
      recognition.stop();
    }
    function hlog(text){
      var h_log_span = document.getElementById('h-log');
      h_log_span.innerHTML = h_log_span.innerHTML + "# " + text + "<br>";
      h_log_span.scrollTop = h_log_span.scrollHeight;
    }

    // } else {
    //   var recognition = new webkitSpeechRecognition();
    //   recognition.continuous = true;
    //   recognition.interimResults = true;
    //
    //   recognition.onstart = function() { ... }
    //   recognition.onresult = function(event) { ... }
    //   recognition.onerror = function(event) { ... }
    //   recognition.onend = function() { ... }
    //

  </script>

</html>
