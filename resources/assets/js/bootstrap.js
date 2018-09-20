try {
  window.$ = window.jQuery = require('jquery');
  require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true
});

let notification = new Audio('../audio/beep.mp3');

let user_id = $('#app').data('uid');

//Listen for new offer notifications
window.Echo.private('new_offers_for_' + user_id).listen('NewOfferNotification', e => {
  toastr.info('You have recieved a new offer');
  notification.play();
});


//If a offer is currently open, listen for new messages
if ($('#offer_messages').length){
  let offer_id = $('#offer_message_offer_id').val();

  window.Echo.channel('offers' + offer_id).listen('NewMessage', e => {
    $('#offer_messages').append("<p>" + e.username + ": " + e.message + "</p>");
    notification.play();

    if ($('#no_messages_info').length){
      $('#no_messages_info').remove();
    }
  });
};

$('#offer_message_send').on('click', function(e){
  e.preventDefault();
  $.post("/send_offer_message", $( "#New_Message_Form" ).serialize(), function(response){
    $('#offer_messages').append("<p>" + $('#offer_message_username').val() + ": " + $('#offer_message_message').val() + "</p>");
    $('#offer_message_message').val('')
    if ($('#no_messages_info').length ) {
      $('#no_messages_info').remove();
    }
  });
});
