<?php
namespace Mesd\PresentationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;

class PublishAssetsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('mesd:presentation:publish')
            ->setDescription('Publish assets from vendor to web')
            ->addOption('force', 'f', InputOption::VALUE_OPTIONAL, 'Force the publication of assets')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fs     = new Filesystem;
        $finder = new Finder;
        $appDir = $this->getContainer()->getParameter('kernel.root_dir');
        $srcDir = $appDir . '/../src/Mesd/PresentationBundle/Resources/public';
        $vndDir = $appDir . '/../vendor/mesd/presentation-bundle/Mesd/PresentationBundle/Resources/public';
        $webDir = $appDir . '/../web';

        if ($fs->exists($appDir))
        {
            $finder->in($appDir);

            foreach ($finder as $obj)
            {
                # code...
            }
        }
        elseif ($fs->exists($vndDir))
        {

        }
        $output->writeln('Starting plublish.');
    }
}