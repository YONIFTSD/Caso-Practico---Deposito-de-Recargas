<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Recargas - Listar</strong>
          </CCardHeader>
          <CCardBody>
            <b-row>
              <b-col sm="12" md="6"></b-col>
              <b-col sm="12" md="1">

              </b-col>
              <b-col sm="6" md="4">
                <b-input-group>
                  <b-form-input type="search" v-model="search" class="form-control"></b-form-input>
                  <b-input-group-append>
                    <b-button variant="primary" @click="ListRecharge">
                      <b-icon icon="search"></b-icon
                    ></b-button>
                  </b-input-group-append>
                </b-input-group>
              </b-col>
               <b-col sm="6" md="1">
                <b-link  class="btn form-control btn-primary" :to="{ path: '/recargas/nuevo' }" append><i class="fas fa-file"></i></b-link>
              </b-col>
            </b-row>

            <div class="table-responsive mt-3 height-table">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="3%" class="text-center">#</th>
                    <th width="5%" class="text-center">ID</th>
                    <th width="40%" class="text-center">Cliente</th>
                    <th width="5%" class="text-center">Moneda</th>
                    <th width="8%" class="text-center">Total</th>
                    <th width="12%" class="text-center">F. Registro</th>
                    <th width="8%" class="text-center">Usuario</th>
                    <th width="5%" class="text-center">Estado</th>
                    <th width="5%" class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody v-for="(item, it) in data_table" :key="item.id">
                  <tr>
                    <td class="text-center">{{ it + 1 }}</td>
                    <td class="text-center"> {{ item.id_recharge }}</td>
                    <td class="text-left">{{ item.name +' - '+ item.document_number }}</td>
                    <td class="text-center"> {{ item.coin }}</td>
                    <td class="text-right"> {{ item.amount }}</td>
                     <td class="text-center"> {{ item.created_at }}</td>
                     <td class="text-left"> {{ item.user }}</td>
                    <td class="text-center">
                      <b-badge v-if="item.state == 1" variant="success">Activo</b-badge>
                      <b-badge v-if="item.state == 0" variant="danger">Anulado</b-badge>
                    </td>
                    <td class="text-center">
                      <b-dropdown bloque size="sm" text="Acciones" right>
                        <b-dropdown-item v-if="item.state == 1" @click="EditRecharge(item.id_recharge)">Editar</b-dropdown-item>
                        <b-dropdown-item  @click="ViewRecharge(item.id_recharge)">Ver</b-dropdown-item>
                        <b-dropdown-item v-if="item.state == 1" @click="ModalCancel(item.id_recharge)">Anular</b-dropdown-item>
                      </b-dropdown>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <b-row class="mt-4">
              <b-col md="8">
                <b-pagination v-model="currentPage" v-on:input="ListRecharge" :total-rows="rows" :per-page="perPage" align="center"></b-pagination>
              </b-col>
              <b-col md="4 text-center">
                <p>Pagina Actual: {{ currentPage }}</p>
              </b-col>
            </b-row>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>


    <b-modal size="md" hide-footer v-model="modalCancelRecharge" class="w-100" title="Anular Recarga">
      <b-form id="Form">
        <b-row>
          <b-col md="12">
            <b-form-group label="Motivo:">
              <b-form-textarea rows="3" v-model="cancel_recharge.reason"></b-form-textarea>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row  class="justify-content-md-center mt-3">
          <b-col md="5">
            <b-button type="button" @click="ValidateCancel" class="form-control text-white" variant="danger" > Anular Recarga</b-button>
          </b-col>
        </b-row>
      </b-form>
    </b-modal>


  </div>
</template>

<script>
const axios = require("axios").default;
const Swal = require("sweetalert2");
const je = require("json-encrypt");
import { mapState } from "vuex";
import CodeToName from "@/assets/js/CodeToName";
export default {
  name: "UsuarioList",
  data() {
    return {
      module:'Client',
      perPage: 15,
      currentPage: 1,
      rows: 0,
      search: "",
      data_table: [],
      modalCancelRecharge: false,
      cancel_recharge:{
        id_user:'',
        id_recharge:'',
        reason:'',
      }
    };
  },
  mounted() {
    this.ListRecharge();
  },
  methods: {
    CodeDocumentType,
    ListRecharge,
    EditRecharge,
    ViewRecharge,

    ModalCancel,
    ValidateCancel,
    CancelRecharge,
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
function CodeDocumentType(code) {
  return CodeToName.NameDocumentType(code);
}

function ListRecharge() {
  let search = this.search == "" ? "all" : this.search;
  let me = this;
  let url = this.url_base + "recharge/list/" + search + "?page=" + this.currentPage;
  axios({
    method: "GET",
    url: url,
    headers: {token: this.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        me.rows = response.data.result.total;
        me.data_table = response.data.result.data;
      } else {
        Swal.fire({ icon: 'error', text: response.data.message, timer: 3000,})
      }
    })
    .catch((error) => {
      Swal.fire({ icon: 'error', text: 'A ocurrido un error', timer: 3000,})
    });
}

function EditRecharge(id_recharge) {
  this.$router.push({
    name: "RechargeEdit",
    params: { id_recharge: je.encrypt(id_recharge) },
  });
}

function ViewRecharge(id_recharge) {
  this.$router.push({
    name: "RechargeView",
    params: { id_recharge: je.encrypt(id_recharge) },
  });
}

function ModalCancel(id_recharge) {
  this.cancel_recharge.id_recharge = id_recharge;
  this.cancel_recharge.reason = '';
  this.modalCancelRecharge = true;
}

function ValidateCancel() {
  if (this.cancel_recharge.reason.length == 0) {
    return false;
  }
   Swal.fire({
    title: "Esta seguro de anular la recarga?",
    text: "No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Estoy de acuerdo!",
  }).then((result) => {
    if (result.value) {
      this.CancelRecharge();
    }
  });
}

function CancelRecharge() {
  let me = this;
  let url = this.url_base + "recharge/cancel";
  this.cancel_recharge.id_user = this.user.id_user;
  let data = this.cancel_recharge;
  axios({
    method: "post",
    url: url,
    data: data,
    headers: {token: this.token},
  })
    .then(function (response) {
      if (response.data.status == 200) {
        const index = me.data_table.map(item => item.id_recharge).indexOf(response.data.result.id_recharge);
        me.data_table[index].state = 0;
        me.modalCancelRecharge = false;
        Swal.fire({ icon: 'success', text: response.data.message, timer: 3000,})
      } else {
        Swal.fire({ icon: 'error', text: response.data.message, timer: 3000,})
      }
    })
    .catch((error) => {
      Swal.fire({ icon: 'error', text: 'A ocurrido un error', timer: 3000,})
    });
}

</script>
