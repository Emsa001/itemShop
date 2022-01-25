function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === "paste") {
    key = event.clipboardData.getData("text/plain");
  } else {
    // Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

var input = $("input[name='pscpin']");
input.on("keyup", function (e) {
  var value = input.val();
  // catching backspace
  if (e.keyCode === 8) {
    if (value.length == 4) {
      input.val(value.substr(0, 3));
    } else if (value.length == 7) {
      input.val(value.substr(0, 6));
    }
  } else {
    if (value.length == 4) {
      input.val(value + "-");
    }
    if (value.length == 9) {
      input.val(value + "-");
    }
    if (value.length == 14) {
      input.val(value + "-");
    }
  }
});
