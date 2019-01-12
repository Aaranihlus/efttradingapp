<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('new_offers_for_{recipient_id}', function($user, $recipient_id) {
  return (int) $user->id == (int) $recipient_id;
});

Broadcast::channel('new_message_for_user_{recipient_id}', function($user, $recipient_id) {
  return (int) $user->id == (int) $recipient_id;
});

Broadcast::channel('global_chat', function($user) {
  if(isset($user->id)){
    return ['username' => $user->username, 'id' => $user->id];
  }
});
