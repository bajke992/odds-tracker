<script>

    function flashMessage(message){
        Materialize.toast(message, 5000, 'light-blue lighten-2');
    }
    function flashError(message){
        Materialize.toast(message, 5000, 'red lighten-2');
    }
    function flashWarning(message){
        Materialize.toast(message, 5000, 'amber lighten-2');
    }

    @if(Session::has('message'))
        flashMessage("{!! Session::get('message') !!}");
    @endif

    @if(Session::has('error'))
        flashError("{!! Session::get('error') !!}");
    @endif

    @if(Session::has('warning'))
        flashWarning("{!! Session::get('warning') !!}");
    @endif
</script>