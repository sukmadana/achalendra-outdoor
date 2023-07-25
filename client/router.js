import Vue from "vue";
import Router from "vue-router";
import { scrollBehavior } from "~/utils";

Vue.use(Router);

const page = (path) => () =>
  import(`~/pages/${path}`).then((m) => m.default || m);

const routes = [
  { path: "/", name: "welcome", component: page("welcome.vue") },
  { path: "/product", name: "product", component: page("product.vue") },
  { path: "/product/:slug", name: "product.single", component: page("_singleProduct.vue") },
  { path: "/dashboard", name: "dashboard", component: page("user/dashboard.vue") },
  { path: "/profile", name: "profile", component: page("user/profile.vue") },

  { path: "/login", name: "login", component: page("auth/login.vue") },
  { path: "/register", name: "register", component: page("auth/register.vue") },
  {
    path: "/password/reset",
    name: "password.request",
    component: page("auth/password/email.vue"),
  },
  {
    path: "/password/reset/:token",
    name: "password.reset",
    component: page("auth/password/reset.vue"),
  },
  {
    path: "/email/verify/:id",
    name: "verification.verify",
    component: page("auth/verification/verify.vue"),
  },
  {
    path: "/email/resend",
    name: "verification.resend",
    component: page("auth/verification/resend.vue"),
  },

  { path: "/home", name: "home", component: page("home.vue") },
  { path: "/admin", name: "admin.home", component: page("admin/index.vue") },
  {
    path: "/admin/category",
    name: "admin.category",
    component: page("admin/category/index.vue"),
  },
  {
    path: "/admin/product",
    name: "admin.product",
    component: page("admin/product/index.vue"),
  },
  {
    path: "/admin/product/image/:slug",
    name: "admin.product.image",
    component: page("admin/product/imageControll.vue")
  },
  {
    path: "/admin/product/edit/:slug",
    name: "admin.product.edit",
    component: page("admin/product/editProduct.vue")
  },
  {
    path: "/admin/product/add",
    name: "admin.product.add",
    component: page("admin/product/newProduct.vue"),
  },
  {
    path: "/settings",
    component: page("settings/index.vue"),
    children: [
      { path: "", redirect: { name: "settings.profile" } },
      {
        path: "profile",
        name: "settings.profile",
        component: page("settings/profile.vue"),
      },
      {
        path: "password",
        name: "settings.password",
        component: page("settings/password.vue"),
      },
    ],
  },
];

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: "history",
  });
}
