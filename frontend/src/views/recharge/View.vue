<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Recargas - Ver</strong>
          </CCardHeader>
          <CCardBody>
            <b-form id="Form" @submit.prevent="Validate">
              <b-row>

                <b-col md="2">
                  <b-form-group label="Nro Recarga:">
                    <b-form-input class="text-center" disabled v-model="recharge.code"></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group>
                    <label>Cliente: </label>
                    <v-select  disabled placeholder="Seleccione un cliente" class="w-100" :filterable="false" label="full_name" v-model="client" @search="SearchClients" :options="clients"></v-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Fecha:">
                    <b-form-input disabled class="text-center" type="date" v-model="recharge.date" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Medio de Comunicación:">
                    <b-form-select disabled :options="communication_channel" v-model="recharge.communication_channel" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Medio de Pago:">
                    <b-form-select disabled :options="payment_method" v-model="recharge.payment_method" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Referencia:">
                    <b-form-input disabled v-model="recharge.payment_reference" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="4">
                  <b-form-group label="Banco:">
                    <b-form-select disabled :options="bank" v-model="recharge.bank" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Moneda:">
                    <b-form-select disabled :options="coin" v-model="recharge.coin" ></b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="2">
                  <b-form-group label="Monto:">
                    <b-form-input disabled v-model="recharge.amount" ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="9">
                  <b-form-group label="Observación:">
                    <b-form-textarea disabled rows="2" v-model="recharge.observation" ></b-form-textarea>
                  </b-form-group>
                </b-col>

                <b-col md="3">
                  <b-form-group label="Cambiar Voucher: ">
                    <b-form-file disabled @change="PreviewImage" accept="image/*" v-model="file" placeholder="Seleccione un foto..." drop-placeholder="Suelta la imagen aquí..."></b-form-file>
                  </b-form-group>
                </b-col>
          
         

                <b-col md="4"></b-col>
                <b-col md="2">
                    <b-button :disabled="recharge.file.length == 0" type="button" class="form-control" variant="warning" v-b-modal.modal-1><i class="fas fa-eye"></i> Ver Voucher</b-button>
                </b-col>
                <b-col md="2">
                  <b-link class="btn form-control btn-primary" :to="{ path: '/recargas/listar' }" append >REGRESAR</b-link>
                </b-col>
              </b-row>
            </b-form>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <LoadingComponent :is-visible="isLoading"/>
    <Keypress key-event="keyup" :key-code="115" @success="Validate" />
    <b-modal hide-footer id="modal-1" title="Voucher">
      <b-col class="text-center" md="12">
        <b-img class="img-fluid text-center" fluid :src="url_base + recharge.file"></b-img>
      </b-col>
    </b-modal>
  </div>
</template>

<script>
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
import "vue-select/src/scss/vue-select.scss";

const axios = require("axios").default;
const Swal = require("sweetalert2");
const je = require("json-encrypt");
var moment = require("moment");
import { mapState } from "vuex";
import ApiQuery from "@/assets/js/APIQuery";
import LoadingComponent from './../pages/Loading'
export default {
  name: "UsuarioAdd",
  props: ["id_recharge"],
  components:{
    vSelect,
    Keypress: () => import('vue-keypress'),
      LoadingComponent,
  },
  data() {
    return {
      isLoading: false,
      module:'Recharge',
      clients:[],
      client:null,
      recharge: {
        id_recharge: "",
        id_client: "",
        id_user: "",
        code: "",
        date: moment(new Date()).local().format("YYYY-MM-DD"),
        communication_channel: "",
        payment_method: "",
        payment_reference: "",
        bank: "",
        file: "",
        file_change: "",
        observation: "",
        coin: "PEN",
        amount: "0.00",
        state: 1,
      },
      previewImage: 'https://loisjeans.id/skin/frontend/base/default/images/catalog/product/placeholder/image.jpg',
      file:null,
      communication_channel: [
        {value:'', text:'-- Seleccione una opción --'},
        {value:'01', text:'Whatssap'},
        {value:'02', text:'Telegram'},
      ],
      payment_method: [
        {value:'', text:'-- Seleccione una opción --'},
        {value:'01', text:'Pago Efectivo'},
        {value:'02', text:'Niubiz'},
        {value:'03', text:'AStroPay'},
        {value:'04', text:'Transfencia Bancaria'},
        {value:'05', text:'Yape'},
        {value:'06', text:'Plin'},
      ],
      bank:[
        {value:'', text:'-- Seleccione una opción --'},
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
        {value:'PEN', text:'Soles'},
        {value:'USD', text:'Dólares'},
      ],
      //errors
      errors: {
        id_client: false,
        code: false,
        date: false,
        communication_channel: false,
        payment_method: false,
        bank: false,
        coin: false,
        amount: false,
      },
      validate: false,
    };
  },
  mounted() {
    this.ViewRecharge();
  },
  methods: {
    ViewRecharge,
    EditRecharge,
    Validate,
    
    ViewVoucher,
    SearchClients,
    PreviewImage,
  },

  computed: {
    
    ...mapState(["url_base"]),
    user: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user;
    },
    token: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user.api_token;
    },
  },
};

function ViewVoucher() {
  
}

function ViewRecharge() {
  let me = this;
  let id_recharge = je.decrypt(me.id_recharge);
  let url = me.url_base + "recharge/view/"+id_recharge;
  axios({
    method: "GET",
    url: url,
    headers: { "Content-Type": "application/json", token: me.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        me.recharge.id_recharge = response.data.result.id_recharge;
        me.recharge.id_client = response.data.result.id_client;
        me.recharge.id_user = response.data.result.id_user;
        me.recharge.code = response.data.result.code;
        me.recharge.date = response.data.result.date;
        me.recharge.communication_channel = response.data.result.communication_channel;
        me.recharge.payment_method = response.data.result.payment_method;
        me.recharge.payment_reference = response.data.result.payment_reference;
        me.recharge.bank = response.data.result.bank;
        me.recharge.file = response.data.result.file;
        me.recharge.observation = response.data.result.observation;
        me.recharge.coin = response.data.result.coin;
        me.recharge.amount = response.data.result.amount;
        me.recharge.state = response.data.result.state;
        me.client = {id:response.data.result.id_client,full_name:response.data.result.name+" - "+response.data.result.document_number};
      }
    })
    .catch((error) => {
      console.log(error)
      Swal.fire({ icon: 'error', text: 'A ocurrido un error', timer: 3000,})
    });
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

function PreviewImage(event) {
  var input = event.target;
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = (e) => {
          this.previewImage = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
  }
  this.recharge.file_change = input.files[0];
}


function EditRecharge() {

  let me = this;
  let url = me.url_base + "recharge/edit";

  let data = new FormData();
  data.append("id_recharge", this.recharge.id_recharge);
  data.append("id_client", this.client.id);
  data.append("id_user", this.user.id_user);
  data.append("code", this.recharge.code);
  data.append("date", this.recharge.date);
  data.append("communication_channel", this.recharge.communication_channel);
  data.append("payment_method", this.recharge.payment_method);
  data.append("payment_reference", this.recharge.payment_reference);
  data.append("bank", this.recharge.bank);
  data.append("file", this.recharge.file_change);
  data.append("observation", this.recharge.observation);
  data.append("coin", this.recharge.coin);
  data.append("amount", this.recharge.amount);
  data.append("state", this.recharge.state);
  me.isLoading = true;

  axios({
    method: "POST",
    url: url,
    data: data,
    headers: { "Content-Type": "application/json", token: me.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        
        me.file = response.data.result.file;
        me.file_change = null;
        Swal.fire({ icon: 'success', text: response.data.message, timer: 3000,})
     
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

function Validate() {


  this.validate = false;
  this.errors.id_client = this.client == null ? true : false;
  this.errors.id_user = this.user.id_user.length == 0 ? true : false;
  this.errors.code = this.recharge.code.length == 0 ? true : false;
  this.errors.date = this.recharge.date.length == 0 ? true : false;
  this.errors.communication_channel = this.recharge.communication_channel.length == 0 ? true : false;
  this.errors.payment_method = this.recharge.payment_method.length == 0 ? true : false;
  this.errors.payment_reference = this.recharge.payment_reference.length == 0 ? true : false;
  this.errors.bank = this.recharge.bank.length == 0 ? true : false;
  this.errors.coin = this.recharge.coin.length == 0 ? true : false;
  this.errors.amount = this.recharge.amount.length == 0 ? true : false;
  if (this.errors.amount) {
    this.errors.amount = parseFloat(this.recharge.amount) <= 0 ? true : false;
  }


  if (this.errors.id_client) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.id_user) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.code) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.date) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.communication_channel) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.payment_method) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.payment_reference) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.bank) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.coin) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }
  if (this.errors.amount) { this.validate = true; Swal.fire({ icon: 'warning', text: 'Verifique que campos necesarios esten llenados', timer: 2000,}); return false;}else{ this.validate = false; }

  if (!this.validate) {
    Swal.fire({
      title: "Esta seguro de modificar la recarga?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Estoy de acuerdo!",
    }).then((result) => {
      if (result.value) {
        this.EditRecharge();
      }
    });

  }

}
</script>
