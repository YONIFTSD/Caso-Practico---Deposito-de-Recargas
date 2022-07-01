import Vue from "vue";
import Router from "vue-router";
const je = require("json-encrypt");

const TheContainer = () => import("@/containers/TheContainer");
const Dashboard = () => import("@/views/Dashboard");
const Login = () => import("@/views/pages/Login");

const userGuard = (to, from, next) => {
  let user = window.localStorage.getItem("user");
  if (user == null || user == undefined) {
    next("/");
  } else {
    user = JSON.parse(JSON.parse(je.decrypt(user)));
    if (user.api_token.length == 60) {
      next();
    } else {
      let isAuthenticated = false;
      if (!isAuthenticated) next({ name: "Page404" });
    }
  }
};

Vue.use(Router);

export default new Router({
  mode: "hash", // https://router.vuejs.org/api/#mode
  linkActiveClass: "active",
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes(),
});

function configRoutes() {
  return [
    {
      path: "/",
      redirect: "/",
      name: "Login",
      component: {
        render(c) {
          return c("router-view");
        },
      },
      children: [
        {
          path: "/",
          name: "LoginPage",
          component: Login,
        },
      ],
    },
    {
      path: "/inicio",
      redirect: "/inicio/inicio",
      name: "Home",
      component: TheContainer,
      children: [
        {
          path: "inicio",
          name: "Dashboard",
          component: Dashboard,
        },
      ],
    },

    {
      path: "/cliente",
      redirect: "/cliente/listar",
      name: "Client",
      component: TheContainer,
      children: [
        {
          path: "listar",
          name: "ClientList",
          component: () => import("@/views/client/List"),
          beforeEnter: userGuard,
        },
        {
          path: "editar/:id_client",
          name: "ClientEdit",
          component: () => import("@/views/client/Edit"),
          props: true,
          beforeEnter: userGuard,
        },
        {
          path: "ver/:id_client",
          name: "ClientView",
          component: () => import("@/views/client/View"),
          props: true,
          beforeEnter: userGuard,
        },
        {
          path: "billetera/:id_client",
          name: "ClientVirtualWallet",
          component: () => import("@/views/client/VirtualWallet"),
          props: true,
          beforeEnter: userGuard,
        },
      ],
    },

    {
      path: "/recargas",
      redirect: "/recargas/listar",
      name: "Recharge",
      component: TheContainer,
      children: [
        {
          path: "listar",
          name: "RechargeList",
          component: () => import("@/views/recharge/List"),
          beforeEnter: userGuard,
        },
        {
          path: "nuevo",
          name: "RechargeAdd",
          component: () => import("@/views/recharge/Add"),
          beforeEnter: userGuard,
        },
        {
          path: "editar/:id_recharge",
          name: "RechargeEdit",
          component: () => import("@/views/recharge/Edit"),
          props: true,
          beforeEnter: userGuard,
        },
        {
          path: "ver/:id_recharge",
          name: "RechargeView",
          component: () => import("@/views/recharge/View"),
          props: true,
          beforeEnter: userGuard,
        },
      ],
    },
    
    {
      path: "/reporte",
      redirect: "/reporte/recargas",
      name: "Report",
      component: TheContainer,
      children: [
        {
          path: "recargas",
          name: "ReportRecharge",
          component: () => import("@/views/report/Recharge"),
          beforeEnter: userGuard,
        },
        {
          path: "recargas-anuladas",
          name: "ReportRechargeCancel",
          component: () => import("@/views/report/RechargeCancel"),
          beforeEnter: userGuard,
        }
      ],
    },


  ];
}
