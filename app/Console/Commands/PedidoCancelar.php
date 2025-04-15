<?php

namespace App\Console\Commands;

use App\Mail\PedidoAtrasado;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PedidoCancelar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedido:cancelar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        echo "executando";
        $dataLimite = Carbon::now()->subDays(90);
        $pedidos = Pedido::where('status', '<>', 'Concluído')
            ->where('updated_at', '<=', $dataLimite)
            ->get();

        if ($pedidos->isEmpty()) {
            $this->info("Nenhum pedido encontrado com status diferente de 'Concluído' e atualizado há mais de 90 dias.");
            return;
        }

        foreach ($pedidos as $pedido) {
            Pedido::where('id', $pedido->id)->update(["status" => "Cancelado"]);
        }
    }
}
