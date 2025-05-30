<?php

namespace App\Http\Controllers;

use App\Models\apostas;
use App\Traits\mainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApostasController extends Controller
{
    use mainTrait;

    public function adminApostas()
    {
        $data['apostasTotal'] = apostas::where('status', 1)->count(); // Total de apostas ativas

        $data['qtdApostasUnicas'] = apostas::where('status', 1)
            ->selectRaw('cpf, count(*) as total')
            ->groupBy('cpf')
            ->havingRaw('count(*) = 1')
            ->count(); // Total de apostas únicas (apostas feitas por CPF)

        $data['qtdApostasMultiplos'] = apostas::where('status', 1)
            ->selectRaw('cpf, count(*) as total')
            ->groupBy('cpf')
            ->havingRaw('count(*) > 1')
            ->count(); // Total de apostas múltiplas (apostas feitas por CPF mais de uma vez)

        $data['valorTotalArrecadado'] = apostas::where('status', 1)
            ->sum('valor_aposta'); // Soma do valor de todas as apostas ativas

        $data['valorTotalArrecadado'] = number_format($data['valorTotalArrecadado'], 2, ',', '.'); // Formata o valor para moeda brasileira

        $data['apostas'] = apostas::orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();

        return view('admin.apostas.index', $data);
    }//fim funcao

    public function getModalManagerAposta(Request $request)
    {
        $apostaId = $request->id;

        $dataAposta = apostas::find($apostaId);

        if (!$dataAposta) {
            return $this->error('Aposta não encontrada.', 404);
        }

        $dataModal['id'] = $dataAposta->id;
        $dataModal['nome'] = $dataAposta->nome;
        $dataModal['cpf'] = $dataAposta->cpf;
        $dataModal['timeA'] = $dataAposta->timeA;
        $dataModal['timeB'] = $dataAposta->timeB;
        $dataModal['pri_gol'] = $dataAposta->pri_gol;
        $dataModal['pri_cartao'] = $dataAposta->pri_cartao;
        $dataModal['valor_aposta'] = $dataAposta->valor_aposta;
        $dataModal['created_at'] = $dataAposta->created_at->format('d/m/Y H:i:s');
        $dataModal['status'] = $dataAposta->status;

        $html = (string) view('admin.apostas.modal', $dataModal);

        return $this->modal($html);
    }//fim funcao

    public function updateAposta(Request $request)
    {
        $id = $request->id;
        $timeA = $request->timeA;
        $timeB = $request->timeB;
        $pri_gol = $request->pri_gol;
        $pri_cartao = $request->pri_cartao;

        $dataAposta = apostas::find($id);
        if (!$dataAposta) {
            return $this->error('Aposta não encontrada.', 404);
        }

        $recalcularValorAposta = 15; // Valor base da aposta

        if (null != $pri_gol || '' != $pri_gol || false != $pri_gol) {
            $recalcularValorAposta += 10; // Aposta com previsão de gol
        }
        if (null != $pri_cartao || '' != $pri_cartao || false != $pri_cartao) {
            $recalcularValorAposta += 5; // Aposta com previsão de cartão
        }

        // Atualiza os campos da aposta
        $dataAposta->timeA = $timeA;
        $dataAposta->timeB = $timeB;
        $dataAposta->pri_gol = $pri_gol;
        $dataAposta->pri_cartao = $pri_cartao;
        $dataAposta->valor_aposta = $recalcularValorAposta;
        $dataAposta->save();

        return $this->Success('Aposta atualizada com sucesso!');

    }//fim funcao

    public function deleteAposta(Request $request)
    {
        $id = $request->id;

        $dataAposta = apostas::find($id);
        if (!$dataAposta) {
            return $this->error('Aposta não encontrada.', 404);
        }

        // Marca a aposta como inativa
        $dataAposta->status = 0; // 0 para inativo
        $dataAposta->save();

        return $this->Success('Aposta excluída com sucesso!');
    }//fim funcao
}//fim classe
