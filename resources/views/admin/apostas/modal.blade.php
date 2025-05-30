{{-- Este é o conteúdo que sua rota 'get.modal.manager.aposta' PRECISA retornar --}}
<div class="modal-header">
    <h5 class="modal-title text-dark" id="apostaDetailsModalLabel">
        Detalhes da Aposta #{{ $id }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body text-dark">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger float-right" id="btnDeleteAposta" data-id="{{ $id }}">
                <i class="fas fa-trash-alt"></i> Excluir Aposta
            </button>
        </div>
    </div>
    <form id="formUpdateAposta">
        @csrf {{-- Para Laravel, inclua o token CSRF no formulário --}}
        @php
            $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
        @endphp
        <input type="hidden" name="aposta_id" value="{{ $id }}">
        <div class="form-group">
            <label for="modal-nome">Nome:</label>
            <input type="text" class="form-control" id="modal-nome" name="nome" value="{{ old('nome', $nome) }}" disabled>
        </div>
        <div class="form-group">
            <label for="modal-cpf">CPF:</label>
            <input type="text" class="form-control" id="modal-cpf" name="cpf" value="{{ old('cpf', $cpf) }}" disabled>
        </div>
        <div class="form-group">
            <label for="modal-timeA">PSG:</label>
            <input type="number" class="form-control" id="modal-timeA" name="timeA" value="{{ old('timeA', $timeA) }}">
        </div>
        <div class="form-group">
            <label for="modal-timeB">INTER:</label>
            <input type="number" class="form-control" id="modal-timeB" name="timeB" value="{{ old('timeB', $timeB) }}">
        </div>
        <div class="form-group">
            <label for="modal-pri_gol">Primeiro Gol:</label>
            <input type="text" class="form-control" id="modal-pri_gol" name="pri_gol" value="{{ old('pri_gol', $pri_gol) }}">
        </div>
        <div class="form-group">
            <label for="modal-pri_cartao">Primeiro Cartão:</label>
            <input type="text" class="form-control" id="modal-pri_cartao" name="pri_cartao" value="{{ old('pri_cartao', $pri_cartao) }}">
        </div>
         <div class="form-group">
            <label for="modal-valor_aposta">Valor da Aposta:</label>
            <input type="number" step="0.01" class="form-control" id="modal-valor_aposta" name="valor_aposta" disabled value="{{ old('valor_aposta', $valor_aposta) }}">
        </div>
        <div class="form-group">
            <label for="modal-data">Data da Aposta:</label>
            <input type="text" class="form-control" id="modal-data" name="data" value="{{ $created_at }}" disabled>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-custom-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" class="btn btn-custom-primary" value="{{ $id }}" id="btnSalvarAposta">Salvar Alterações</button>
</div>
