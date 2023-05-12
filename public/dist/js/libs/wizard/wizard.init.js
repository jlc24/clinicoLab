$(function () {
  ($.fn.stepy.defaults.legend = !1),
    ($.fn.stepy.defaults.transition = "fade"),
    ($.fn.stepy.defaults.duration = 200),
    ($.fn.stepy.defaults.backLabel =
      '<i class="mdi mdi-arrow-left-bold"></i> Atrás'),
    ($.fn.stepy.defaults.nextLabel =
      'Siguiente <i class="mdi mdi-arrow-right-bold"></i>'),
    $("#formulario_materiales").stepy(),
    $("#wizard-clickable").stepy({ titleClick: !0 }),
    $("#wizard-callbacks").stepy({
      next: function (t) {
        alert("Going to step: " + t);
      },
      back: function (t) {
        alert("Returning to step: " + t);
      },
      finish: function () {
        return alert("Submit canceled."), !1;
      },
    }),
    $(".stepy-navigator")
      .find(".button-next")
      .addClass("btn btn-info waves-effect waves-light"),
    $(".stepy-step")
      .find(".button-back")
      .addClass("btn btn-secondary waves-effect float-left");
});
$(function () {
  ($.fn.stepy.defaults.legend = !1),
    ($.fn.stepy.defaults.transition = "fade"),
    ($.fn.stepy.defaults.duration = 200),
    ($.fn.stepy.defaults.backLabel =
      '<i class="mdi mdi-arrow-left-bold"></i> Atrás'),
    ($.fn.stepy.defaults.nextLabel =
      'Siguiente <i class="mdi mdi-arrow-right-bold"></i>'),
    $("#formulario_crear_hoja_familia").stepy(),
    $("#wizard-clickable").stepy({ titleClick: !0 }),
    $("#wizard-callbacks").stepy({
      next: function (t) {
        alert("Going to step: " + t);
      },
      back: function (t) {
        alert("Returning to step: " + t);
      },
      finish: function () {
        return alert("Submit canceled."), !1;
      },
    }),
    $(".stepy-navigator")
      .find(".button-next")
      .addClass("btn btn-purple waves-effect waves-light"),
    $(".stepy-step")
      .find(".button-back")
      .addClass("btn btn-secondary waves-effect float-left");
});
$(function () {
  ($.fn.stepy.defaults.legend = !1),
    ($.fn.stepy.defaults.transition = "fade"),
    ($.fn.stepy.defaults.duration = 200),
    ($.fn.stepy.defaults.backLabel =
      '<i class="mdi mdi-arrow-left-bold"></i> Atrás'),
    ($.fn.stepy.defaults.nextLabel =
      'Siguiente <i class="mdi mdi-arrow-right-bold"></i>'),
    $("#formulario_crear_administrador").stepy(),
    $("#wizard-clickable").stepy({ titleClick: !0 }),
    $("#wizard-callbacks").stepy({
      next: function (t) {
        alert("Going to step: " + t);
      },
      back: function (t) {
        alert("Returning to step: " + t);
      },
      finish: function () {
        return alert("Submit canceled."), !1;
      },
    }),
    $(".stepy-navigator")
      .find(".button-next")
      .addClass("btn btn-purple waves-effect waves-light"),
    $(".stepy-step")
      .find(".button-back")
      .addClass("btn btn-secondary waves-effect float-left");
});
$(function () {
  ($.fn.stepy.defaults.legend = !1),
    ($.fn.stepy.defaults.transition = "fade"),
    ($.fn.stepy.defaults.duration = 200),
    ($.fn.stepy.defaults.backLabel =
      '<i class="mdi mdi-arrow-left-bold"></i> Atrás'),
    ($.fn.stepy.defaults.nextLabel =
      'Siguiente <i class="mdi mdi-arrow-right-bold"></i>'),
    $("#formulario_crear_asignacion").stepy(),
    $("#wizard-clickable").stepy({ titleClick: !0 }),
    $("#wizard-callbacks").stepy({
      next: function (t) {
        alert("Going to step: " + t);
      },
      back: function (t) {
        alert("Returning to step: " + t);
      },
      finish: function () {
        return alert("Submit canceled."), !1;
      },
    }),
    $(".stepy-navigator")
      .find(".button-next")
      .addClass("btn btn-purple waves-effect waves-light"),
    $(".stepy-step")
      .find(".button-back")
      .addClass("btn btn-secondary waves-effect float-left");
});
