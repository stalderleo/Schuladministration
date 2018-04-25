DROP DATABASE IF EXISTS SCHULADMINISTRATION;
CREATE DATABASE SCHULADMINISTRATION;

USE SCHULADMINISTRATION;

CREATE TABLE PERSON {
	PID varchar(50) NOT NULL
	NAME varchar(255) NOT NULL,
	VORNAME varchar(255) NOT NULL,
	GEBURTSDATUM date NOT NULL,
	GESCHLECHT ENUM('M', 'W') NOT NULL,
	STATUS int NOT NULL, -- 0 nicht mehr an der Schule (inaktiv), 1 aktiv	
	EMAIL varchar(255) NOT NULL UNIQUE, 
	USERNAME VARCHAR(255) NOT NULL UNIQUE,
	INITPW varchar(255) NOT NULL,
	CONSTRAINT pk_person PRIMARY KEY (PID),
};

CREATE TABLE LEHRER {
	PID VARCHAR(50) NOT NULL,
	KURZEL varchar(15) NOT NULL,
	CONSTRAINT pk_lehrer PRIMARY KEY (PID)
};

CREATE TABLE SCHUELER {

};



<lehrer>
  <username>roger.rossier</username>
  <initpw>XYYMY7V46R</initpw> -> nur lehrer
  <id>gibsso317281</id>
  <name>Rossier</name>
  <vorname>Roger</vorname>
  <geburtsdatum>1958-05-04</geburtsdatum>
  <geschlecht>m</geschlecht>
  <kuerzel>ROSR</kuerzel> -> nur lehrer
  <mail>roger.rossier@bbzsogr.ch</mail>
  <status>0</status>
  <ldap_export>0</ldap_export>
  <kurse/>
  <regelklassen/>
 </lehrer>
 
 <schueler>
  <username>jan.geisser</username>
  <initpw/>
  <id>gibsso502790</id>
  <name>Geisser</name>
  <vorname>Jan</vorname>
  <geburtsdatum>2001-03-12</geburtsdatum>
  <geschlecht>m</geschlecht>
  <kuerzel>-</kuerzel>
  <mail>jan.geisser@bbzsogr.ch</mail>
  <status>1</status>
  <ldap_export>1</ldap_export>
  <kurse>
   <kurs>
    <kurs_kuerzel>WEFE-PKB17A,PKE17A-KOPA</kurs_kuerzel>
    <kurs_bezeichnung>Werkstoff- und Fertigungstechnik</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>ZEMA-PKB17A,PKE17A-CATP</kurs_kuerzel>
    <kurs_bezeichnung>Zeichnungs- und Maschinentechnik</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>GES-PKB17A-1</kurs_kuerzel>
    <kurs_bezeichnung>Gesellschaft</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>SPKO-PKB17A-2</kurs_kuerzel>
    <kurs_bezeichnung>Sprache und Kommunikation</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>TE-PKB17A-3</kurs_kuerzel>
    <kurs_bezeichnung>Technisches Englisch</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>TG-PKB17A-4</kurs_kuerzel>
    <kurs_bezeichnung>Technische Grundlagen</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>TUSPO-PKB17A-5</kurs_kuerzel>
    <kurs_bezeichnung>Sport</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>ZEMA-PKB17A-CATP</kurs_kuerzel>
    <kurs_bezeichnung>Zeichnungs- und Maschinentechnik</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>D-BM1_TE17B-WYSA</kurs_kuerzel>
    <kurs_bezeichnung>Deutsch</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>EB-BM1_TE17B-BAYF</kurs_kuerzel>
    <kurs_bezeichnung>Englisch</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>F-BM1_TE17B-COSN</kurs_kuerzel>
    <kurs_bezeichnung>Französisch</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>GP-BM1_TE17B-GEIM</kurs_kuerzel>
    <kurs_bezeichnung>Geschichte und Politik</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>MG-BM1_TE17B-FEDR</kurs_kuerzel>
    <kurs_bezeichnung>Mathematik Grundlagen</kurs_bezeichnung>
   </kurs>
   <kurs>
    <kurs_kuerzel>fkM1C</kurs_kuerzel>
    <kurs_bezeichnung>Förderkurs Mathematik C</kurs_bezeichnung>
   </kurs>
  </kurse>
  <profile>
   <profil>
    <ausbildung_kuerzel>PM16-E</ausbildung_kuerzel>
    <stammklasse>PKB17A</stammklasse>
    <zweitausbildung_kuerzel>BM1_TE15</zweitausbildung_kuerzel>
    <zweitausbildung_stammklasse>BM1_TE17B</zweitausbildung_stammklasse>
   </profil>
  </profile>
 </schueler>