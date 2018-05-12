<?php

	class video{

		public $image;
		public $link;

		public function __construct($image, $link){

			$this->image = $image;
			$this->link = $link;
		}
	}

	class canalYoutube{

		const API_VIDEOS = "https://www.googleapis.com/youtube/v3/search?key=AIzaSyAIRGfcaER0rDUq5ptTgFyBZZY5SskDPC0&part=id&channelid=UCTJ1mLre8sT-d4KuvmQsSQA&publishedAfter=2016-11-21T00:00:00z&maxResults=50";

		const API_IMAGE_VIDEOS = "https://www.googleapis.com/youtube/v3/videos?key=AIzaSyAIRGfcaER0rDUq5ptTgFyBZZY5SskDPC0&part=snippet";
		private static function getIdVideosFromAPI(){

			$url = self::API_VIDEOS;
			$json = file_get_contents($url);
			$data = json_decode($json);

			return array_map(function($item) {return $item->id->videoId;}, $data->items);

			//$arr = array();

			//foreach($data->items as $item){

				//array_push($arr, $item->id->videoId);
			//}

			//return $arr;

		}

		private static  function getImageFromAPI($videoId){

			$url = self::API_IMAGE_VIDEOS."&id=$videoId";
			$json = file_get_contents($url);
			$data = json_decode($json);
			return $data;

			//return $data->items[0]->snippet->thumbnails->medium->url;

		}

		public static function getVideos(){

			$idVideoAPI = self::getIdVideosFromAPI();
			$videosDesafio = 100;
			$videosQueFaltam = $videosDesafio - count($idVideoAPI);
			//$imageVideos = "https://i.ytimg.com/vi/lsGyg3r0Qs8/mqdefault.jpg";

			$videos = array();

			for($i = 1; $i <= $videosQueFaltam; $i++){

				$semVideo = new video("https://placeholdit.imgix.net/~text?txtsize=33&txt=&w=320&h=180", "#");

				array_push($videos, $semVideo);

			}

			foreach($idVideoAPI as $umVideoId){
				
				$linkVideo =  "https://www.youtube.com/watch?v=".$umVideoId;
				$imageVideos = self::getImageFromAPI($umVideoId);

				$video = new video($imageVideos, $linkVideo);
				array_push($videos, $video);
			}

			//return $videos;
			return $imageVideos;
		}
	
	}
	var_dump(canalYoutube::getVideos());
?>