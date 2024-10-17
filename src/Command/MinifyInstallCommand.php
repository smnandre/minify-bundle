<?php

declare(strict_types=1);

/*
 * This file is part of the SensioLabs MinifyBundle package.
 *
 * (c) Simon André - Sensiolabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sensiolabs\MinifyBundle\Command;

use Sensiolabs\MinifyBundle\Minifier\MinifierInstallerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Simon André <smn.andre@gmail.com>
 */
#[AsCommand('minify:install', description: 'Install the Minify binary')]
final class MinifyInstallCommand extends Command
{
    public function __construct(
        private readonly MinifierInstallerInterface $minifyInstaller,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('force', null, InputOption::VALUE_NONE, 'Force a reinstall of the binary if it is already installed')
            ->setHelp(
                <<<'EOF'
The <info>%command.name%</info> command installs the <comment>minify</comment> binary.

It will download the binary from the <comment>tadewolf/minify</comment> GitHub repository
and will store it in the project directory.

    <info>php %command.full_name%</info>

Per default, the binary will not be re-installed if already present.          
              
Use the <comment>--force</comment> option to overwrite the existing binary:

    <info>php %command.full_name% --force</info>
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('force')) {
            $io->warning('The binary will be re-installed');
        }

        if ($this->minifyInstaller->isInstalled() && !$input->getOption('force')) {
            $io->success('The Minify binary is already installed');

            return Command::SUCCESS;
        }

        $this->minifyInstaller->install(force: (bool) $input->getOption('force'));
        $io->success('The Minify binary has been installed');

        return Command::SUCCESS;
    }
}
