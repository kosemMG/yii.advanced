/* jshint -W097 */
/*jshint esversion: 6 */

'use strict';

if (!window.WebSocket) {
    alert('Sorry. Your browser does not support web-sockets...');
}

let webSocket = new WebSocket('ws://front.advanced.yii:8080?channel=');

document.getElementById('chat_form')
    .addEventListener('submit', function (event) {
        let chatData = {
            message: this.message.value,
            channel: this.channel.value,
            author_id: this.author_id.value
        };

        webSocket.send(JSON.stringify(chatData));
        event.preventDefault();
        return false;
    });

webSocket.onmessage = function (event) {
    let data = event.data,
        messageContainer = document.createElement('div'),
        textNode = document.createTextNode(data);

    messageContainer.appendChild(textNode);
    document.getElementById('chat')
        .appendChild(messageContainer);
};