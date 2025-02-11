<x-guest-layout>
    <div class="loader"></div>
    <div id="app">
      <section class="h-screen bg-center bg-no-repeat bg-[url('https://www.thebusinessconcept.com/wp-content/uploads/2022/12/Supply-Chain-Logistics.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="container ">
          <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
              <div class="card card-primary mt-8">
                <div class="card-header">
                  <h4>Manufacturer Register</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{route('register.manufacturer')}}">
                    @csrf
                      <div class="form-group ">
                        <label for="frist_name">Full Name</label>
                        <input id="frist_name" type="text" class="form-control" name="name" >
                      </div>
                      <div class="row">

                          <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email">
                          </div>
                          <div class="form-group col-6">
                            <label for="address">Address</label>
                            <input id="address" type="address" class="form-control" name="address">
                          </div>
                      </div>
                      <div class="row">

                        <div class="form-group col-6">
                          <label for="phone">Phone</label>
                          <input id="phone" type="phone" class="form-control" name="contact">
                        </div>
                        {{-- <div class="form-group col-6">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                          </div> --}}
                    </div>

                    {{-- <div class="row">
                        <div class="form-group col-6">
                          <label for="email">Email</label>
                          <input id="email" type="email" class="form-control" name="email">
                          <div class="invalid-feedback">
                          </div>
                          <div class="form-group col-6">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" class="form-control" name="contact">
                          </div>
                    </div> --}}

                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                        <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</x-guest-layout>
