<?php
namespace LinkerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use DateInterval;

class LinksCleanerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:links-cleaner')

            // the short description shown while running "php bin/console list"
            ->setDescription('Remove outdated links from DB.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to remove links older than 15 days.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $linkManager = $this->getContainer()->get('doctrine')->getManager();
        $now = new \DateTime();

        $days = 15;

        //считываем все ссылки старше 15 дней
        $links = $linkManager->getRepository('LinkerBundle:Link')->getOutdatedLinks($now->sub(new DateInterval('P'.$days.'D')));
        if(!empty($links) && is_array($links) && count($links)>0){
            foreach($links as $link){
                //удаляем устаревшие ссылки.
                $output->writeln('Remove outdated link #'.$link->getId());
                $linkManager->remove($link);
                $linkManager->flush();
            }
        }else{
            $output->writeln('There is no outdated links. Outdating period: '.$days.' days');
        }

    }
}