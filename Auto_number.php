<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auto Number Class
 * 
 * @package  CodeIgniter
 * @subpackage  Libraries
 * @category  Libraries
 * @author  Yoga Pratama
 * @link  https://github.com/yogaprttama/autonumber
 */
class Auto_number {

	/**
	 * Id semula
	 * @var string
	 */
	protected $id = '';

	/**
	 * Awalan pada Id
	 * @var string
	 */
	protected $awalan = 'ID';

	/**
	 * Jumlah digit
	 * @var integer
	 */
	protected $digit = 3;

	/**
	 * Sertakan tanggal pada Id?
	 * @var boolean
	 */
	protected $tanggal = FALSE;

	/**
	 * Format tanggal YYMMDD
	 * @var string
	 */
	protected $prefix_tanggal = '';

	// --------------------------------------------------------------------

	/**
	 * Config Auto_number
	 * 
	 * @param  array	$params	Initialization parameters
	 * @return Auto_number
	 */
	public function config(array $params = array())
	{
		foreach ($params as $key => $val)
		{
			$this->$key = $val;
		}
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Generate id baru
	 * @return string
	 */
	public function generate_id()
	{
		//Kondisi Id tidak ada atau kosong, beri nilai default
		if ($this->id == NULL OR $this->id == '')
		{
			$this->id = 1;
		}
		else
		{
			//Kondisi bila tanggal di set TRUE
			if($this->tanggal)
			{
				//Extract tanggal dari id
				$extract_tgl = substr($this->id, 0, 6);

				//Set prefix tanggal
				$this->prefix_tanggal = $extract_tgl;
			}

			//Extract nomor dari id
			$extract_no = substr($this->id, -$this->digit);

			//Casting nomor ke Integer
			$no = (int) $extract_no;

			//Increment id
			$this->id = ++$no;

			if($this->tanggal && $this->prefix_tanggal === date("ymd"))
			{
				$id_baru = str_pad($this->id, $this->digit, "0", STR_PAD_LEFT);
				$result = $this->prefix_tanggal . $id_baru;
			}
			else
			{
				$id_baru = str_pad(1, $this->digit, "0", STR_PAD_LEFT);
				$result = date("ymd") . $id_baru;
			}
		}

		//Kondisi bila tanggal di set FALSE
		if ($this->tanggal == FALSE)
		{
			$id_baru = str_pad($this->id, $this->digit, "0", STR_PAD_LEFT);
			$result = $this->awalan . $id_baru;			
		}

		return $result;
	}
}