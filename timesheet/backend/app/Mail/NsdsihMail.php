<?php

namespace App\Mail;

use App\Model\Sys\Syplant;
use App\Model\Trs\Local\Nsdmail;
use App\Model\Trs\Local\Nsdsih;
use App\Sf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class NsdsihMail extends Mailable {
	use Queueable, SerializesModels;

	private $h;
	private $path;
	private $arrTo = [];
	private $arrCC = [];
	private $arrBCC = [];

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($si_no, $ctg) {

		$h = Nsdsih::where('si_no', $si_no)->withTrashed()->with(['rel_nsdinvh' => function ($q) {$q->with('rel_nsdinvd1');}])->first();
		$this->h = $h;
		$this->path = storage_path('app/libftp/' . $h->si_no . '-' . uniqid() . '.pdf');
		$syplant = Syplant::find($h->plant);
		$pdf = PDF::loadView('trs.local.nsdsih.nsdsih_print_plain', compact(['h', 'syplant']))->save($this->path);

		$to = Nsdmail::where('ctg', 'VDR')->where('vendor_id', $h->$ctg)->where('ismail_si', 1)->get();
		foreach ($to as $key => $v) {
			$this->arrTo[] = $v->email;
		}

		$cc = \App\Sf::getParsys('NSDSIH_EMAIL_CC');
		foreach (explode(';', $cc) as $k => $v) {
			if (trim($v) != '') {
				$this->arrCC[] = $v;
			}
		}
		$bcc = \App\Sf::getParsys('NSDSIH_EMAIL_BCC');
		foreach (explode(';', $bcc) as $k => $v) {
			if (trim($v) != '') {
				$this->arrBCC[] = $v;
			}
		}
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		$from = \App\Sf::getParsys('NSDSIH_EMAIL_FROM');
		$header_label = \App\Sf::getParsys('APP_WEB_COMPANY_NAME');

		if ($from != '') {
			$this->from($from);
		}
		return $this->to($this->arrTo)
			->cc($this->arrCC)
			->bcc($this->arrBCC)
			->with([
				'h' => $this->h,
				'header_label' => $header_label,
			])
			->attach($this->path, [
				'as' => $this->h->si_no . '.pdf',
				'mime' => 'application/pdf',
			])
			->subject("Shipping Instruction " . $this->h->booking_no . " (INV. " . $this->h->si_no . ")")
			->markdown('trs.local.nsdsih.nsdsih_mail');

	}
}
