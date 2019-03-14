/* jshint -W097 */
/* jshint -W117 */
/* jshint esversion: 6 */

'use strict';

if (!window.WebSocket) {
    alert(errorMessage);
}

let webSocket = new WebSocket('ws://front.advanced.yii:8080?channel=' + channelName);

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