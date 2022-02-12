<?php namespace Acme;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ShowCommand extends Command{
    private $client;

    public function __construct(ClientInterface $client){
        $this->client=$client;
        parent::__construct(); 
    }


    public function configure(){
        $this->setName('show')
            ->setDescription('View movie information')
            ->addArgument('movie_name',InputArgument::REQUIRED,'Movie name')
            ->addOption('fullPlot',null,InputOption::VALUE_NONE,'View full plot of the movie');
         
    }
    
    public function execute(InputInterface $input,OutputInterface $output){
        $movie_name=$input->getArgument('movie_name');
        
        $plotLength=($input->getOption('fullPlot')) ? "full":"";
        
        $url="http://www.omdbapi.com";

        $api_key='d0de643b';

        $response=$this->client->request('GET',$url,['query'=>['t'=>$movie_name,'plot'=>$plotLength,'apikey'=>$api_key]]);
        
        $contents=$response->getBody()->getContents();
        $movie_info = json_decode($contents, true);
        if($movie_info['Response']=='False'){
            $message="ERROR: ".$movie_info['Error'];
            $output->writeln("<error>{$message}</error>");
            exit(0);
        }
        
        unset($movie_info['Ratings']);
        $movie_year=$this->getYear($movie_info);
        $table_title=$movie_name . "  -  ". $movie_year;


        $output->writeln("<info>{$table_title}</info>");
        $this->displayTable($movie_info,$output);
       
       
        //$output->writeln(array_keys($response)); 
        return 0;
    }

    public function displayTable($movie_info,$output){
        $table=new Table($output);
        $information_column=1;

        $table->setRows($this->parseMovieInformation($movie_info))
            ->setColumnMaxWidth($information_column,150);
            
        $table->render();


    }

    public function parseMovieInformation($movie_info){
        $parsedInformation=array();
        foreach($movie_info as $key=>$value){
            $parsedInformation[]=[$key,$value];
        }
        return $parsedInformation;
        
    }

    public function getYear($movie_info){
        return $movie_info['Year'];
    }

    
}




?>

