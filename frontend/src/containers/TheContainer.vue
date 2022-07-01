<template>
  <div class="c-app">

  
    <TheSidebar :style="bg_sidebar"/>
    <CWrapper>
      <TheHeader :style="bg_sidebar"/>
      <div class="c-body">
        <main class="c-main">
          <CContainer fluid>
            <transition name="fade" mode="out-in">
              <router-view :key="$route.path"></router-view>
            </transition>
          </CContainer>
        </main>
      </div>
      <TheFooter/>
    </CWrapper>
    <notifications group="alert" animation-name="v-fade-left" position="top left" :speed="500" />
  
  </div>
</template>

<script>
import TheSidebar from './TheSidebar'
import TheHeader from './TheHeader'
import TheFooter from './TheFooter'
const axios = require("axios").default;
import { mapState } from "vuex";
const je = require("json-encrypt");
export default {
  name: 'TheContainer',
  components: {
    TheSidebar,
    TheHeader,
    TheFooter
  },
  data() {
    return {
      bg_sidebar: "--bg-header : #423C6A; --bg-sidebar : #423C6A; --bg-sidebar-nav-dropdown-toggle : #423C6A; --bg-sidebar-nav-dropdown-items:  #4A46A4; " ,
      business: {
        id_company : '',
        bg_header : '',
        bg_sidebar : '',
        bg_sidebar_nav_dropdown_toggle : '',
        bg_sidebar_nav_dropdown_items : '',
      },
    };
  },
  mounted () {
    this.ViewBusiness();
  },
  methods: {
    ViewBusiness,
  },
computed: {
    ...mapState(["url_base"]),
    token: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user.api_token;
    }
  },

  
}

function ViewBusiness() {
  let me = this;
  let url = me.url_base + "get-business";

  axios({
    method: "GET",
    url: url,
  })
    .then(function (response) {
      if (response.data.status == 200) {
        me.bg_sidebar = "--bg-header : "+response.data.result.bg_header+"; --bg-sidebar : "+response.data.result.bg_sidebar+"; --bg-sidebar-nav-dropdown-toggle : "+response.data.result.bg_sidebar_nav_dropdown_toggle+"; --bg-sidebar-nav-dropdown-items:  "+response.data.result.bg_sidebar_nav_dropdown_items+"; ";
      } 
    })
}
</script>
<style>

table tr td{
  padding: 3px !important;
  vertical-align: middle !important;
  font-size: 13px;
}
table tr th{
  padding: 3px !important;
  vertical-align: middle !important;
  font-size: 13px;
  background-color: #00174F;
  color: #fff;
}
td img{
  max-height: 70px;
}
.height-table{
  min-height: 150px !important;
}
.c-sidebar {
    color: #fff; 
    background: var(--bg-sidebar); 
}
.c-header{
  color: #fff; 
    background: var(--bg-header); 
}
.c-sidebar .c-sidebar-nav-link:hover, .c-sidebar .c-sidebar-nav-dropdown-toggle:hover {
    color: #fff;
    background: var(--bg-sidebar-nav-dropdown-items) !important;
}
.c-sidebar-nav-icon {
  color: #fff !important;
}
.c-sidebar.c-sidebar-minimized .c-sidebar-nav-item:hover > .c-sidebar-nav-link, .c-sidebar.c-sidebar-minimized .c-sidebar-nav-item:hover > .c-sidebar-nav-dropdown-toggle {
    background: var(--bg-sidebar-nav-dropdown-toggle) !important;
}
.c-sidebar.c-sidebar-minimized .c-sidebar-nav > .c-sidebar-nav-dropdown > .c-sidebar-nav-dropdown-items {
    background: var(--bg-sidebar-nav-dropdown-items) !important;
}
.c-sidebar.c-sidebar-minimized .c-sidebar-nav > .c-sidebar-nav-dropdown:hover {
    background: var(--bg-sidebar-nav-dropdown-toggle) !important;
}

.c-sidebar .c-sidebar-brand {
    color: #fff;
    background: var(--bg-header); 
}

div.modal-backdrop {
    opacity: .5;
}
.btn-primary{
    color: #fff !important;
    background-color: #00174F !important;
    border-color: #00174F !important;
}
.btn-primary:hover{
    color: #fff !important;
    background-color: #000 !important;
    border-color: #000 !important;
}
.btn-secondary{
     color: #fff !important;
    background-color: #545b62 !important;
    border-color: #4e555b !important;
}

.btn-success{
  color: #fff !important;
    background-color: #1e7e34 !important;
    border-color: #1c7430 !important;
}

.btn-danger{
     color: #fff !important;
    background-color: #bd2130 !important;
    border-color: #b21f2d !important;
}

.btn-warning{
    color: #212529 !important;
    background-color: #d39e00 !important;
    border-color: #c69500 !important;
}

.btn-info{
 color: #fff !important;
    background-color: #117a8b !important;
    border-color: #10707f !important;
}

.btn-light{
  color: #212529 !important;
    background-color: #dae0e5 !important;
    border-color: #d3d9df !important;
}

.btn-dark{
      color: #fff !important;
    background-color: #1d2124 !important;
    border-color: #171a1d !important;
}

.bg-primary-app{
  background-color: #423C6A !important;
}
</style>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
