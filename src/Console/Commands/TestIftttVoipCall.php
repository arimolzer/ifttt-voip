<?php

namespace Arimolzer\IftttVoip\Commands;

use Arimolzer\IftttVoip\Channels\IftttVoipCall;
use Illuminate\Console\Command;

/**
 * Class TestIftttVoipCall
 * @package Arimolzer\IftttVoip\Commands
 */
class TestIftttVoipCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ifttt-voip:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test call via the default VOIP call event in IFTTT';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->output->writeln('🤖 Beep Boop. Starting Test.');

        /** @var IftttVoipCall $voipCall */
        $voipCall = new IftttVoipCall();

        $key = config('ifttt-voip.credentials.default.key');
        $event = config('ifttt-voip.credentials.default.event');

        if (!$event || !$key) {
            $this->output->table(['Key', 'Event'], [[$key, $event]]);
            $this->output->newLine();
            return;
        }

        $voipCall->setParams(
            'I love you dearly.',
            'You\'re incredibly talented.',
            'Keep working hard, I\'m proud of you.'
        );

        $this->output->writeln('🤖 Beep Boop. Completed Test.');
    }
}
