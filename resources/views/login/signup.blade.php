<div id="app">
    <div class="container" v-if="!isSubmitted">
      <form>
        <div class="form-group row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <h1>Signup</h1>
            <hr>
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" class="form-control" v-model="userData.firstName">
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" class="form-control" v-model="userData.lastName">
            </div>
            <div class="form-group">
              <label for="email">Mail</label>
              <input type="text" id="email" class="form-control" v-model="userData.email">
              <div v-if="!valid" class="alert alert-danger" role="alert">
                Email not valid!
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" class="form-control" v-model="userData.password">
              {{-- <p>
                @{{ userData.password }}
              </p> --}}
            </div>
            {{-- <div class="row">
              <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 form-group">
                <label for="yes">
                  <input type="radio" id="yes" value="Yes" v-model="storeData"> Yes
                </label>
                <label for="no">
                  <input type="radio" id="no" value="No" v-model="storeData"> No
                </label>
              </div>
            </div> --}}
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
      {{-- <div class="row" v-if="isSubmitted">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Your Data</h4>
            </div>
            <div class="panel-body">
              <p>Full Name: @{{ userData.firstName }} @{{ userData.lastName }}</p>
              <p>Mail: @{{ userData.email }}</p>
              <p>Password: @{{ userData.password }}</p>
              <p>Store in Database?: @{{ storeData }}</p>
            </div>
          </div>
        </div>
      </div> --}}
    </div>

    <div class="col text-center justify-content-center align-self-center" v-if="isSubmitted">
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
        <button type="button" class="btn mt-4 mr-3 resend-btn">RESEND NOW</button>
        <button type="button" class="btn mt-4 verify-btn">SUBMIT CODE</button>
        </div>
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
        valid: true,
        storeData: 'Yes',
        isSubmitted: false,
        code:''
    },
    methods: {
      submitted() {
        this.ValidateEmail(this.userData.email);
        console.log(this.valid);
        if(this.valid){
            this.isSubmitted = true;
        }
        
      },

      ValidateEmail(mail) {

        this.valid = false;

        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(mail))){
            this.valid = true;
        }
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
        
      }
    }
  });
  </script>