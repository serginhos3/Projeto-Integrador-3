<?php

namespace App\Console\Commands;

use App\Models\Pedido;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoAtrasado;
use Carbon\Carbon;

class PedidosStatus extends Command
{
    protected $signature = 'pedido:status';

    protected $description = 'Listar pedidos que estão em aberto há 30 dias ou mais';

    public function handle()
    {
        $dataLimite = Carbon::now()->subDays(30);

        $pedidos = Pedido::join('noivos', 'noivos.id', '=', 'pedidos.idnoivo')
            ->whereNotIn('pedidos.status', ['Concluído', 'Cancelado'])
            ->where('pedidos.updated_at', '<=', $dataLimite)
            ->get();

        if ($pedidos->isEmpty()) {
            $this->info("Nenhum pedido em aberto há mais de 30 dias encontrado.");
            return;
        }

        foreach ($pedidos as $pedido) {
            Mail::to($pedido->email)->send(new PedidoAtrasado($pedido));
            $this->info("E-mail enviado para o pedido ID: {$pedido->id}");
        }
    }
}
