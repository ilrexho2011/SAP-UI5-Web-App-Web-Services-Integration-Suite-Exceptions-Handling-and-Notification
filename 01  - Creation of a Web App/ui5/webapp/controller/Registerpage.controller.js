sap.ui.define([
  "sap/ui/core/mvc/Controller",
  "sap/m/MessageToast"
], function (Controller, MessageToast) {
  "use strict";

  return Controller.extend("teamprojekt.controller.Registerpage", {
    onInit: function () {},

    onRegisterUser: function () {
      // Determine the base URL dynamically
      var baseUrl = window.location.hostname === 'localhost' || window.location.hostname === '192.168.131.99'
        ? 'http://localhost:4000'
        : 'http://185.66.133.203:4000';
      
      
      var name = this.getView().byId("name").getValue();
      var surname = this.getView().byId("surname").getValue();
      var ZINN = this.getView().byId("ZINN").getValue();
      var email = this.getView().byId("email").getValue();
      var tel = this.getView().byId("tel").getValue();
      var username = this.getView().byId("username").getValue();
      var password = this.getView().byId("password").getValue();

      if ( !name || !surname || !ZINN || !email || !tel || !username || !password ) {
        MessageToast.show("Please fill in all required fields.");
        return;
      }

      $.ajax({
        url: baseUrl + "/register",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({ name, surname, ZINN, email, tel, username, password }),
        success: function (response) {
          if (response.success) {
            MessageToast.show("Registration successful");
            sap.ui.core.UIComponent.getRouterFor(this).navTo("Loginpage");
          } else {
            MessageToast.show("1. Error during registration. Please try again.");
          }
        }.bind(this),
        error: function () {
          MessageToast.show("2. Error during registration. Please try again.");
        }
      });
    },

    onBackToLogin: function () {
      sap.ui.core.UIComponent.getRouterFor(this).navTo("Loginpage");
    }
  });
});
