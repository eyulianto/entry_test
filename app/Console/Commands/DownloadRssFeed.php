<?php 

namespace App\Console\Commands;

use App\Model\Article;
use App\Model\Content\Downloader;
use App\Model\Website;
use App\Model\Rss\Processor;
use DB;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DownloadRssFeed extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'rss_feed:download';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retrieve rss feed from registered websites and convert it into article.';

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
	public function fire()
	{
		$downloader = new Downloader();
		$processor = new Processor($downloader);
		
		$websiteIds = DB::table(Website::TABLENAME)->select('id')->get();
		foreach ($websiteIds as $websiteId) {
			$website = Website::find($websiteId->id);

			try {
				$result = $processor->extractItemsFromUrl($website->rss_url);	
			} catch (Exception $e) {
				$this->error($e->getMessage());
				continue;
			}
			
			$newCount = 0;
			$dupCount = 0;
			foreach ($result as $data) {
				$article = new Article();
				$article->website_id = $website->id;
				$article->fill($data);
				try {
					$article->save();
					$newCount++;
				} catch (Exception $e) {
					$dupCount++; // article already exists
				}
			}

			$this->info($website->rss_url." sucessfully downloaded. new: ".$newCount.", dup: ".$dupCount);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			// ['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			// ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
