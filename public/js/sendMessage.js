// autoexpand textarea
function onExpandableTextareaInput({ target: elm }) {
  if (!elm.classList.contains('autoExpand') || !elm.nodeName == 'TEXTAREA') return

  let minRows = elm.getAttribute('data-min-rows') | 0, rows;
  !elm._baseScrollHeight && getScrollHeight(elm)

  elm.rows = minRows
  rows = Math.ceil((elm.scrollHeight - elm._baseScrollHeight) / 16)
  elm.rows = minRows + rows

  window.scrollTo(0, document.body.scrollHeight);
}
function getScrollHeight(elm) {
  var savedValue = elm.value
  elm.value = ''
  elm._baseScrollHeight = elm.scrollHeight
  elm.value = savedValue
}

document.addEventListener('input', onExpandableTextareaInput)


// Send with enter
let input = document.getElementById("textarea");
let sender = document.getElementById("sender").value;
let receiver = document.getElementById("receiver").value;
let nick = document.getElementById('nick').value;
input.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    });
    $.ajax({
      url: '/' + nick + '/messages/send',
      data: { 'sender': sender, 'receiver': receiver, 'content': input.value },
      type: "POST",
      success: function (result) {
        let chatContainer = document.getElementById('chatContainer');
        let userMessageSenderContainer = document.createElement('div');
        userMessageSenderContainer.setAttribute('class', 'userMessageSender');
        let createdAtContainer = document.createElement('div');
        createdAtContainer.setAttribute('class', 'createdAt');
        let innerCreatedAtContainer = document.createElement('h5');
        let innerUserMessageContainer = document.createElement('div');
        innerUserMessageContainer.setAttribute('class', 'innerUserMessage');
        let contentContainer = document.createElement('div');
        contentContainer.setAttribute('class', 'content');
        let textContainer = document.createElement('div');
        textContainer.setAttribute('class', 'text');
        let paragraph = document.createElement('p');
        chatContainer.appendChild(userMessageSenderContainer);
        userMessageSenderContainer.appendChild(innerUserMessageContainer);
        innerUserMessageContainer.appendChild(contentContainer);
        contentContainer.appendChild(textContainer);
        textContainer.appendChild(paragraph);
        paragraph.innerHTML = result.content;
        userMessageSenderContainer.appendChild(createdAtContainer);
        createdAtContainer.appendChild(innerCreatedAtContainer);
        innerCreatedAtContainer.innerHTML = "Ahora";
      },
    })
    input.setSelectionRange(0, 0);
    input.value = "";
    input.setAttribute('rows', '0');
    window.scrollTo(0, document.body.scrollHeight);
  }
});



