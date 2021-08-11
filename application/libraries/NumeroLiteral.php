<?php
defined('BASEPATH') OR exit('No acceso permitido');
class NumeroLiteral {
	public function literal($numero)
	{
		$ndi=$this->numDigitos($numero);
		$numlit='';
		$du='';
		$c='';
		$mdu='';
		$mc='';
		$nd=$this->numDigitos($numero);
		while ($nd>=1)
		{
			if ($nd<=2)
			{
				$du=$this->decenas($numero);
				break;
			}
			elseif($nd==3)
			{
				$c=$this->centenas($numero);
				$numero=$numero-(floor($numero/100)*100);
			}
			elseif ($nd==4 || $nd==5)
			{
				$mdu=$this->decenas(floor($numero/1000));
				if ($mdu=='uno')
				{
					$mdu='un';
				}
				$numero=$numero-(floor($numero/1000)*1000);
			}
			else
			{
				$mc=$this->centenas(floor($numero/1000));
				$numero=$numero-(floor($numero/100000)*100000);
			}
			$nd=$this->numDigitos($numero);
		}
		switch ($ndi)
		{
			case 1:
				$numlit=$du;
				break;
			case 2:
				$numlit=$du;
				break;
			case 3:
				$numlit=$c.' '.$du;
				break;	
			case 4:
				$numlit=$mdu.' mil '.$c.' '.$du;
				break;
			case 5:
				$numlit=$mdu.' mil '.$c.' '.$du;
				break;
			case 6:
				$numlit=$mc.' '.$mdu.' mil '.$c.' '.$du;
				break;	
		}
		return $numlit;
	}
	public function numDigitos($n)
	{
		$valor=0;
		for ($i=1;$i<=7;$i++)
		{
			if ($n/10**$i<1)
			{
				$valor=$i;
				break;
			}
		}
		return $valor;
	}
	private function decenas($numero)
	{
		$valor='';
		if ($numero<=29)
		{
			$valor=$this->literalUnidades($numero);
		}
		else
		{
			if($numero%10==0)
			{
				$valor=$this->literalDecenas(floor($numero/10));
			}
			else
			{
				$valor=$this->literalDecenas(floor($numero/10)).' y '.$this->literalUnidades($numero-floor($numero/10)*10);
			}
		}
		return $valor;
	}
	private function centenas($numero)
	{
		$valor='';
		if ($numero<=199 && $numero>100)
		{
			$valor=$this->literalCentenas(floor($numero/100)).'to';
		}
		else
		{
			$valor=$this->literalCentenas(floor($numero/100));
		}
		return $valor;
	}
	private function literalUnidades($d)
	{
		$cad='';
		switch ($d)
		{
			case 1:
				$cad='uno';
				break;
			case 2:
				$cad='dos';
				break;
			case 3:
				$cad='tres';
				break;
			case 4:
				$cad='cuatro';
				break;
			case 5:
				$cad='cinco';
				break;
			case 6:
				$cad='seis';
				break;
			case 7:
				$cad='siete';
				break;
			case 8:
				$cad='ocho';
				break;
			case 9:
				$cad='nueve';
				break;
			case 10:
				$cad='diez';
				break;
			case 11:
				$cad='once';
				break;
			case 12:
				$cad='doce';
				break;
			case 13:
				$cad='trece';
				break;
			case 14:
				$cad='catorce';
				break;
			case 15:
				$cad='quince';
				break;
			case 16:
				$cad='dieciseis';
				break;
			case 17:
				$cad='diecisiete';
				break;
			case 18:
				$cad='dieciocho';
				break;
			case 19:
				$cad='diecinueve';
				break;
			case 20:
				$cad='veinte';
				break;
			case 21:
				$cad='veintiuno';
				break;
			case 22:
				$cad='veintidos';
				break;
			case 23:
				$cad='veintitres';
				break;
			case 24:
				$cad='veinticuatro';
				break;
			case 25:
				$cad='veinticinco';
				break;
			case 26:
				$cad='veintiseis';
				break;
			case 27:
				$cad='veintisiete';
				break;
			case 28:
				$cad='veintiocho';
				break;
			case 29:
				$cad='veintinueve';
				break;
		}
		return $cad;
	}
	private function literalDecenas($d)
	{
		$cad='';
		switch ($d)
		{
			case 3:
				$cad='treinta';
				break;
			case 4:
				$cad='cuarenta';
				break;
			case 5:
				$cad='cincuenta';
				break;
			case 6:
				$cad='sesenta';
				break;
			case 7:
				$cad='setenta';
				break;
			case 8:
				$cad='ochenta';
				break;
			case 9:
				$cad='noventa';
				break;
		}
		return $cad;
	}
	private function literalCentenas($d)
	{
		$cad='';
		switch ($d)
		{
			case 1:
				$cad='cien';
				break;
			case 2:
				$cad='docientos';
				break;
			case 3:
				$cad='trecientos';
				break;
			case 4:
				$cad='cuatrocientos';
				break;
			case 5:
				$cad='quinientos';
				break;
			case 6:
				$cad='seiscientos';
				break;
			case 7:
				$cad='setecientos';
				break;
			case 8:
				$cad='ochocientos';
				break;
			case 9:
				$cad='novecientos';
				break;
		}
		return $cad;
	}
}
