<?php

namespace App\Http\Controllers;

use App\Models\apostas;
use App\Traits\mainTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; // Para validação
class ChampionsController extends Controller
{
    use mainTrait;

    public function getBets()
    {
        // Busca todas as apostas da tabela 'apostas'
        // Você pode ordenar, limitar, etc., se quiser:
        // $bets = Aposta::orderBy('created_at', 'desc')->get();
        $bets = apostas::where('status', 1)->orderBy('created_at', 'desc')->get(); // Pega todas as apostas ativas, ordenadas por data de criação

        // O response()->json() converte a coleção de modelos em um array JSON
        return response()->json($bets);
    }//fm funcao

    public function submitBet(Request $request)
    {

        DB::beginTransaction();

        try {
            // 1. Validação dos dados
            $validator = Validator::make($request->all(), [
                'playerName' => 'required|string|max:255',
                'playerCPF' => 'required|string|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|unique:apostas,cpf', // CPF deve ser único na tabela apostas
                'scoreTeam1' => 'required|integer|min:0',
                'scoreTeam2' => 'required|integer|min:0',
                'firstGoalScorer' => 'nullable|string|max:255',
                'firstCardTeam' => 'nullable|string|max:255',
                // 'firstGoalTime' => 'nullable|integer|min:0|max:120', // Se você quiser habilitar o campo de minuto do gol
            ], [
                'playerName.required' => 'O nome do jogador é obrigatório.',
                'playerCPF.required' => 'O CPF é obrigatório.',
                'playerCPF.regex' => 'O CPF deve estar no formato 000.000.000-00.',
                'scoreTeam1.required' => 'O placar do Time 1 é obrigatório.',
                'scoreTeam1.integer' => 'O placar do Time 1 deve ser um número inteiro.',
                'scoreTeam1.min' => 'O placar do Time 1 não pode ser negativo.',
                'scoreTeam2.required' => 'O placar do Time 2 é obrigatório.',
                'scoreTeam2.integer' => 'O placar do Time 2 deve ser um número inteiro.',
                'scoreTeam2.min' => 'O placar do Time 2 não pode ser negativo.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erros de validação: ' . $validator->errors()->first()
                ], 422); // 422 Unprocessable Entity
            }

            $cpf = preg_replace('/[^0-9]/', '', $request->input('playerCPF'));

            //verfica se CPF já existe na tabela apostas, maximo 3 por cpf
            $apostasCount = apostas::where('cpf', $cpf)->where('status', 1)->count();

            if ($apostasCount >= 3) {
                return $this->error('Você já registrou o máximo de 3 apostas.', 422); // 422 Unprocessable Entity
            }

            $nome = $request->playerName;
            $timeA = $request->scoreTeam1;
            $timeB = $request->scoreTeam2;
            $pri_gol = $request->firstGoalScorer;
            $pri_cartao = $request->firstCardTeam;

            //calcula o valor da aposta
            $valorAposta = 15; // Valor fixo da aposta, você pode mudar isso se necessário

            if(null != $pri_gol || '' != $pri_cartao || false != $pri_gol) {
                $valorAposta += 10; // Aposta com previsão de gol ou cartão
            }

            if(null != $pri_cartao || '' != $pri_cartao || false != $pri_cartao) {
                $valorAposta += 5; // Aposta com previsão de cartão ou gol
            }

            // 2. Criar e salvar a aposta
            $aposta = new apostas();
            $aposta->cpf = $cpf; // Remove pontos e hífens do CPF
            $aposta->nome = $nome;
            $aposta->timeA = $timeA;
            $aposta->timeB = $timeB;
            $aposta->pri_gol = $pri_gol;
            $aposta->pri_cartao = $pri_cartao;
            $aposta->valor_aposta = $valorAposta;

            $aposta->save();

            DB::commit();
            // 3. Calcula o valor da Aposta e Retornar sucesso

            $data['valor_aposta'] = number_format($valorAposta, 2, ',', '.'); // Formata o valor da aposta para o padrão brasileiro

            return $this->Success("Aposta registrada com sucesso!", 200, $data);

        } catch (\Exception $e) {
            DB::rollback();
            // Retornar falha
            return $this->error('Erro interno do servidor ao registrar a aposta.');
        }
    }//fm funcao

    public function getListaDeApostas()
    {
        // Busca todas as apostas da tabela 'apostas'
        // Você pode ordenar, limitar, etc., se quiser:
        // $bets = Aposta::orderBy('created_at', 'desc')->get();
        $data['bets'] = apostas::where('status', 1)->orderBy('created_at', 'desc')->get(); // Pega todas as apostas ativas, ordenadas por data de criação

        // O response()->json() converte a coleção de modelos em um array JSON

    }//fm funcao

}//fm class
