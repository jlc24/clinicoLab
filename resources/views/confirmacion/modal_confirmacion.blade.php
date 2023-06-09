<div class="modal fade " id="confirmPassword" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="confirmPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title confirmPasswordLabel" id="confirmPasswordLabel">{{ __('Confirm Password') }}</h5>
                <!-- Botón para cerrar el modal -->
                <button type="button" id="btnCloseConfirmPass" class="close btnCloseConfirmPass" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="rec_id" id="rec_id" class="rec_id">
            <div class="modal-body">
                {{ __('Please confirm your password before continuing.') }}

                <form method="POST" action="{{ route('confirmarPassword') }}" id="form_comfirmar_pass">
                    @csrf
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>