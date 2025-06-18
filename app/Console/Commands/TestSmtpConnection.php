<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



class TestSmtpConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-smtp-connection';

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
    try {
        // Obtém a configuração SMTP
        $config = config('mail.mailers.smtp');
        
        // Cria o transporte manualmente
        $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport(
            $config['host'],
            $config['port'],
            $config['encryption'] === 'tls' ? true : false
        );
        
        // Configura autenticação
        $transport->setUsername($config['username']);
        $transport->setPassword($config['password']);
        
        // Testa a conexão
        $transport->start();
        $transport->stop();
        
        $this->info('✅ Conexão SMTP verificada com sucesso!');
        return 0;
        
    } catch (\Exception $e) {
        $this->error('❌ Falha na conexão SMTP: ' . $e->getMessage());
        return 1;
    }
    }
}
