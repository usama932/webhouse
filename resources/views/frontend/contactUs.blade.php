@extends('frontend.index')
@section('page')

    <header>

    @include('frontend.layout.menu')
    <div class="row g-0">
      <div class="col-12">
        <div class="banner-text-page1 ">
          <h1 class="text-yello">Better</h1>
            <h1 class=" text-yello"> Together</h1>
        </div>
        <img src="assets/imges/Keyboard_laptop-scaled.png" alt="" class="img-fluid banner-page1">
      </div>
    </div>
    </header>
    <!-- Header end -->

    <section class="contact-us pb-6">
        <div class="contact-us-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Enquiry</h1>
                        <div class="contact-container">
                            @if ($errors->any())
                                <div class="alert alert-success">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('send_enquiry') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text contact-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="sender_name" class="form-control contact-control"
                                        placeholder="Name" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text contact-group-text"><i
                                            class="fas fa-envelope"></i></span>
                                    <input type="email" name="sender_email" class="form-control contact-control"
                                        placeholder="Email" required>
                                </div>
                                <div class="input-group mb-3">
                                    <textarea name="message" id="" rows="5" class="form-control contact-control" placeholder="Message"
                                        required></textarea>
                                </div>

                                <button type="submit" class="btn btn-sm bnt-send">Send</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/imges/piccccc.png') }}" alt="Web House" class="contact-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="padding-footer">

    </div>

@endsection
