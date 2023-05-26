<div class="modal fade" id="exampleModal" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultados del paciente</h5>
                <!-- Botón para cerrar el modal -->
                <button type="button" id="btnClosePdfGenerate" class="close btnClosePdfGenerate" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se inserta el PDF generado -->
                <iframe id="pdfFrame" style="width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>
</div>