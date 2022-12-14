<?php

	class PointOfSalePro
	{
	    private $api_key = '';
	    private $api_secret = '';

	    /**
	    * @param string $api_key       Your API key obtained from the point of sale pro application (pointofsale.pro)
	    * @param string $api_secret    Your API secret obtained from the point of sale pro application (pointofsale.pro)
	    */
	    public function __construct($api_key, $api_secret, $api_version = 'v1')
	    {

	        if(function_exists('curl_version')===true)
	        {
		        $this->api_key = $api_key;
		        $this->api_secret = $api_secret;
	        }
	        else
	        {
	            die('Fatal Error; CURL for PHP is not installed');
	        }
	    }

		public $version=1;
		public $domain='https://api.pointofsale.pro';
		public $useragent='Point Of Sale Pro API v1';
		public $path='';
		public $url='';
		public $endpoints=array();
		public $timeout=10000;

		public function config($arr)
		{
			foreach($arr as $i=>$v)
			{
				$this->$i = $v;
			}
		}

		public function get_api_url($path)
		{
			return $this->domain . '/api/v' . $this->version . '/' . $path;
		}

		public function set_path($path)
		{
			$this->path = $path;
		}

		public function send($path,$input,$payload)
		{
			$this->set_path($path);
			return $this->post($input,$payload);
		}

		public function nonce()
		{
			return number_format(round(microtime(true) * 10000000), 0, '.', '');
		}

		public function auth()
		{
		    //
            $this->payload['nonce']=$this->nonce();
		    //
			$b01 = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode('{"typ":"JWT","alg":"HS256"}'));
			$b02 = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($this->payload)));
			$sig = hash_hmac('sha256', $b01 . "." . $b02, $this->api_secret, true);
			$b03 = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($sig));
			return $b01.'.'.$b02.'.'.$b03;
		}

		public function post($input,$payload)
		{
			$ch = curl_init();

			##/
			if(!$ch)
			{
				return (object)array('code'=>100,'error'=>'PHP-CURL not enabled');
			}
			else
			{

				//
				$this->payload=$payload;
				//
				$this->url = $this->domain . '/api/v' . $this->version . '/' . $this->path;

				//
				curl_setopt($ch, CURLOPT_URL,            $this->url);
				curl_setopt($ch, CURLOPT_HEADER,         false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
				curl_setopt($ch, CURLOPT_NOPROGRESS,     true);
				curl_setopt($ch, CURLOPT_TIMEOUT_MS,     $this->timeout);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		        curl_setopt($ch, CURLOPT_USERAGENT,     $this->useragent);
				curl_setopt($ch, CURLOPT_HTTPHEADER,    ['Key: '.$this->api_key,'Authorization: '.$this->auth()]);

				##/
				if(count($input)>0)
				{
					##/
					curl_setopt($ch,CURLOPT_POST, count($input));
					curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($input));
				}

				##/
				ob_start();curl_exec($ch); $return = ob_get_clean(); $out=array('success'=>false,'returned'=>array(),'network_info'=>array());

				##/
				if(empty($return))
				{
					##/
					$out['success']=false;
					$out['returned']=array('status'=>'failed');
					$out['network_info']=curl_getinfo($ch);
				}
				else
				{
					$out['success']=true;
					$out['returned'] = json_decode(trim($return),JSON_FORCE_OBJECT);
					$out['network_info']=curl_getinfo($ch);
				}

				curl_close($ch);
			}

			return $out;
		}


		public function decode($result)
		{
			return json_decode($result,JSON_FORCE_OBJECT);
		}

        public function sendCustom($path,$input)
        {
            $this->set_path($path);
            return $this->post($input,array())['returned'];
        }

		public function timestamp($input=array())
		{
			$this->set_path('system/timestamp/');
            return $this->post($input,array())['returned'];
		}

		public function facilitiesManagementList($input=array())
		{
			$this->set_path('pos/area-information/');
            return $this->post($input,array())['returned'];
		}

		public function transactionsList($input=array())
		{
            ##/
			$this->set_path('pos/transactions/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function staffList($input=array())
		{
            ##/
            $input['liststaff']=true;
            ##/
			$this->set_path('pos/staff/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function terminalList($input=array())
		{
            ##/
            $input['listterminal']=true;
            ##/
			$this->set_path('pos/staff/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function latestClockins($input=array())
		{
            ##/
            $input['latestclock']=1;
            ##/
			$this->set_path('pos/clockinout/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function payrollHistory($input=array())
		{
            ##/
            $input['payrollhistory']=1;
            ##/
			$this->set_path('pos/clockinout/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function payrollOutstanding($input=array())
		{
            ##/
            $input['outstanding']=1;
            ##/
			$this->set_path('pos/clockinout/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function schedulesTemplates($input=array())
		{
            ##/
            $input['schedulestemplates']=1;
            ##/
			$this->set_path('pos/clockinout/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function productList($input=array())
		{
            ##/
            $input['listproducts']=1;
            ##/
			$this->set_path('pos/products/');
            ##/
            return $this->post($input,array())['returned'];
		}

		public function customerList($input=array())
		{
            ##/
            $input['customerlist']=1;
            ##/
			$this->set_path('pos/customers/');
            ##/
            return $this->post($input,array())['returned'];
		}
    }

