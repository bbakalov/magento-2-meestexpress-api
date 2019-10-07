<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Console\Command;

use Bdn\MeestExpress\Api\ApiInterface;
use Bdn\MeestExpress\Model\Config\MeestExpressConfig;
use Symfony\Component\Console\{
    Command\Command,
    Input\InputInterface,
    Output\OutputInterface
};

class ApiAuth extends Command
{

    /**
     * @var ApiInterface
     */
    private $apiService;
    /**
     * @var MeestExpressConfig
     */
    private $meestExpressConfig;


    /**
     * ApiAuth constructor.
     *
     * @param ApiInterface       $apiService
     * @param MeestExpressConfig $meestExpressConfig
     */
    public function __construct(
        ApiInterface $apiService,
        MeestExpressConfig $meestExpressConfig
    ) {
        parent::__construct();
        $this->apiService         = $apiService;
        $this->meestExpressConfig = $meestExpressConfig;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('bdn:meestexpress:auth');
        $this->setDescription('Authenticate API user in MeestExpress system and save token to system configuration');
        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->apiService->auth();
        $this->meestExpressConfig->saveApiToken($response['result']['token']);
        $output->writeln('Successfully authenticated and saved token');
    }
}