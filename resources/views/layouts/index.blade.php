<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.topbar')
      @include('layouts.sidebar')
      <!-- Main Content -->
      @yield('content')

      @include('layouts.footer')
    </div>
  </div>

  @include('layouts.script')
</body>
</html>
