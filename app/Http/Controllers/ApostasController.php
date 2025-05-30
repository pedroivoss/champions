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
    }
}
