<?php

namespace HyveMobileTest;

require '../boot.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class TimeZoneClass {
	protected $contact;

	public function __construct() {
		$this->contact = Capsule::table( 'contacts' );
	}

	public function getContacts() {
		$timezone = $_GET['timezone'];

		$contacts = $this->contact->where( 'timezone', $timezone );

		return [
			'timezone'       => $timezone,
			'contacts'       => $contacts->get(),
			'total_contacts' => $contacts->count()
		];
	}
}