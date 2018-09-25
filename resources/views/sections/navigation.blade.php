<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: 1px solid #9a8866">

  <!--Dark #9a8866 -->
  <!-- Light #fef7db -->

  <div class="container">
  <a class="navbar-brand bold" href="/">EFT Market</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      @guest
      <li class="nav-item">
          <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="/register"><i class="fas fa-user-plus"></i> Sign Up</a>
      </li>
      @endguest

      @auth
      <li class="nav-item">
        <a class="nav-link" style="color:#9a8866;" href="/profile"><i class="fas fa-archive"></i> My Inventory</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color:#9a8866;" href="/offers"><i class="fas fa-envelope"></i> My Offers</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color:#9a8866;" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
      @endauth
    </ul>

  </div>
</div>
</nav>
