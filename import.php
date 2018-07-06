<?php

require 'boot.php';

use League\Csv\Reader;
use Illuminate\Database\Capsule\Manager as Capsule;

$zip = new ZipArchive;

if ( $zip->open( 'resources/data.csv.zip' ) === true ) {

	$zip->extractTo( 'resources/csv' );
	$zip->close();

	$csv = Reader::createFromPath( 'resources/csv/MOCK_DATA.csv' );
	$csv->setHeaderOffset( 0 );

	$records = $csv->getRecords();

	foreach ( $records as $offset => $record ) {
		$domain_name = substr( strrchr( $record['email'], "@" ), 1 );
		$ip          = gethostbyname( $domain_name );

		if ( ! Capsule::table( 'contacts' )->where( 'email', $record['email'] )->exists() ) {
			$path = "uploads/{$record['id']}.png";

			$my_img      = imagecreate( 300, 100 );
			$background  = imagecolorallocate( $my_img, 71, 76, 78 );
			$text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
			$line_colour = imagecolorallocate( $my_img, 255, 255, 0 );
			imagestring( $my_img, 4, 30, 15, "{$record['title']} {$record['first_name']} {$record['last_name']}", $text_colour );
			imagesetthickness( $my_img, 5 );
			imageline( $my_img, 30, 40, 270, 40, $line_colour );
			imagestring( $my_img, 4, 30, 50, "E-mail: {$record['email']}", $text_colour );
			imagepng( $my_img, $path );
			imagedestroy( $my_img );

			Capsule::table( 'contacts' )->insert(
				array(
					'email_ip'   => $ip,
					'image'      => $path,
					'title'      => $record['title'],
					'first_name' => $record['first_name'],
					'last_name'  => $record['last_name'],
					'email'      => $record['email'],
					'timezone'   => $record['tz'],
					'date'       => \Carbon\Carbon::parse( $record['date'], $record['tz'] )->format( 'd-m-Y' ),
					'time'       => \Carbon\Carbon::parse( $record['time'], $record['tz'] )->format( 'H:i:s' ),
					'notes'      => $record['note']
				)
			);
		}
	}

} else {

	die( 'Something went wrong!' );
}


