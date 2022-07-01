<template>
  <div>
    <CRow>
      <CCol col>
        <CCard>
          <CCardHeader>
            <strong> Modulo de Cliente - Listar</strong>
          </CCardHeader>
          <CCardBody>
            <b-row>
              <b-col sm="12" md="7"></b-col>
              <b-col sm="12" md="1">

              </b-col>
              <b-col sm="6" md="4">
                <b-input-group>
                  <b-form-input type="search" v-model="search" class="form-control"></b-form-input>
                  <b-input-group-append>
                    <b-button variant="primary" @click="ListClient">
                      <b-icon icon="search"></b-icon
                    ></b-button>
                  </b-input-group-append>
                </b-input-group>
              </b-col>
        
            </b-row>

            <div class="table-responsive mt-3 height-table">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th width="3%" class="text-center">#</th>
                    <th width="5%" class="text-center">ID</th>
                    <th width="10%" class="text-center">Documento</th>
                    <th width="35%" class="text-center">Nombre</th>
                    <th width="25%" class="text-center">email</th>
                    <th width="12%" class="text-center">F. Registro</th>
                    <th width="5%" class="text-center">Estado</th>
                    <th width="5%" class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody v-for="(item, it) in data_table" :key="item.id">
                  <tr>
                    <td class="text-center">{{ it + 1 }}</td>
                    <td class="text-left"> {{ item.id_client }}</td>
                    <td class="text-left">{{ CodeDocumentType(item.document_type) +' - '+ item.document_number }}</td>
                    <td class="text-left"> {{ item.name }}</td>
                    <td class="text-left"> {{ item.email }}</td>
                     <td class="text-center"> {{ item.created_at }}</td>
                    <td class="text-center">
                      <b-badge v-if="item.state == 1" variant="success">Activo</b-badge>
                      <b-badge v-if="item.state == 0" variant="danger">Anulado</b-badge>
                    </td>
                    <td class="text-center">
                      <b-dropdown bloque size="sm" text="Acciones" right>
                        <b-dropdown-item  @click="EditClient(item.id_client)">Editar</b-dropdown-item>
                        <b-dropdown-item  @click="ViewClient(item.id_client)">Ver</b-dropdown-item>
                        <b-dropdown-item  @click="VirtualWallet(item.id_client)">Billetera Virtual</b-dropdown-item>
                      </b-dropdown>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <b-row class="mt-4">
              <b-col md="8">
                <b-pagination v-model="currentPage" v-on:input="ListClient" :total-rows="rows" :per-page="perPage" align="center"></b-pagination>
              </b-col>
              <b-col md="4 text-center">
                <p>Pagina Actual: {{ currentPage }}</p>
              </b-col>
            </b-row>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
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
    };
  },
  mounted() {
    this.ListClient();
  },
  methods: {
    CodeDocumentType,
    ListClient,
    EditClient,
    ViewClient,
    VirtualWallet,
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
function CodeDocumentType(code) {
  return CodeToName.NameDocumentType(code);
}

function ListClient() {
  let search = this.search == "" ? "all" : this.search;
  let me = this;
  let url = this.url_base + "client/list/" + search + "?page=" + this.currentPage;
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

function EditClient(id_client) {
  this.$router.push({
    name: "ClientEdit",
    params: { id_client: je.encrypt(id_client) },
  });
}

function ViewClient(id_client) {
  this.$router.push({
    name: "ClientView",
    params: { id_client: je.encrypt(id_client) },
  });
}

function VirtualWallet(id_client) {
  this.$router.push({
    name: "ClientVirtualWallet",
    params: { id_client: je.encrypt(id_client) },
  });
}



</script>
