<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Cliente - Ver</strong>
          </CCardHeader>
          <CCardBody>
            <b-form id="Form" @submit.prevent="Validate">
              <b-row>

                <b-col md="2">
                  <b-form-group label="Player ID:">
                    <b-form-input class="text-center" disabled  v-model="client.id_client"></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Tipo de Documento:">
                    <b-form-select disabled v-model="client.document_type" :options="document_type"></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="3">
                  <b-form-group label="Nro Documento:">
                    <b-input-group>
                      <b-form-input disabled v-model="client.document_number" class="form-control" ></b-form-input>
                    </b-input-group>
                  </b-form-group>
                </b-col>
         
                <b-col md="5">
                  <b-form-group label="Nombres:">
                    <b-form-input type="text" disabled v-model="client.name"></b-form-input>
                  </b-form-group>
                </b-col>
      
                <b-col md="2">
                  <b-form-group label="Pais:">
                    <b-form-select disabled v-model="client.country" @change="ListCities" :options="contries"></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="3">
                  <b-form-group label="Ciudad:">
                    <b-form-input disabled v-model="client.city"></b-form-input>
                  </b-form-group>
                </b-col>
                
                <b-col md="5">
                  <b-form-group label="Dirección:">
                    <b-form-input disabled type="text" v-model="client.address" ></b-form-input>
                  </b-form-group>
                </b-col>

                 <b-col md="2">
                  <b-form-group label="Teléfono:">
                    <b-form-input disabled type="text" ref="phone" v-model="client.phone" placeholder="Ingrese su Telefono"></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Fecha Nacimiento:">
                    <b-form-input disabled type="date" v-model="client.date_of_birth" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Sexo:">
                    <b-form-select disabled v-model="client.sex" :options="sex"></b-form-select>
                  </b-form-group>
                </b-col>
      

                <b-col md="4">
                  <b-form-group label="Email:">
                    <b-form-input type="email" disabled v-model="client.email"></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Fecha Registro:">
                    <b-form-input type="text" class="text-center" disabled v-model="client.created_at"></b-form-input>
                  </b-form-group>
                </b-col>
       
                <b-col md="2">
                  <b-form-group label="Estado:">
                    <b-form-select disabled v-model="client.state" :options="state"></b-form-select>
                  </b-form-group>
                </b-col>
           
                <b-col md="5"></b-col>
                <b-col md="2">
                  <b-link class="btn form-control btn-primary" :to="{ path: '/cliente/listar' }" append >REGRESAR</b-link>
                </b-col>
              </b-row>
            </b-form>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>

    <LoadingComponent :is-visible="isLoading"/>
    <Keypress key-event="keyup" :key-code="115" @success="Validate" />
  </div>
</template>

<script>
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
import "vue-select/src/scss/vue-select.scss";


const axios = require("axios").default;
const Swal = require("sweetalert2");
const je = require("json-encrypt");
import { mapState } from "vuex";
import ApiQuery from "@/assets/js/APIQuery";
import LoadingComponent from './../pages/Loading'

export default {
  name: "ClientEdit",
  props: ["id_client"],
  components:{
    vSelect,
    Keypress: () => import('vue-keypress'),
      LoadingComponent,
  },
  
  data() {
    return {
      module:'Client',
      isLoading: false,
      client: {
        id_client: "",
        document_type: "1",
        document_number: "",
        name: "",
        country: "PE",
        ubigee: "",
        address: "",
        phone: "",
        created_at: "",
        email: "",
        city: "",
        sex: "",
        date_of_birth: "",
        state: 1,
      },

      mubigee:null,
      ubigee: [],
      contries: [],
      cities: [],
      document_type: [
        {value: 1 , text : 'DNI'},
        {value: 6 , text : 'RUC'},
        {value: 4 , text : 'CARNET DE EXTRANJERIA'},
        {value: 7 , text : 'PASAPORTE'},
        {value: 0 , text : 'OTROS'},
      ],
      sex: [
        {value: '' , text : 'Seleccione un sexo'},
        {value: 'H' , text : 'Hombre'},
        {value: 'M' , text : 'Mujer'},
      ],
      state:[
        {value: 1 , text : 'Activo'},
        {value: 0 , text : 'Inactivo'},
      ],
      //errors
      errors: {
        document_type: false,
        document_number: false,
        name: false,
      },

      error_document_number:'',
      validate: false,
    };
  },
  mounted() {
    this.ListCountries();
    this.ViewClient();
  },
  methods: {
    ViewClient,
    ListCountries,
  },

  computed: {
    ...mapState(["url_base"]),
    token: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user.api_token;
    },
  },
};

function ListCountries() {
 let url = this.url_base + "list-countries";
 let me = this;
 me.isLoading = true;
 axios({
    method: "GET",
    url: url,
  }).then(function (response) {
    for (let index = 0; index < response.data.length; index++) {
    const element = response.data[index];
    me.contries.push({value:element.code,text:element.name})
  }
  })
}

function ViewClient() {
  let me = this;
  let id_client = je.decrypt(me.id_client);
  let url = me.url_base + "client/view/" + id_client;
  axios({
    method: "GET",
    url: url,
    headers: {token: me.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        me.client.id_client = response.data.result.id_client;
        me.client.document_type = response.data.result.document_type;
        me.client.document_number = response.data.result.document_number;
        me.client.name = response.data.result.name;
        me.client.country = response.data.result.country;
        me.client.phone = response.data.result.phone;
        me.client.address = response.data.result.address;
        me.client.email = response.data.result.email;
        me.client.city = response.data.result.city;
        me.client.date_of_birth = response.data.result.date_of_birth;
        me.client.age = response.data.result.age;
        me.client.sex = response.data.result.sex;
        me.client.state = response.data.result.state;
        me.client.created_at = response.data.result.created_at;
        
      } else {
        Swal.fire({ icon: 'error', text: response.data.message, timer: 3000,})
      }
      me.isLoading = false;
    })
    .catch((error) => {
      Swal.fire({ icon: 'error', text: 'A ocurrido un error', timer: 3000,})
      me.isLoading = false;
    });
}
</script>
