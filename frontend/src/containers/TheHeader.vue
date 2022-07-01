<template>
  <CHeader fixed with-subheader primary>
    <CToggler
      in-header
      class="ml-3 d-lg-none"
      @click="$store.commit('toggleSidebarMobile')"
    />
    <CToggler
      in-header
      class="ml-3 d-md-down-none"
      @click="$store.commit('toggleSidebarDesktop')"
    />
    <CHeaderBrand class="mx-auto d-lg-none" to="/">
    <div class="w-100">

    </div>
     
    </CHeaderBrand>
    <CHeaderNav class="d-md-down-none mr-auto">


    </CHeaderNav>
    <CHeaderNav class="d-md-down-none mr-1">
    <b-badge variant="success">{{user.user}}</b-badge>
    </CHeaderNav>
    <CHeaderNav class="mr-4">
      <TheHeaderDropdownAccnt/>
    </CHeaderNav>

  </CHeader>
</template>

<script>
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'
const je = require("json-encrypt");
const axios = require("axios").default;
import { mapState,mapActions } from "vuex";

export default {
  name: 'TheHeader',
  components: {
    TheHeaderDropdownAccnt
  },
  data() {
    return {
      name_establishment: "",
      name_bussines:""
    };
  },
  methods: {
    
  },
  mounted() {
   

  },
  computed: {
    ...mapState(["url_base"]),
    user: function () {
      let user = window.localStorage.getItem("user");
      user = JSON.parse(JSON.parse(je.decrypt(user)));
      return user;
    },
  },
}



</script>
<style>

</style>