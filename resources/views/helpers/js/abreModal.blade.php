@php
    //$delayInMilliseconds = 1000; //1 second
    $delayInMilliseconds = 1500;

    $dataTables = (isset($dataTables) && '' != $dataTables) ? "\"{$dataTables}\"" : "null" ;

    $selectorDefault = (isset($selectorElement)) ? $selectorElement :  "." ;

@endphp
@if ("inserir" == $tipo)
    $(document).on('click', '{{$selectorDefault}}{{$idModal}}', function(){
        bloquear()

        let cleanHTML = document.querySelector("#{!!$html!!}")
        cleanHTML.innerHTML = ""

        let tipo = $(this).attr('tipo')
    @if(isset($id))
        recuperaModalHtml(tipo,"{!!$id!!}","{{ route("$rota_name") }}","{!!$html!!}", {!!$dataTables!!})
    @else
        recuperaModalHtml(tipo,null,"{{ route("$rota_name") }}","{!!$html!!}", {!!$dataTables!!})
    @endif
        $('#{!!$modal!!}').modal('hide')
        $('#{!!$modal!!}').modal('show')

        {{--setTimeout(function() {--}}
            desbloquear()
        {{--}, {{$delayInMilliseconds}});--}}

    }){{--abre {{$idModal}}--}}
@else
    $(document).on('click', '{{$selectorDefault}}{{$nome_editar}}', function(){
        let cleanHTML = document.querySelector("#{!!$html!!}")
        cleanHTML.innerHTML = ""

        bloquear()
        let id = $(this).val()
        let tipo = $(this).attr('tipo')

        @if (isset($hideList))

            @foreach ($hideList as $h_name)
                $('#{!!$h_name!!}').modal('hide')
            @endforeach

        @endif

        if(id){

            let data = new FormData()
            data.append('id', id)
            data.append('_token', '{{ csrf_token()}}')

            recuperaModalHtml(tipo,id,"{{ route("$rota_name") }}","{{$html}}",{!!$dataTables!!})

            @if(isset($fecharModalAnterior))
                $('#{!!$fecharModalAnterior!!}').modal('hide')
            @endif

            $('#{!!$modal!!}').modal('hide')

            $('#{!!$modal!!}').modal('show')

        } else {
            Swal.fire('Erro!','Algo caboloso aconteceu aqui!','error')
        }

        {{--setTimeout(function() {--}}
            desbloquear()
        {{--}, {{$delayInMilliseconds}});--}}

    }){{--editar {!!$modal!!}--}}
@endif

