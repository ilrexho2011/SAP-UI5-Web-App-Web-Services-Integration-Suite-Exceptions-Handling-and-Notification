sap.ui.define([
    "sap/ui/core/mvc/Controller",
    "sap/m/MessageToast"
  ], function (Controller, MessageToast) {
    "use strict";
  
    return Controller.extend("teamprojekt.controller.Loginpage", {
      onInit: function () {
        
      },
  
      onLoginUser: function () {
        var username = this.getView().byId("username").getValue();
        var password = this.getView().byId("password").getValue();
  
        if (!username) {
          MessageToast.show("Please enter username.");
          return;
        }
        if (!password) {
          MessageToast.show("Please enter password.");
          return;
        }
  
        $.ajax({
          url: "http://185.66.133.203:4000/login", 
          type: "POST",
          contentType: "application/json",
          data: JSON.stringify({ username, password }),
          success: function (response) {
            if (response.success) {
              MessageToast.show("Login successful");
              window.location.href = "http://185.66.131.203:8081/salt/ui5/webapp/salesorder/index.html";
            } else {
              MessageToast.show("Invalid credentials. Please try again.");
            }
          }.bind(this),
          error: function () {
            MessageToast.show("Error during login. Please try again.");
          }
        });
      },
  
      gotohomepage: function () {
        var oRouter = sap.ui.core.UIComponent.getRouterFor(this);
        oRouter.navTo("Homepage");
      },

      gotoRegisterpage: function() {
          // Get the router instance
          var oRouter = sap.ui.core.UIComponent.getRouterFor(this);
          
          // Navigate to the Homepage route
          oRouter.navTo("Registerpage");
      },
      
      onForgetPassPress: function() {

      }
  });
});
