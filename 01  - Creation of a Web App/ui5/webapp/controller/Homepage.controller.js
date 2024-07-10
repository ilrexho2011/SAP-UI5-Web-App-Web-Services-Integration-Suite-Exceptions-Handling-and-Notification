sap.ui.define([
    "sap/ui/core/mvc/Controller",
    "sap/ui/model/json/JSONModel"
], function (Controller, JSONModel) {
    "use strict";

    return Controller.extend("teamprojekt.controller.Homepage", {
        onInit: function () {
            var oView = this.getView();

            // Determine the base URL dynamically
            var baseUrl = window.location.hostname === 'localhost' || window.location.hostname === '192.168.131.99'
                ? 'http://localhost:4000'
                : 'http://185.66.133.203:4000';

            // Fetch data from the Node.js backend
            $.ajax({
                url: baseUrl + "/api/salt",
                method: 'GET',
                success: function (data) {
                    var oModel = new JSONModel();
                    oModel.setData({ salt: data });
                    oView.setModel(oModel, "saltData");
                },
                error: function (error) {
                    console.error("Failed to fetch data", error);
                }
            });
        },
        onSendButtonGoToLoginPagePress: function () {
            var oRouter = sap.ui.core.UIComponent.getRouterFor(this);
            oRouter.navTo("Loginpage");
        }
    });
});
