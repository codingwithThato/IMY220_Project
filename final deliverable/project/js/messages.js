$(document).ready(() => {
    const urlParams = new URLSearchParams(window.location.search);//Get the URL parameters
    const recipientId = urlParams.get("user_id");//Get the recipient ID from the URL

    const youtube = (url) => {
        const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/;
        return youtubeRegex.test(url);
    };

    const embedLink = (url) => {
        const match = url.match(/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&]+)/i);
        if (match && match[1]) {
            const vid = match[1];
            const iframe = $('<iframe>').attr({
                src: `https://www.youtube.com/embed/${vid}`,
                width: '100%',
                height: '315',
                frameborder: '0',
                allowfullscreen: 'true'
            });
            return iframe;
        }
        return null;
    };

    const addMessage = (message, buttonClicked) => {
        if (message.trim() !== '') {
            const messages = $('<div>').addClass('col-4 offset-8 mb-2 rounded-bottom');
            const messageParts = message.split(/\s+/);
            messageParts.forEach((part) => {
                if (youtube(part))
                    messages.append(embedLink(part));
                else
                    messages.append(document.createTextNode(part + ' '));
            });

            // if (buttonClicked === 'right')
                messages.css('background-color', '#a2866d');

            $('.messages').prepend(messages);
            $('#message').val('');

            sendMessage(message);
        }
    };

    const addMessage2 = (message, id, timestamp) => {
        const messages = id != recipientId ? $('<div>').addClass('col-4 offset-8 mb-2 rounded-bottom') : $('<div>').addClass('col-4 offset-0 mb-2 rounded-bottom');
        const messageParts = message.split(/\s+/);
        messageParts.forEach((part) => {
            if (youtube(part))
                messages.append(embedLink(part));
            else
                messages.append(document.createTextNode(part + ' '));
        });

        if(id != recipientId) messages.css('background-color', '#a2866d');
        else messages.css('background-color', 'grey');

        const messageDiv = id != recipientId ? $('<div>').append(messages).append(`<div class="row text-xs offset-9">(Sent at ${timestamp})</div>`) : $('<div>').append(messages).append(`<div class="row text-xs offset-1">(Sent at ${timestamp})</div>`);
        $('.messages').append(messageDiv);
        $('#message').val('');
    };

    //Send message using AJAX
    const sendMessage = (message) => {
        $.ajax({
            url: 'send_messages.php', 
            method: 'POST',
            data: { recipient_id: recipientId, message: message },
            success: (response) => {
                console.log(response);
                // resolve(response);
            },
            error: (error) => {
                console.error(error);
            },
        });
    };

    // Fetch messages
    const fetchMessages = () => {
        $.ajax({
            url: 'fetch_messages.php',
            method: 'GET',
            data: { recipient_id: recipientId },
            success: (messages) => {
                
                messages = JSON.parse(messages);

                messages.forEach((message) => {
                    addMessage2(message.content, message.sender_id, message.timestamp);
                });
            },
            error: (error) => {
                console.error(error);
            },
        });
    };

    fetchMessages();

    $(document).on('click', '.submit', () => {
        addMessage($('#message').val()), $(this).attr('id');
    });
});
