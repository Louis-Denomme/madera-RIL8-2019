<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

//de 2012-03-09 -> 09/03/2012
function dateSql2fr($date) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4);
}

//de 2012-03-09 -> 09-03-2012
function dateSql2Autocomplete($date) {
	if (empty($date))
		return "";
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "-" . substr($date, 5, 2) . "-" . substr($date, 0, 4);
}

//de 2012-03-09 11:13:29 -> 09/03/2012 à 11h13
function date2fr($date) {
	$date = trim($date);
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4) . " &agrave; " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> 09/03/2012 à 11h13 et de 2012-03-09 00:00:00 -> 09/03/2012
function date2frAuto($date) {
	if (empty($date))
		return "";
	if (!strtotime($date))
		return $date;
	if (strlen($date) < 19 || substr($date, 11, 8) == "00:00:00")
		return date2frmedium($date);
	else
		return date2fr($date);
}

//de 2012-03-09 11:13:29 -> 09/03/2012 11:13
function date2frSorter($date) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4) . " " . substr($date, 11, 2) . ":" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> 09/03/2012
function date2frmedium($date) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4);
}

//de 2012-03-09 11:13:29 -> 09/03
function date2frshort($date) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . "/" . substr($date, 5, 2);
}

//de 2012-03-09 11:13:29 -> 09 mar
function date2frshortMoisWA($date, $maj = false, $short = false) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj, $short);
}

//de 2012-03-09 11:13:29 -> 09 mars à 11h13
function date2frLight($date, $maj = false, $short = false) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj, $short) . " à " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> 09 mars 2012 à 11h13
function date2frMois($date, $maj = false, $short = false) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj, $short) . " " . substr($date, 0, 4) . " &agrave; " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> 09 mars 2012 a 11h13
function date2frMoisUtf8($date, $maj = false) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj) . " " . substr($date, 0, 4) . " à " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> lundi 09 mars 2012 à 11h13
function date2frMoisJour($date, $maj = false) {
	if (empty($date))
		return "";
	return jourToText($date, $maj) . " " . substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj) . " " . substr($date, 0, 4) . " &agrave; " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> lundi 09 mars 2012 a 11h13
function date2frMoisJourUtf8($date, $maj = false) {
	if (empty($date))
		return "";
	return jourToText($date, $maj) . " " . substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj) . " " . substr($date, 0, 4) . " à " . substr($date, 11, 2) . "h" . substr($date, 14, 2);
}

//de 2012-03-09 11:13:29 -> lundi 09 mars 2012 à 11h13m20s
function date2frMoisJourSec($date, $maj = false) {
	if (empty($date))
		return "";
	return jourToText($date, $maj) . " " . substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj) . " " . substr($date, 0, 4) . " &agrave; " . substr($date, 11, 2) . "h" . substr($date, 14, 2) . "m" . substr($date, 17, 2) . "s";
}

//de 2012-03-09 11:13:29 -> 03 mars 2012
function date2frShortMois($date, $maj = false, $short = false) {
	if (empty($date))
		return "";
	return substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj, $short) . " " . substr($date, 0, 4);
}

//de 2012-03-09 11:13:29 -> vendredi 03 mars 2012
function date2frShortMoisJour($date, $maj = false, $short = false) {
	if (empty($date))
		return "";
	return jourToText($date, $maj) . " " . substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj, $short) . " " . substr($date, 0, 4);
}

//de 2012-03-09 11:13:29 -> vendredi 03 mars
function date2frShortMoisJourLight($date, $maj = false) {
	if (empty($date))
		return "";
	return jourToText($date, $maj) . " " . substr($date, 8, 2) . " " . moisToTexte(substr($date, 5, 2), $maj);
}

//de 2012-03-09 11:13:29 -> ven 03
function date2frShortJourLight($date, $maj = false) {
	if (empty($date))
		return "";
	return substr(jourToText($date, $maj), 0, 3) . " " . substr($date, 8, 2);
}

//de 2012-03-09 11:13:29 -> 11h13
function date2Heure($date) {
	if (empty($date))
		return "";
	return substr($date, 11, 2) . "h" . substr($date, 14, 2);
}
