<template>
  <div class="c-app flex-row align-items-center">
    <CContainer>

      <CRow class="justify-content-center">
        <CCol md="4">
          <CCardGroup>
            <CCard class="p-4 bg-card">
              <CCardBody>
                <CForm @submit.prevent="Login">
                  
                  <div class="w-100 text-center mb-1">
                    <b-card-img class="img-fluid" style="max-width: 200px;" :src="url_base + business.logo"></b-card-img>
                  </div>
                  <div class="w-100 text-center mt-1">
                    <span>Bienvenido a</span>
                    <h4>{{business.name}}</h4>
                  </div>
                  <div class="w-100 text-center pt-2">
                    <strong class="text-muted">Ingresa a tu cuenta</strong>
                  </div>

            
                  <b-form-group class="mb-1" label="Email :">
                    <b-form-input type="email" v-model="email"></b-form-input>
                  </b-form-group>

                  <b-form-group class="mb-1" label="Contraseña :">
                    <b-form-input type="password" autocomplete="curent-password" v-model="password"></b-form-input>
                  </b-form-group>

                  <CRow>
                    <CCol col="12" class="text-left mt-2">
                      <CButton color="primary" type="submit" class="px-4 w-100">Login</CButton>
                    </CCol>
                    
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>
<style>
.bg-card{
  background-color: #fff !important;
}
</style>
<script>
const axios = require("axios").default;
const Swal = require("sweetalert2");
const je = require('json-encrypt')

import { mapState } from "vuex";


export default {
  name: "Login",
  data() {
    return {
      email: '',
      password: '',
      business: {
        logo:'',
        name:'',
      }
    };
  },
  methods: {
    Login,
    ViewBussiness,
  },
  mounted() {
    this.ViewBussiness();
  },
  computed: {
    ...mapState(["url_base"]),
  },
};

//login
function Login() {
  let me = this;
  let url = this.url_base + "login";

  let data = {
    email: this.email,
    password: this.password,
  };

  axios({
    method: "POST",
    url: url,
    headers: {
      "Content-Type": "application/json",
    },
    data: data,
  }).then(function (response) {
    if (response.data.status == 200) {
      let user = je.encrypt(JSON.stringify(response.data.result.user));
      window.localStorage.setItem( "user",user );
      me.$router.push({ name: "Home"})
      // Swal.fire({ icon: "success", title: "Hola "+response.data.result.user.name+ " "+response.data.result.user.last_name+", Bienvenido al sistema", showConfirmButton: false, timer: 3000,});
    }else{
      Swal.fire({ icon: "error", title: "Datos incorrectos", showConfirmButton: false,timer: 1500,});
    }
  });

}

function ViewBussiness() {
  let me = this;
  let url = this.url_base + "get-business";

  axios({
    method: "GET",
    url: url,
    headers: { token: this.token,},
  })
  .then(function (response) {
    if (response.data.status == 200) {
      me.business.logo = response.data.result.logo;
      me.business.name = response.data.result.name;
    }
  })
}

</script>
