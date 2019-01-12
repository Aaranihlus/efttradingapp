<ul class="list-group text-center" id="global_chat_container">

  <li class="list-group-item">
    <span id="open_global_chat">Global Chat (<i class="fas fa-users"></i> <span id="user_count">0</span>)</span>
  </li>


  <div id="global_chat_inner">

    <div class="row">
      <div class="col-9 pr-0">
        <li class="list-group-item p-2" style="min-height:20vh;" id="global_chat_messages"></li>
      </div>
      <div class="col-3 pl-0">
        <li class="list-group-item p-2" style="min-height:20vh;" id="global_chat_users">
          <span>Online Users</span>
        </li>
      </div>
    </div>

    <li class="list-group-item">
      <form method="POST" id="global_chat_form">
        {{ csrf_field() }}
        @auth
        <input type="hidden" name="username" value="{{ auth()->user()->username }}">
        <div class="row">
          <div class="col-8">
            <input type="text" style="width:100%; height:100%;" name="message" id="g_chat_message" placeholder="Type your message">
          </div>
          <div class="col-4">
            <button class="btn btn-primary" style="width:100%;" id="g_chat_send">Send</button>
          </div>
        </div>
        @else
          <p>Please Sign in to use global chat</p>
        @endauth
      </form>
    </li>

  </div>


</ul>
