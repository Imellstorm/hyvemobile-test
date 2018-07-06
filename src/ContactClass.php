<?php

namespace HyveMobileTest;

require '../boot.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class ContactClass {
	protected $contact;

	public function __construct() {
		$this->contact = Capsule::table( 'contacts' );
	}

	public function getContacts() {
		return $this->contact->paginate( 20, [ '*' ], 'page', $_GET['page'] );
	}
}