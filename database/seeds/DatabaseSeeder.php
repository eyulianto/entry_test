<?php

use App\Model\Website;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$inputs = array(
			array(
				'name' => 'Hipwee',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Hiburan',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/hiburan/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Tips',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/tips/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Hubungan',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/hubungan/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Motivasi',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/motivasi/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Travel',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/travel/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Sukses',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/sukses/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Style',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/style/feed/'
			),
			array(
				'name' => 'Hipwee Hipwee: Feature',
				'url' => 'http://www.hipwee.com',
				'rss_url' => 'http://www.hipwee.com/category/feature/feed/'
			),
			array(
				'name' => 'Merdeka.com',
				'url' => 'http://www.merdeka.com',
				'rss_url' => 'http://www.merdeka.com/feed/'
			),
			array(
				'name' => 'KapanLagi.com',
				'url' => 'http://www.kapanlagi.com',
				'rss_url' => 'http://www.kapanlagi.com/feed/'
			),
			array(
				'name' => 'Bola.net',
				'url' => 'http://www.bola.net/',
				'rss_url' => 'http://www.bola.net/feed/'
			),
			array(
				'name' => 'Vemale.com',
				'url' => 'http://www.vemale.com/',
				'rss_url' => 'http://www.vemale.com/feed/'
			),
			array(
				'name' => 'Otoasia.com',
				'url' => 'http://www.otosia.com',
				'rss_url' => 'http://a.otosia.com/rss/'
			),
			array(
				'name' => 'METROTVnews.com',
				'url' => 'http://www.metrotvnews.com',
				'rss_url' => 'http://www.metrotvnews.com/feed'
			),
			array(
				'name' => 'Business Insider',
				'url' => 'http://www.businessinsider.co.id',
				'rss_url' => 'http://www.businessinsider.co.id/feed/'
			)
		);

		foreach ($inputs as $input) {
			$website = new Website();
			$website->fill($input);

			try {
				$website->save();
			} catch (Exception $e) {
				// duplicate record
			}
		}
	}

}
