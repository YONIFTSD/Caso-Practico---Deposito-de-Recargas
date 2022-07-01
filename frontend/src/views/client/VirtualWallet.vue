<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Cliente - Billetera Virtual</strong>
          </CCardHeader>
          <CCardBody>
            <b-form id="Form">

              <b-row>
                <b-col md="4">
                  <b-card>
                    <b-row>
                      <b-col md="12" class="bg-primary">
                         <b-row>
                          <b-col class="py-2" md="3">
                            <b-img fluid round src="https://cdn-icons-png.flaticon.com/512/149/149071.png"></b-img>
                          </b-col>
                          <b-col class="py-2" md="9">
                            <div class="w-100">
                              <span>{{ client.email}}</span> <br> <br> 
                              <span>ID: {{ client.id_client}}</span>
                            </div>
                          </b-col>
                          <hr class="text-white">
                          <b-col class="text-center py-2" md="6">
                            <span>SALDO PRINCIPAL</span> <br>
                            <strong>{{client.balance}}</strong>
                          </b-col>
                          <b-col class="text-center py-2" md="6">
                            <span>SALDO DEL BONO</span> <br>
                            <strong>0.00</strong>
                          </b-col>
                         </b-row>
                      </b-col>

                      <div class="w-100">
                        <hr>
                      </div>
                      <div class="w-100">
                          <b-button class="form-control text-left" type="button" variant="primary">Mi Billetera</b-button>
                      </div>
                      <div class="w-100">
                          <b-button class="form-control text-left" type="button" variant="default">Mi Perfil</b-button>
                      </div>
                      <div class="w-100">
                          <b-button class="form-control text-left" type="button" variant="default">Mi Apuestas</b-button>
                      </div>

                    </b-row>

                  
                  </b-card>
                </b-col>
                <b-col md="8">
                  <b-card>
                    <b-tabs content-class="mt-3">
                      <b-tab disabled title="Recargar"></b-tab>
                      <b-tab disabled title="Retirar"></b-tab>
                      <b-tab title="Historial de saldo" active>
                          <div class="table-responsive mt-3 height-table">
                            <table class="table table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th width="8%" class="text-center">ID</th>
                                  <th width="12%" class="text-center">M. de Pago</th>
                                  <th width="10%" class="text-center">Referencia</th>
                                  <th width="20%" class="text-center">Banco</th>
                                  <th width="5%" class="text-center">Moneda</th>
                                  <th width="10%" class="text-center">Total</th>
                                  <th width="10%" class="text-center">F. Registro</th>
                     
                                </tr>
                              </thead>
                              <tbody v-for="(item, it) in recharges" :key="it">
                                <tr>
                                  <td class="text-center"> {{ item.id_recharge }}</td>
                                  <td class="text-left"> {{ NamePaymentMethod(item.payment_method) }}</td>
                                  <td class="text-left"> {{ item.payment_reference }}</td>
                                  <td class="text-left"> {{ NameBank(item.bank) }}</td>
                                  <td class="text-center"> {{ item.coin }}</td>
                                  <td class="text-right"> <span class="text-success">{{ item.amount }}</span></td>
                                  <td class="text-center"> {{ item.created_at }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                      </b-tab>
                    </b-tabs>
                  </b-card>
                </b-col>
              </b-row>


            </b-form>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>

    <LoadingComponent :is-visible="isLoading"/>
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
import CodeToName from "@/assets/js/CodeToName";
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
        balance:'',
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

      recharges:[],
    };
  },
  mounted() {
    this.ListCountries();
    this.ViewClient();
    this.HistoryByClient();
  },
  methods: {
    ViewClient,
    ListCountries,
    HistoryByClient,

    NameCommunicationChanel,
     NamePaymentMethod,
     NameBank, 
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

function NameCommunicationChanel(code) {
  return CodeToName.NameCommunicationChanel(code);
}
function NamePaymentMethod(code) {
  return CodeToName.NamePaymentMethod(code);
}
function NameBank(code) {
  return CodeToName.NameBank(code);
}

function HistoryByClient() {

 let me = this;
 let id_client = je.decrypt(me.id_client);
 let url = this.url_base + "recharge/history-client/"+id_client;

 me.isLoading = true;
 axios({
    method: "GET",
    url: url,
    headers: {token: me.token},
  }).then(function (response) {
    
    if (response.data.status == 200) {
      me.recharges = response.data.result;
    }else{
      me.recharges = [];
    }
  
  })
}


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
        me.client.balance = response.data.result.balance;
        
        
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
