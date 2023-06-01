// http://techlaboratory.net/jquery-smartwizard
$(function() {
    // Step show event CLIENTE
    $("#smartwizard_crear_client").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if(stepPosition === 'first') {
            $("#prev-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterClient").css('display', 'none');
        } else if(stepPosition === 'last') {
            $("#next-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterClient").css('display', '');
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            $("#btnRegisterClient").css('display', 'none');
        }

        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard_crear_client').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);
    });

    // Smart Wizard
    $('#smartwizard_crear_client').smartWizard({
        selected: 0,
        // autoAdjustHeight: false,
        theme: 'dots', // basic, arrows, square, round, dots
        transition: {
            animation:'none'
        },
        colors: 'green',
        toolbar: {
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            position: 'bottom', // none/ top/ both bottom
            extraHtml: `<button class="btn btn-success btnRegisterClient" id="btnRegisterClient" style="display: none;">Registrar</button>`
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [],
        lang: { // Language variables for button
            next: 'Siguiente',
            previous: 'Anterior'
        }
    });

    $("#prev-btn-modal").on("click", function() {
        // Navigate previous
        $('#smartwizard_crear_client').smartWizard("prev");
        return true;
    });

    $("#next-btn-modal").on("click", function() {
        // Navigate next
        $('#smartwizard_crear_client').smartWizard("next");
        return true;
    });

    $("#state_selector").on("change", function() {
        $('#smartwizard_crear_client').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    $("#style_selector").on("change", function() {
        $('#smartwizard_crear_client').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    // Step show event MEDICO
    $("#smartwizard_crear_medico").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if(stepPosition === 'first') {
            $("#prev-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterMedico").css('display', 'none');
        } else if(stepPosition === 'last') {
            $("#next-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterMedico").css('display', '');
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            $("#btnRegisterMedico").css('display', 'none');
        }

        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard_crear_medico').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);
    });

    // Smart Wizard
    $('#smartwizard_crear_medico').smartWizard({
        selected: 0,
        // autoAdjustHeight: false,
        theme: 'dots', // basic, arrows, square, round, dots
        transition: {
            animation:'none'
        },
        colors: 'green',
        toolbar: {
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            position: 'bottom', // none/ top/ both bottom
            extraHtml: `<button class="btn btn-success btnRegisterMedico" id="btnRegisterMedico" style="display: none;">Registrar</button>`
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [],
        lang: { // Language variables for button
            next: 'Siguiente',
            previous: 'Anterior'
        }
    });

    $("#prev-btn-modal").on("click", function() {
        // Navigate previous
        $('#smartwizard_crear_medico').smartWizard("prev");
        return true;
    });

    $("#next-btn-modal").on("click", function() {
        // Navigate next
        $('#smartwizard_crear_medico').smartWizard("next");
        return true;
    });

    $("#state_selector").on("change", function() {
        $('#smartwizard_crear_medico').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    $("#style_selector").on("change", function() {
        $('#smartwizard_crear_medico').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });
    // Step show event USUARIO
    $("#smartwizard_crear_usuario").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if(stepPosition === 'first') {
            $("#prev-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterUsuario").css('display', 'none');
        } else if(stepPosition === 'last') {
            $("#next-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterUsuario").css('display', '');
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            $("#btnRegisterUsuario").css('display', 'none');
        }

        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard_crear_usuario').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);
    });

    // Smart Wizard
    $('#smartwizard_crear_usuario').smartWizard({
        selected: 0,
        // autoAdjustHeight: false,
        theme: 'dots', // basic, arrows, square, round, dots
        transition: {
            animation:'none'
        },
        colors: 'green',
        toolbar: {
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            position: 'bottom', // none/ top/ both bottom
            extraHtml: `<button class="btn btn-success btnRegisterUsuario" id="btnRegisterUsuario" style="display: none;">Registrar</button>`
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [],
        lang: { // Language variables for button
            next: 'Siguiente',
            previous: 'Anterior'
        }
    });

    $("#prev-btn-modal").on("click", function() {
        // Navigate previous
        $('#smartwizard_crear_usuario').smartWizard("prev");
        return true;
    });

    $("#next-btn-modal").on("click", function() {
        // Navigate next
        $('#smartwizard_crear_usuario').smartWizard("next");
        return true;
    });

    $("#state_selector").on("change", function() {
        $('#smartwizard_crear_usuario').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    $("#style_selector").on("change", function() {
        $('#smartwizard_crear_usuario').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    //OTRO
    $("#smartwizard_update").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if(stepPosition === 'first') {
            $("#prev-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterMaterial").css('display', 'none');
        } else if(stepPosition === 'last') {
            $("#next-btn").addClass('disabled').prop('disabled', true);
            $("#btnRegisterMaterial").css('display', '');
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            $("#btnRegisterMaterial").css('display', 'none');
        }

        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard_update').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);
    });

    // Smart Wizard Update
    $("#smartwizard_update").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if(stepPosition === 'first') {
            $("#prev-btn").addClass('disabled').prop('disabled', true);
            $("#btnUpdateMaterial").css('display', 'none');
        } else if(stepPosition === 'last') {
            $("#next-btn").addClass('disabled').prop('disabled', true);
            $("#btnUpdateMaterial").css('display', '');
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            $("#btnUpdateMaterial").css('display', 'none');
        }

        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard_update').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);
    });

    $('#smartwizard_update').smartWizard({
        selected: 0,
        // autoAdjustHeight: false,
        theme: 'dots', // basic, arrows, square, round, dots
        transition: {
            animation:'none'
        },
        colors: 'green',
        toolbar: {
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            position: 'bottom', // none/ top/ both bottom
            extraHtml: `<button class="btn btn-success btnUpdateMaterial" id="btnUpdateMaterial" style="display: none;">Actualizar</button>`
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [],
        lang: { // Language variables for button
            next: 'Siguiente',
            previous: 'Anterior'
        }
    });

    $("#prev-btn-modal-update").on("click", function() {
        // Navigate previous
        $('#smartwizard_update').smartWizard("prev");
        return true;
    });

    $("#next-btn-modal-update").on("click", function() {
        // Navigate next
        $('#smartwizard_update').smartWizard("next");
        return true;
    });

    $("#state_selector").on("change", function() {
        $('#smartwizard_update').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

    $("#style_selector").on("change", function() {
        $('#smartwizard_update').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
        return true;
    });

});