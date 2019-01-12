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



if(window.location.pathname == "/offers"){
  localStorage.newOffers = "false";
}

if(localStorage.newOffers == "true"){
  $('#new_offer_icon').append('<i class="fas fa-exclamation-circle"></i></span>');
}

//Listen for new offer notifications
window.Echo.private('new_offers_for_' + user_id).listen('NewOfferNotification', e => {
  toastr.info('You have recieved a new offer');
  localStorage.newOffers = "true";

  if($('#new_offer_icon').html() == ""){
    $('#new_offer_icon').append('<i class="fas fa-exclamation-circle"></i></span>');
  }

  notification.play();
});


//Listen for offer messages
window.Echo.private('new_message_for_user_' + user_id).listen('NewOfferMessage', e => {
  if(e.offer_id != $('#offer_message_offer_id').val()){
    toastr.info(e.username + ' sent you a new message (Offer #'+ e.offer_id +')');
    localStorage.newOffers = "true";

    if($('#new_offer_icon').html() == ""){
      $('#new_offer_icon').append('<i class="fas fa-exclamation-circle"></i></span>');
    }

    notification.play();
  }
});


//If a offer is currently open, listen for new messages
if ($('#offer_messages').length){
  let offer_id = $('#offer_message_offer_id').val();

  window.Echo.channel('offers' + offer_id).listen('NewMessage', e => {

    if(e.message == "This Trade has been marked as complete" || e.message == "This Trade has been cancelled"){
      $('#offer_messages').append("<p>" + e.message + "</p>");
      $("#offer_message_send").prop('disabled', true);
      $("#openCompleteModal").prop('disabled', true);
      $("#openCancelModal").prop('disabled', true);
      notification.play();
    } else {
      $('#offer_messages').append("<p>" + e.username + ": " + e.message + "</p>");
      notification.play();
    }

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


$('#g_chat_send').on('click', function(e){
  e.preventDefault();
  $.post("/send_global_chat_message", $( "#global_chat_form" ).serialize());
});



//Global Chat
let global_chat = window.Echo.join('global_chat');
let user_count = 0
let messages = [];
if(sessionStorage.globalMessages != undefined){
  messages = JSON.parse(sessionStorage.globalMessages);
}

if(sessionStorage.globalChatOpen == undefined){
  sessionStorage.globalChatOpen = "false";
}

if(sessionStorage.globalChatOpen == "false"){
  $('#global_chat_inner').css( "display", "none" );
}

$('#open_global_chat').on('click', function(e){
  $('#global_chat_inner').toggle( "fast", "swing" );
});

//When the user joins
global_chat.here(users => {
  user_count = users.length;

    messages.forEach(function(message){
      $('#global_chat_messages').append('<p class="chat_message">(' + new Date(message.time.date) + ') <a href="/profile/' + message.username + '">' + message.username + '</a>: ' + message.message + '</p>');
    });

  users.forEach(function(user){
    $('#global_chat_users').append('<p class="chat_user"><a id="user'+ user.id +'" href="/profile/' + user.username + '">' + user.username + '</a></p>');
    $('#user_count').text(user_count);
  });
});

//When another user joins
global_chat.joining(user => {
  $('#global_chat_users').append('<p class="chat_user"><a id="user'+ user.id +'" href="/profile/' + user.username + '">' + user.username + '</a></p>');
  user_count += 1;
  $('#user_count').text(user_count);
});

//When another user leaves
global_chat.leaving(user => {
  $('#user' + user.id).remove();
  user_count -= 1;
  $('#user_count').text(user_count);
});

//When a new message is recieved
global_chat.listen('NewGlobalMessage', event => {
  messages.push(event);
  sessionStorage.globalMessages = JSON.stringify(messages);
  $('#global_chat_messages').append('<p class="chat_message">(' + new Date(event.time.date) + ') <a href="/profile/' + event.username + '">' + event.username + '</a>: ' + event.message + '</p>');
});
