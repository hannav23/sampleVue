<div id="app">
    
    <nav class="navbar navbar-light navbar-right">
        <form class="form-inline" v-if="!lastPage">
          <button class="btn mr-3" type="button">Login</button>
          <button @click="showSignIn()" class="btn" type="button">Apply</button>
        </form>
        <form class="form-inline" v-else>
            <button @click="reload()" class="btn" type="button">Back</button>
        </form>
      </nav>
    
    <div class="container" v-if="!isSubmitted && show">
      <form>
        <div class="form-group row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <h1>Signup</h1>
            <hr>
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" class="form-control" v-model="userData.firstName">
              <div v-if="!userData.firstName" class="alert alert-danger" role="alert">
                First Name required!
              </div>
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" class="form-control" v-model="userData.lastName">
              <div v-if="!userData.lastName" class="alert alert-danger" role="alert">
                Last Name required!
              </div>
            </div>
            <div class="form-group">
              <label for="email">Mail</label>
              <input type="text" id="email" class="form-control" v-model="userData.email">
              <div v-if="validEmail" class="alert alert-danger" role="alert">
                Email not valid!
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" class="form-control" v-model="userData.password">
              <div v-if="validPass" class="alert alert-danger" role="alert">
                Password must be greater than 5 characters!
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row" v-if="!isSubmitted">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <button class="btn btn-primary" @click.prevent="submitted">Submit!
            </button>
          </div>
        </div>
      </form>
      <hr>
    </div>

    <div class="col text-center justify-content-center align-self-center" v-if="isSubmitted && !lastPage">
        <div>
            <h2 class="font-weight-bold mt-2">Verify Email</h2>
            <i data-feather="mail" height="15%" width="15%" color="black"> </i>

        <h4>A verification email has been sent</h4>
        <p>A verification code has been sent to your email.</p>

        <span>Please click on the link in the email sent to <b>@{{userData.email}}</b></span>
        <hr>
        <p>For improved security, your verification code will expire after 6 hours. If it's expired, you will be redirected to send the request again.</p>

        {{-- <p>Please enter the verification code you've received then click verify.</p> --}}

        <input v-model="code" type="text" maxlength="4" @keyup="checkNumber(event)" placeholder="Enter Code" class="input-code">
        <br/>
        <button v-if="time == 0" @click="resend()" type="button" class="btn mt-4 mr-3 resend-btn">RESEND NOW</button>
        <button v-else type="button" class="btn mt-4 mr-3 resend-btn" disabled>SEND NEW CODE in @{{time}}</button>
        <button v-if="code.length == 4" @click="code.length == 4 ? (lastPage = true) : (lastPage = false)" type="button" class="btn mt-4 verify-btn">SUBMIT CODE</button>
        <button v-else type="button" class="btn mt-4 verify-btn" disabled>SUBMIT CODE</button>
        </div>
    </div>

    <div class="welcome" v-if="lastPage">
        @include('login.dashboard')
    </div>
  </div>

  <script>
  feather.replace();

  let  app = new Vue({
    el: '#app',
    data:{
        userData: {
          firstName: '',
          lastName: '',
          email: '',
          password: ''
        },
        validEmail: false,
        validPass: false,
        storeData: 'Yes',
        isSubmitted: false,
        code:'',
        show: false,
        lastPage: false,
        time: 0
    },
    methods: {
      showSignIn(){
        this.show = true;  
      },
      submitted() {
        this.Validate(this.userData.email, this.userData.password);
        
        if(!this.validEmail && !this.validPass){
            this.isSubmitted = true;
        }
        
      },

      Validate(mail, pass) {

        this.validEmail = false;
        this.validPass = false;

        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(mail))){
            this.validEmail = false;
        }else{
            this.validEmail = true;
        }

        if(pass.length < 5){
            this.validPass = true;
        }


        console.log(this.validEmail+' '+this.validPass);
      },

      checkNumber(evt){
        evt = evt ? evt : window.event;
        var charCode = evt.which ? evt.which : evt.keyCode;
        console.log(charCode);
        console.log(this.code);
        
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
            this.code = this.code.slice(0, -1);
            evt.preventDefault();
        } else if(isNaN(evt.key)){
            this.code = this.code.slice(0, -1);
            evt.preventDefault();
        }else{
            return this.code;
        }
        
      },

      resend(){
          alert("New code has been sent!");
          if(this.time == 0) {
            this.time = 60;
            this.countDownTimer();
          }
      },

      reload(){
        location.reload();
      },

      countDownTimer() {
            if(this.time > 0) {
                setTimeout(() => {
                    this.time -= 1
                    this.countDownTimer()
                }, 1000)
            }
        }
    }
  });
  </script>