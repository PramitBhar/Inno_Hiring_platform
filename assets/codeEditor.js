import './styles/codeEditor.css';

// let editor = document.querySelector("#editor");

// ace.edit(editor, {
//   theme: "ace/theme/cobalt",
//   mode: "ace/mode/javascript",
// });

let editor;

window.onload = function () {
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/monokai");
  editor.session.setMode("ace/mode/c_cpp");
}
console.log("pramit");
window.changeLanguage = function changeLanguage() {

  let language = $("#languages").val();
  console.log("hello pramit");
  if (language == 'c' || language == 'cpp') editor.session.setMode("ace/mode/c_cpp");
  else if (language == 'php') editor.session.setMode("ace/mode/php");
  else if (language == 'python') editor.session.setMode("ace/mode/python");
  else if (language == 'node') editor.session.setMode("ace/mode/javascript");
}

window.executeCode = function executeCode() {
  console.log("Ajax bhai");
  $.ajax({

    url: "code_editor",

    method: "POST",

    data: {
      language: $("#languages").val(),
      code: editor.getSession().getValue(),
       input: $('#input').val()
    },

    success: function (response) {
      $(".output").text(response)
    },
    error: function (xhr, status, error) {
      console.error("Error - Status:", status, "Detail:", error);
      $(".output").text("Failed to execute code: " + error);
    }
  })
}


