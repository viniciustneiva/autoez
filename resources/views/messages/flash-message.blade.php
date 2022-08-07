@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block" id="alert-message">
        <button type="button" class="close btn" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block" id="alert-message">
        <button type="button" class="close btn" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block" id="alert-message">
        <button type="button" class="close btn" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block" id="alert-message">
        <button type="button" class="close btn" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" id="alert-message">
        <button type="button" class="close btn" data-dismiss="alert">×</button>
        Não foi possível realizar esta operação!
    </div>
@endif
