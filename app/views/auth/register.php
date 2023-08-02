<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start">
    <div class="row gx-lg-5 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          The best offer <br />
          <span style="color: hsl(218, 81%, 75%)">for your business</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
          Temporibus, expedita iusto veniam atque, magni tempora mollitia
          dolorum consequatur nulla, neque debitis eos reprehenderit quasi
          ab ipsum nisi dolorem modi. Quos?
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form action="<?= BASEURL; ?>/auth/createUser" method="post">
              <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2>Login</h2>
                </div>
                <div class="col-md-12 mb-4">
                  <div class="form-outline">
                      <input type="hidden" id="role" class="form-control" name="role" value="USER" required />
                      <label class="form-label" for="username">Username</label>
                      <input type="text" id="username" class="form-control" name="username" required />
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="email">Email address</label>
                  <input type="email" id="email" class="form-control"  name="email" required/>
              </div>
              <div class="form-outline mb-4">
                  <label class="form-label" for="address">Address</label>
                  <input type="text" id="address" class="form-control"  name="address" required/>
              </div>
              <div class="form-outline mb-4">
                  <label class="form-label" for="phone_number">Phone Number</label>
                  <input type="text" id="phone_number" class="form-control"  name="phone_number" required/>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" class="form-control" name="password" required />
              </div>

              <!-- Submit button -->
              <div class="d-grid gap-2 col-12 mx-auto">
                  <button type="submit" class="btn btn-primary btn-block mb-4">
                    Sign up
                  </button>
              </div>

                <p class="mb-5 pb-lg-2" style="color: #393f81;">Do you have an account? <a href="<?= BASEURL; ?>/auth" style="color: #393f81;">Login</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>