<!DOCTYPE html>
<html lang="en">

@include('frontend.layout.head')

<body style="overflow-x: hidden;">
  <!-- Header  -->
  <!--  -->
    @yield('page')
  <!-- Footer  -->
  @include('frontend.layout.footer')

  <!-- Script -->
  @include('frontend.layout.script')
</body>

</html>