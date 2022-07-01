<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Reporte - Recargas Anuladas</strong>
          </CCardHeader>
          <CCardBody>
            <b-form id="Form" @submit.prevent="SearchReport">
              <b-row>

                <b-col md="6">
                  <b-form-group>
                    <label>Cliente: </label>
                    <v-select placeholder="Seleccione un cliente" class="w-100" :filterable="false" label="full_name" v-model="client" @search="SearchClients" :options="clients"></v-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Usuario:">
                    <b-form-select type="text" :options="users" v-model="report.id_user" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Desde:">
                    <b-form-input type="date" v-model="report.from" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Hasta:">
                    <b-form-input type="date" v-model="report.to" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Medio de Comunicación:">
                    <b-form-select :options="communication_channel" v-model="report.communication_channel" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Medio de Pago:">
                    <b-form-select :options="payment_method" v-model="report.payment_method" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Banco:">
                    <b-form-select :options="bank" v-model="report.bank" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Moneda:">
                    <b-form-select :options="coin" v-model="report.coin" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label=".">
                    <b-button type="submit" class="form-control" variant="primary">Buscar</b-button>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label=".">
                    <b-button @click="Excel" type="button" class="form-control" variant="success">Excel</b-button>
                  </b-form-group>
                </b-col>
              

          
              </b-row>
            </b-form>

            <div class="table-responsive mt-3 height-table">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="3%" class="text-center">#</th>
                    <th width="5%" class="text-center">ID</th>
                    <th width="30%" class="text-center">Cliente</th>
                    <th width="8%" class="text-center">M. de Comunicación</th>
                    <th width="8%" class="text-center">M. de Pago</th>
                    <th width="8%" class="text-center">Referencia</th>
                    <th width="8%" class="text-center">Banco</th>
                    <th width="5%" class="text-center">Moneda</th>
                    <th width="5%" class="text-center">Total</th>
                    <th width="10%" class="text-center">F. Registro</th>
                    <th width="8%" class="text-center">Usuario</th>
                    <th width="5%" class="text-center">Motivo</th>
                  </tr>
                </thead>
                <tbody v-for="(item, it) in data_table" :key="it">
                  <tr>
                    <td class="text-center">{{ it + 1 }}</td>
                    <td class="text-center"> {{ item.id_recharge }}</td>
                    <td class="text-left">{{ item.name +' - '+ item.document_number }}</td>
                    <td class="text-left"> {{ NameCommunicationChanel(item.communication_channel) }}</td>
                    <td class="text-left"> {{ NamePaymentMethod(item.payment_method) }}</td>
                    <td class="text-left"> {{ item.payment_reference }}</td>
                    <td class="text-left"> {{ NameBank(item.bank) }}</td>
                    <td class="text-center"> {{ item.coin }}</td>
                    <td class="text-right"> {{ item.amount }}</td>
                    <td class="text-center"> {{ item.created_at }}</td>
                    <td class="text-left"> {{ item.user }}</td>
                    <td class="text-left"> {{ item.reason_cancellation }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            
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
var moment = require("moment");

const axios = require("axios").default;
const Swal = require("sweetalert2");
const je = require("json-encrypt");
import { mapState } from "vuex";
import CodeToName from "@/assets/js/CodeToName";
import LoadingComponent from './../pages/Loading'

export default {
  name: "UsuarioList",
  components:{
    vSelect,
    LoadingComponent,
  },
  data() {
    return {
      isLoading:false,
      clients:[],
      client:null,
      report:{
        id_client:'all',
        id_user:'all',
        from:moment(new Date()).local().format("YYYY-MM-DD"),
        to:moment(new Date()).local().format("YYYY-MM-DD"),
        code:'',
        communication_channel:'all',
        payment_method:'all',
        bank:'all',
        coin:'all',
      },
      communication_channel: [
        {value:'all', text:'-- Todos --'},
        {value:'01', text:'Whatssap'},
        {value:'02', text:'Telegram'},
      ],
      payment_method: [
        {value:'all', text:'-- Todos --'},
        {value:'01', text:'Pago Efectivo'},
        {value:'02', text:'Niubiz'},
        {value:'03', text:'AStroPay'},
        {value:'04', text:'Transfencia Bancaria'},
        {value:'05', text:'Yape'},
        {value:'06', text:'Plin'},
      ],
      bank:[
        {value:'all', text:'-- Todos --'},
        {value: '001', text : 'BANCO CENTRAL DE RESERVA DEL PERU'},
        {value: '002', text : 'BANCO DE CREDITO DEL PERU'},
        {value: '003', text : 'BANCO INTERNACIONAL DEL PERU'},
        {value: '005', text : 'BANCO LATINO'},
        {value: '007', text : 'BANCO CITIBANK N.A.'},
        {value: '008', text : 'BANCO STANDARD CHARTERED'},
        {value: '009', text : 'BCO.SCOTIABANK PERU SAA (ANTES WIESE SUDAMERIS)'},
        {value: '011', text : 'BANCO CONTINENTAL'},
        {value: '018', text : 'BANCO DE LA NACION'},
        {value: '023', text : 'BANCO COMERCIO'},
        {value: '026', text : 'BANCO NORBANK'},
        {value: '037', text : 'BANCO DEL PROGRESO'},
        {value: '038', text : 'BANCO INTERAMERICANO DE FINANZAS'},
        {value: '041', text : 'BANCO SUDAMERICANO'},
        {value: '043', text : 'BANCO DEL TRABAJO'},
        {value: '044', text : 'BANCO SOLVENTA'},
        {value: '045', text : 'BANCO SERBANCO'},
        {value: '046', text : 'BANK BOSTON N.A. SUCURSAL DEL PERU'},
        {value: '047', text : 'ORION CORPORACION DE CREDITO'},
        {value: '048', text : 'BANCO NUEVO PAIS'},
        {value: '049', text : 'MIBANCO'},
        {value: '050', text : 'BANQUE NATIONALE DE PARIS - ANDES S.A.'},
        {value: '053', text : 'BANCO HSBC'},
        {value: '056', text : 'BANCO SANTANDER PERU S.A.'},
        {value: '071', text : 'CORPORACION FINANCIERA DE DESARROLLO - COFIDE'},
        {value: '083', text : 'SOLUCION - FINANCIERA DE CREDITO DEL PERU'},
        {value: '086', text : 'FINANDAEWOO S.A.'},
        {value: '087', text : 'FINANCIERA C.M.R.'},
        {value: '088', text : 'VOLVO FINANCE PERU'},
        {value: '089', text : 'FINANCIERA CORDILLERA S.A.'},
        {value: '091', text : 'GENERALI PERU CIA. SEGUROS'},
        {value: '092', text : 'LA VITALICIA'},
        {value: '093', text : 'REASEGURADORA PERUANA'},
        {value: '094', text : 'SEGUROS LA FENIX PERUANA'},
        {value: '095', text : 'SECREX  CIA. SEGUROS'},
        {value: '099', text : 'OTROS'},
      ],
      coin:[
        {value:'all', text:'-- Todos --'},
        {value:'PEN', text:'Soles'},
        {value:'USD', text:'Dólares'},
      ],
      users:[],
      data_table:[],


    };
  },
  mounted() {
    this.ListUsers();
  },
  methods: {
     ListUsers,
     SearchClients,
     Validate,
     SearchReport,
     Excel,

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
    user: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user;
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

function ListUsers() {
  
   let me = this;
  let url = this.url_base + "user/list-active";
   
    axios({
      method: "GET",
      url: url,
      headers: {token: this.token},
    }).then(function (response) {
      me.users = [{value:'all',text:'-- Todos --'}];

      for (let index = 0; index < response.data.result.length; index++) {
        const element = response.data.result[index];
        me.users.push({value:element.id_user,text: element.user});
        
      }
        
    })
    
}

function SearchClients(search, loading) {
  
   let me = this;
    let url = this.url_base + "client/search-clients/" + search;
    if (search !== "") {
      loading(true);
      axios({
        method: "GET",
        url: url,
        headers: {token: this.token},
      }).then(function (response) {
            me.clients = response.data;
            loading(false);
      })
    }
}

function Validate() {
  
}

function SearchReport() {
   
  let me = this;
  let url = this.url_base + "report/recharge-cancel";
  this.report.id_client = this.client == null ? 'all':this.client.id;
  let data = this.report;
  axios({
    method: "POST",
    url: url,
    data: data,
    headers: {token: this.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        me.data_table = response.data.result;
      } else {
        Swal.fire({ icon: 'error', text: response.data.message, timer: 3000,})
      }
    })
    .catch((error) => {
      Swal.fire({ icon: 'error', text: 'A ocurrido un error', timer: 3000,})
    });
}

function Excel() {
  let me = this;
  me.report.id_client = this.client == null ? 'all':this.client.id;
  let url = this.url_base + "excel-recharge-cancel/"+ this.report.id_client+"/"+ this.report.id_user+"/"+ 
  this.report.from+"/"+ this.report.to+"/"+this.report.communication_channel +"/"+ this.report.payment_method 
  +"/"+ this.report.bank+"/"+ this.report.coin;
  window.open(url,'_blank');
}




</script>
